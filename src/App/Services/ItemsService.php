<?php

namespace App\Services;

class ItemsService extends BaseService
{

    public function getAll()
    {
        return $this->db->fetchAll("SELECT * FROM items");
    }

    function save($item)
    {
        $this->db->insert("items", $item);
        return $this->db->lastInsertId();
    }

    function update($id, $item)
    {
        return $this->db->update('items', $item, ['id' => $id]);
    }

    function delete($id)
    {
        return $this->db->delete("items", array("id" => $id));
    }

}
