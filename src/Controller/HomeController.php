<?php

namespace App\Controller;

use App\Entity\Order;
use App\Service\DiscountManager;
use App\Service\JsonToOrderConverter;
use App\Service\API\OrderApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'home', methods: ['get','post'])]
    public function index(Request $request, DiscountManager $discountManager, JsonToOrderConverter $converter, OrderApi $api): Response
    {

        if($request->getMethod() === 'POST')
        {
            $order = $api->fetchOrderById($request->request->get('order'));
            if ($order instanceof Order)
            {
                $discountManager->applyDiscounts($order);
            }
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'order' => $order??null,
        ]);
    }
}
