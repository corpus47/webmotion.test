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
        return $this->render('address/index.html.twig', [
            'controller_name' => 'AddressController',
        ]);
    }

    /**
     * @Route("/address/create",name="address/create")
     */

    public function create(Request $request) {

        $data = $this->getDoctrine()->getRepository(Addresses::class)->findAll();

        $address = new Addresses();

        $form = $this->createForm(AddressesType::class,$address);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($address);
            $em->flush();

            $this->addFlash('notice','Felvitel kész!');

            return $this->redirectToRoute('address/create');
            
        }


        
        return $this->render('address/index.html.twig',[
            'controller_name' => 'Felvitel',
            'form_title' => 'Felvitel',
            'form' => $form->createView(),
            'data' => $data,
        ]);

    }

    /**
    * @Route("/address/update/{id}",name="address/update")
    */

    public function update(Request $request, $id) {

        $data = $this->getDoctrine()->getRepository(Addresses::class)->findAll();

        $address = $this->getDoctrine()->getRepository(Addresses::class)->find($id);

        $form = $this->createForm(AddressesType::class,$address);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($address);
            $em->flush();

            $this->addFlash('notice','Módosítás kész!');

            return $this->redirectToRoute('address/create');
            
        }

        return $this->render('address/index.html.twig',[
            'controller_name' => 'Módosítás',
            'form_title' => 'Módosítás',
            'form' => $form->createView(),
            'data' => $data,
            'mode' => 'update'
        ]);

    }

    /**
    * @Route("/address/delete/{id}",name="address/delete")
    */

    public function delete(Request $request, $id) {

        $address = $this->getDoctrine()->getRepository(Addresses::class)->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($address);
        $em->flush();

        $this->addFlash('notice','Cím törölve!');

        return $this->redirectToRoute('address/create');

        /*return $this->render('address/index.html.twig',[
            'controller_name' => 'Törlés',
            'form_title' => 'Törlés',
            'form' => $form->createView(),
            'data' => $data,
        ]);*/

    }

    /**
     *
     */
    
    private function getTable() {

    }

}
