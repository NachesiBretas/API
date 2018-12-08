<?php

namespace App\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations;
use App\Entity\People;
use App\Entity\Phones;
use App\Entity\ShipOrders;
use App\Entity\Item;
use Symfony\Component\HttpFoundation\File\Exception\FileException;



class ApiController extends FOSRestController
{

   /**
    * @Annotations\Get(
    *     path="/api/people/{id_person}", defaults={"_format"="text/xml"}
    * )
    */
   public function getPersonAction($id_person)
    {
        $personData = $this->getDoctrine()
            ->getRepository(People::class)
            ->find($id_person);

        if($personData) {
            $phonesPerson = $this->getDoctrine()
                ->getRepository(Phones::class)
                ->findBy(array('id_person' => $id_person), array('id_person' => 'ASC'));

            $xml = '<?xml version="1.0" encoding="UTF-8"?>';
            $xml .= '<people>' .
                '<person>' .
                '<personid>' . $personData->getIdPerson() . '</personid>' .
                '<personname>' . $personData->getName() . '</personname>' .
                '<phones>';
            foreach ($phonesPerson as $phone) {
                $xml .= '<phone>' . $phone->getPhone() . '</phone>';
            }
            $xml .= '</phones>' .
                '</person>' .
                '</people>';

            $response = new Response($xml);
            $response->headers->set('Content-Type', 'xml');

            return $response;
        }
        else{
            throw new \Exception('Something went wrong!');
        }
    }


    /**
     * @Annotations\Get(
     *     path="/api/people", defaults={"_format"="text/xml"}
     * )
     */
    public function getAllPeopleAction()
    {
        $peopleData =  $this->getDoctrine()
            ->getRepository(People::class)->findAll();

        if($peopleData) {
            $xml = '<?xml version="1.0" encoding="UTF-8"?>'
                . '<people>';
            foreach ($peopleData as $personData) {
                $phonesPerson = $this->getDoctrine()
                    ->getRepository(Phones::class)
                    ->findBy(array('id_person' => $personData->getIdPerson()), array('id_person' => 'ASC'));

                $xml .= "<person>" .
                    "<personid>" . $personData->getIdPerson() . "</personid>" .
                    "<personname>" . $personData->getName() . "</personname>" .
                    '<phones>';
                foreach ($phonesPerson as $phone) {
                    $xml .= '<phone>' . $phone->getPhone() . '</phone>';
                }
                $xml .= '</phones>' .
                    "</person>";
            }
            $xml .= '</people>';

            $response = new Response($xml);
            $response->headers->set('Content-Type', 'xml');

            return $response;
        }
        else{
            throw new \Exception('Something went wrong!');
        }
    }


    /**
     * @Annotations\Get(
     *     path="/api/shiporder/{id_shiporder}", defaults={"_format"="text/xml"}
     * )
     */
    public function getShipOrderAction($id_shiporder)
    {
        $shipData =  $this->getDoctrine()
            ->getRepository(ShipOrders::class)
            ->find($id_shiporder);

        if($shipData) {
            $items = $this->getDoctrine()
                ->getRepository(Item::class)
                ->findBy(array('id_ship_order' => $id_shiporder), array('id_ship_order' => 'ASC'));

            $xml = '<?xml version="1.0" encoding="UTF-8"?>';
            $xml .= '<shiporders>' .
                '<shiporder>' .
                '<orderid>' . $shipData->getOrderId() . '</orderid>' .
                '<orderperson>' . $shipData->getOrderPerson() . '</orderperson>' .
                '<shipto>' .
                '<name>' . $shipData->getShipName() . '</name>' .
                '<address>' . $shipData->getShipAddress() . '</address>' .
                '<city>' . $shipData->getShipCity() . '</city>' .
                '<country>' . $shipData->getShipCountry() . '</country>' .
                '</shipto>' .
                '<items>';
            foreach ($items as $item) {
                $xml .= '<item>' .
                    '<title>' . $item->getTitle() . '</title>' .
                    '<title>' . $item->getNote() . '</title>' .
                    '<title>' . $item->getQuantity() . '</title>' .
                    '<title>' . $item->getPrice() . '</title>' .
                    '</item>';
            }
            $xml .= '</items>' .
                '</shiporder>' .
                '</shiporders>';

            $response = new Response($xml);
            $response->headers->set('Content-Type', 'xml');

            return $response;

        }
        else{
            throw new \Exception('Something went wrong!');
        }
    }

    /**
     * @Annotations\Get(
     *     path="/api/shiporder", defaults={"_format"="text/xml"}
     * )
     */
    public function getAllShipOrdersAction()
    {
        $shipData =  $this->getDoctrine()
            ->getRepository(ShipOrders::class)
            ->findAll();

        if($shipData) {
            $xml = '<?xml version="1.0" encoding="UTF-8"?>';
            $xml .= '<shiporders>';
            foreach ($shipData as $shipOrder) {
                $items = $this->getDoctrine()
                    ->getRepository(Item::class)
                    ->findBy(array('id_ship_order' => $shipOrder->getOrderId()), array('id_ship_order' => 'ASC'));

                $xml .= '<shiporder>' .
                    '<orderid>' . $shipOrder->getOrderId() . '</orderid>' .
                    '<orderperson>' . $shipOrder->getOrderPerson() . '</orderperson>' .
                    '<shipto>' .
                    '<name>' . $shipOrder->getShipName() . '</name>' .
                    '<address>' . $shipOrder->getShipAddress() . '</address>' .
                    '<city>' . $shipOrder->getShipCity() . '</city>' .
                    '<country>' . $shipOrder->getShipCountry() . '</country>' .
                    '</shipto>' .
                    '<items>';
                foreach ($items as $item) {
                    $xml .= '<item>' .
                        '<title>' . $item->getTitle() . '</title>' .
                        '<title>' . $item->getNote() . '</title>' .
                        '<title>' . $item->getQuantity() . '</title>' .
                        '<title>' . $item->getPrice() . '</title>' .
                        '</item>';
                }
                $xml .= '</items>' .
                    '</shiporder>';
            }
            $xml .= '</shiporders>';

            $response = new Response($xml);
            $response->headers->set('Content-Type', 'xml');

            return $response;
        }
        else{
            throw new \Exception('Something went wrong!');
        }
    }
}