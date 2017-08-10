<?php
/**
 * Created by PhpStorm.
 * User: primez
 * Date: 8/10/17
 * Time: 1:16 PM
 */

namespace Classes\Util;


use Classes\Database\DB;

class CookieRepository
{
    private $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }
    
    public function get($table, array $where)
    {
        return $this->db->get($table, $where);
    }

    public function add($table, array $data)
    {
        return $this->db->insert($table, $data);
    }

    public function delete($table, array $where)
    {
        return $this->db->delete($table, $where);
    }
}