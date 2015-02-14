<?php

namespace App\Services;

class BaseService
{
    /**
     * @var
     */
    protected $db;

    /**
     * @param $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

}
