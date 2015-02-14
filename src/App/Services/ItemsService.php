<?php

namespace App\Services;

class ItemsService extends BaseService
{

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->db->fetchAll("SELECT * FROM items");
    }

    /**
     * @param $item
     *
     * @return mixed
     */
    function save($item)
    {
        $this->db->insert("items", $item);
        return $this->db->lastInsertId();
    }

    /**
     * @param $id
     * @param $item
     *
     * @return mixed
     */
    function update($id, $item)
    {
        return $this->db->update('items', $item, ['id' => $id]);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    function delete($id)
    {
        return $this->db->delete("items", array("id" => $id));
    }

}
