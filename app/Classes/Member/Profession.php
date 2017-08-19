<?php
/**
 * Created by PhpStorm.
 * User: primez
 * Date: 8/19/17
 * Time: 11:59 AM
 */

namespace Classes\Member;

use Classes\Database\DB;

class Profession
{
    private $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function getProfessions()
    {
        return $this->db->all('profession');
    }
}