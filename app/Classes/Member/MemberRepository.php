<?php
/**
 * Created by PhpStorm.
 * User: primez
 * Date: 8/9/17
 * Time: 1:26 PM
 */

namespace Classes\Member;

use Classes\Config\Config;
use Classes\Database\DB;

class MemberRepository
{

    private $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function add(Member $member)
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

        return $inserted = $this->db->insert('user', $data);
    }


    public function get($user = null)
    {
        if ($user) {
            $field = (is_numeric($user)) ? 'id' : 'username';
            $data = $this->db->get('user', [$field, "=", $user]);

            if($data->count()) {
                return $data->first();
            }
        }

        return '';
    }


    public function updateMember(Member $member, $memberId)
    {
        return $this->db->update('user', $memberId, [
            'name' => $member->name,
            'photo_url' => $member->photo_url,
            'profession_id' => $member->profession,
            'dateofbirth' => $member->getDateOfBirth(),
            'updated_at' => date("Y-m-d h:i:s")
        ]);
    }

    public function updateMemberPermission($permission, $memberId)
    {
        return $this->db->update('user', $memberId, [
            'group_id' => $permission,
            'updated_at' => date("Y-m-d h:i:s")
        ]);
    }

    public function updateMemberActivation($active, $memberId)
    {
        return $this->db->update('user', $memberId, [
            'active' => $active,
            'updated_at' => date("Y-m-d h:i:s")
        ]);
    }


    public function getAllMembers($orderby = null, $order = 'ASC')
    {
        return $this->db->all('user', $orderby, $order);
    }

    public function getAllPermissionGroups()
    {
        return $this->db->all('user_group');
    }

    public function isValidApiKey($key = '')
    {
        if (!empty($key)) {
            $result = $this->db->get('user', ['apikey', '=', $key]);
            if ($result->count()) {
                return $result->first()->id;
            }
        }

        return false;
    }

}