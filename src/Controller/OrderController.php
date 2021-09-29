<?php

namespace App\Controller;

use App\Entity\Addresses;
use App\Form\AddressesType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderController extends AbstractController
{
    /**
     * @Route("/order", name="order")
     */
    public function index(): Response
    {

        $address = new Addresses();

        $form = $this->createForm(AddressesType::class,$address);

        

        return $this->render('order/index.html.twig', [
            'controller_name' => 'OrderController',
            'options' => $this->getDoctrine()->getRepository(Addresses::class)->findAll(),
            'form' => $form->createView(),
        ]);
    }



}
