<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CartController
{

    protected $cartService;


    public function __construct($service)
    {
        $this->cartService = $service;
    }

    public function add(Request $request)
    {
        if(null === $request->request->get('customer_id')) {
            return new JsonResponse(array("message" => 'Customer Id required', 'code' => 204));
        }

        if(null === $request->request->get('item_id')) {
            return new JsonResponse(array("message" => 'Item Id required', 'code' => 204));
        }

        $cart = $this->getDataFromRequest($request);

        return new JsonResponse(array("id" => $this->cartService->add($cart)));
    }

    private function getDataFromRequest(Request $request)
    {
        return $cart = array(
            "customer_id" => $request->request->get("customer_id"),
            "item_id"     => $request->request->get("item_id")
        );
    }
}