<?php

namespace App\Controller;

use App\Form\ImportFile;
use App\Entity\Import;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\People;
use App\Entity\Phones;
use App\Entity\ShipOrders;
use App\Entity\Item;

class ImportController extends AbstractController
{

    /**
     * I'm lack of time but could be improved with:
     * validating the file type
     * creating a model to manipulate the data (savePeople and saveShipOrder)
     */
    public function processXml(Request $request){
        $import = new Import();
        $form = $this->createForm(ImportFile::class, $import);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $import->getFile();
            $fileName = $this->generateUniqueFileName().'.xml';
            // Move the file to the XML directory and process the data
            try {
                $file->move(
                    $this->getParameter('xmlFiles_directory'),
                    $fileName
                );

                $xml = simplexml_load_file("../xmlFiles/".$fileName);

                if($xml->person){
                    $this->savePeople($xml->person);
                }
                if($xml->shiporder){
                    $this->saveShipOrder($xml->shiporder);
                }

                $this->addFlash(
                    'notice',
                    'File imported with success!'
                );

            } catch (FileException $e) {
                throw new \Exception('Something went wrong!');
            }
        }

        return $this->render(
            'ImportXML.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * I'm lack of time but could be improved with:
     * putting the name of the file plus datetime
     */
    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }

    /**
     * I'm lack of time but could be improved with:
     * a validation by id_person to be unique and then eliminate the id
     *
     * the phones table can be improved by making the id_person and phone be the composite primary key
     */
    private function savePeople($people)
    {
        foreach($people as $person){
            $people = new People();
            $people->setName($person->personname);
            $people->setIdperson($person->personid);

            $em = $this->getDoctrine()->getManager();
            $em->persist($people);
            $em->flush();
            $id_person = $people->getId();

            foreach($person->phones->phone as $phone) {
                $phones = new Phones();
                $phones->setIdPerson($id_person);
                $phones->setPhone($phone);
                $em->persist($phones);
                $em->flush();
            }
        }
    }

    /**
     * I'm lack of time but could be improved with:
     * a validation by id_shiporder to be unique and then eliminate the id
     *
     * the shipto could be a different table to control de complete adress and also the city and country could be different tables
     * to generalize the solution
     *
     */
    private function saveShipOrder($shipOrder)
    {
        foreach($shipOrder as $orders){
            $order = new ShipOrders();
            $order->setOrderId((int) $orders->orderid);
            $order->setOrderPerson((int) $orders->orderperson);
            $order->setShipName($orders->shipto->name);
            $order->setShipAddress($orders->shipto->address);
            $order->setShipCity($orders->shipto->city);
            $order->setShipCountry($orders->shipto->country);

            $em = $this->getDoctrine()->getManager();
            $em->persist($order);
            $em->flush();
            $id_ship_order = $order->getId();

            foreach($orders->items->item as $items){
                $item = new Item();
                $item->setIdShipOrder($id_ship_order);
                $item->setTitle($items->title);
                $item->setNote($items->note);
                $item->setQuantity((int) $items->quantity);
                $item->setPrice((float) $items->price);
                $em->persist($item);
                $em->flush();
            }
        }
    }

}
