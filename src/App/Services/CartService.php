<?php

namespace App\Services;

class CartService extends BaseService
{

    function add($cart)
    {
        $this->db->insert("cart", $cart);

        return $this->db->lastInsertId();
    }

    function delete($id)
    {
        return $this->db->delete("cart", array("id" => $id));
    }

    public function getAll()
    {
        return $this->db->fetchAll("SELECT * FROM cart");
    }

}
