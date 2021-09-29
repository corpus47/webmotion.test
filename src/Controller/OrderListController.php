<?php

namespace App\Controller;

use App\Entity\Orders;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderListController extends AbstractController
{
    /**
     * @Route("/order/list", name="order_list")
     */
    public function index(): Response
    {

        $orders = $this->getDoctrine()->getRepository(Orders::class)->findAll();

        return $this->render('order_list/index.html.twig', [
            'controller_name' => 'OrderListController',
            'data' => $orders,
        ]);
    }
}
