<?php

namespace App\Controller;

use App\Entity\Orders;
use App\Form\OrdersType;
use App\Entity\Addresses;
use App\Form\AddressesType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderController extends AbstractController
{
    /**
     * @Route("/order", name="order")
     */
    public function index(Request $request): Response
    {
       //dd($request->request);die();

       $req = $request->request;

       

       $order = $request->request->get('orders');

       $order = new Orders();

       $form = $this->createForm(OrdersType::class,$order);

       $form->handleRequest($request);

       if($form->isSubmitted() && $form->isValid()) {
           $em = $this->getDoctrine()->getManager();
           $em->persist($order);
           $em->flush();

            //var_dump($req->get('orders_id'));

            if($req->get('orders_id') === NULL){
                //dd($req->get('orders'));die();
                $address = new Addresses();

               

                $new_address = $req->get('orders');

                //var_dump($new_address);die();

                $address->setType($new_address['type']);
                $address->setName($new_address['name']);
                $address->setPhone($new_address['phone']);
                $address->setTaxnum($new_address['taxnum']);
                $address->setCountry($new_address['country']);
                $address->setPostcode($new_address['postcode']);
                $address->setCity($new_address['city']);
                $address->setStreet($new_address['street']);

                $am = $this->getDoctrine()->getManager();
                $am->persist($address);
                $am->flush();

            }

           $this->addFlash('notice','Módosítás kész!');

           return $this->redirectToRoute('order');
           
       }

        return $this->render('order/index.html.twig', [
            'controller_name' => 'OrderController',
            'options' => $this->getDoctrine()->getRepository(Addresses::class)->findAll(),
            'form' => $form->createView(),
            //'open' => $open,
        ]);
    }

    /**
     * @Route("/order/ajax/{id}", name="order/ajax")
     */
    public function ajaxAction(Request $request,$id) {

        if ($request->isXmlHttpRequest() || $request->query->get('showJson') == 1) {

            $address = $this->getDoctrine()->getRepository(Addresses::class)->find($id);

            //var_dump($address);

            $jsonData = [
                'type' => $address->getType(),
                'name' => $address->getName(),
                'phone' => $address->getPhone(),
                'taxnum' => $address->getTaxnum(),
                'country' => $address->getCountry(),
                'postcode' => $address->getPostcode(),
                'city' => $address->getCity(),
                'street' => $address->getStreet()
            ];
            return new JsonResponse($jsonData);
        } else {
            return $this->redirectToRoute('order');
        }

    }


}
