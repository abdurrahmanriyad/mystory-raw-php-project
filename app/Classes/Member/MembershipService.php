<?php
/**
 * Created by PhpStorm.
 * User: primez
 * Date: 8/9/17
 * Time: 1:25 PM
 */

namespace Classes\Member;


use Classes\Database\DB;

class MembershipService
{
    private $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function register(Member $member)
    {
        $data = [
            "name" => $member->name,
            "username" => $member->getUsername(),
            "email" => $member->getEmail(),
            "password" => $member->getPassword(),
            "profession" => $member->profession,
            "dateofbirth" => date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $member->getDateOfBirth()))),
            "created_at" => date('Y-m-d H:i:s')

        ];

        $this->db->insert('user', $data);
    }
}