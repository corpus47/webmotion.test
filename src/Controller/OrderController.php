<?php

namespace App\Controller;

use App\Entity\Orders;
use App\Form\OrdersType;
use App\Entity\Addresses;
use App\Form\AddressesType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderController extends AbstractController
{
    /**
     * @Route("/order", name="order")
     */
    public function index(Request $request): Response
    {

       $order = new Orders();

       $form = $this->createForm(OrdersType::class,$order);

        

        return $this->render('order/index.html.twig', [
            'controller_name' => 'OrderController',
            'options' => $this->getDoctrine()->getRepository(Addresses::class)->findAll(),
            'form' => $form->createView(),
        ]);
    }



}
