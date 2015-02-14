<?php
namespace App\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class ItemsController
{

    protected $itemsService;


    public function __construct($service)
    {
        $this->itemsService = $service;
    }

    public function getAll()
    {
        return new JsonResponse($this->itemsService->getAll());
    }

    public function save(Request $request)
    {
        if(null === $request->request->get('name')) {
            return new JsonResponse(array("message" => 'name required', 'code' => 204));
        }

        if(null === $request->request->get('description')) {
            return new JsonResponse(array("message" => 'description required', 'code' => 204));
        }

        if(null === $request->request->get('price')) {
            return new JsonResponse(array("message" => 'price required', 'code' => 204));
        }

        $item = $this->getDataFromRequest($request);

        return new JsonResponse(array("id" => $this->itemsService->save($item)));
    }

    public function update($id, Request $request)
    {
        if(null === $id) {
            return new JsonResponse(array("message" => 'id required', 'code' => 204));
        }

        if(null === $request->request->get('name')) {
            return new JsonResponse(array("message" => 'name required', 'code' => 204));
        }

        if(null === $request->request->get('description')) {
            return new JsonResponse(array("message" => 'description required', 'code' => 204));
        }

        if(null === $request->request->get('price')) {
            return new JsonResponse(array("message" => 'price required', 'code' => 204));
        }

        $item = $this->getDataFromRequest($request);
        $this->itemsService->update($id, $item);
        return new JsonResponse($item);

    }

    public function delete($id)
    {
        return new JsonResponse($this->itemsService->delete($id));
    }

    private function getDataFromRequest(Request $request)
    {

        return $item = array(
            "name"        => $request->request->get("name"),
            "description" => $request->request->get("description"),
            "price"       => $request->request->get("price")
        );
    }
}
