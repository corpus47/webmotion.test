<?php

namespace App\Controller;

use App\Entity\Addresses;
use App\Form\AddressesType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AddressController extends AbstractController
{
    /**
     * @Route("/address", name="address")
     */
    public function index(Request $request): Response
    {
        dd($request);
        return $this->render('address/index.html.twig', [
            'controller_name' => 'AddressController',
        ]);
    }

    /**
     * @Route("/address/create",name="address/create")
     */

    public function create(Request $request) {

        $address = new Addresses();

        $form = $this->createForm(AddressesType::class,$address);
        $form->handleRequest($request);


        return $this->render('address/index.html.twig', [
            'controller_name' => 'AddressController',
            'form' => $form->createView(),
        ]);

    }

}
