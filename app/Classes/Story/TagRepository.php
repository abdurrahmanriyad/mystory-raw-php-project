<?php
/**
 * Created by PhpStorm.
 * User: primez
 * Date: 8/5/17
 * Time: 11:58 PM
 */

namespace Classes\Story;
use Classes\Database\DbHelper;
use Classes\Database\DB;
use Classes\Validation\Validation;

require_once "../../../vendor/autoload.php";

class TagRepository
{

    private $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function addTag(Tag $tag)
    {
        $validation = new Validation();
        if (! $validation->isEmptyString($tag->title)) {
            $inserted  = $this->db->insert('tag',[
                'tag' => $tag->title,
                'created_at' => date("Y-m-d h:i:s"),
                'updated_at' => date("Y-m-d h:i:s")
            ]);

            return $inserted;
        }

        return false;
    }

    public function removeTag($id)
    {
        return $this->db->delete('tag', ['id', '=', $id]);
    }

    public function editTag($id, $tag)
    {
        return $this->db->update('tag',$id, ["tag" => $tag, "updated_at" => date("Y-m-d h:i:s")]);
    }

    public function getTagById($id)
    {
        $result = $this->db->get('tag', ['id', '=', $id]);
        return $result->first();
    }

    public function getTags()
    {
        return $this->db->all('tag');
    }
}