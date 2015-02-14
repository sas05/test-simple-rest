<?php

namespace App\Services;

class CartService extends BaseService
{

    /**
     * @param $cart
     *
     * @return mixed
     */
    function add($cart)
    {
        $this->db->insert("cart", $cart);

        return $this->db->lastInsertId();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    function delete($id)
    {
        return $this->db->delete("cart", array("id" => $id));
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->db->fetchAll("SELECT * FROM cart");
    }

}
