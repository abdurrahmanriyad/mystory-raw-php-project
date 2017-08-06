<?php
/**
 * Created by PhpStorm.
 * User: primez
 * Date: 8/5/17
 * Time: 11:58 PM
 */

namespace Classes\Story;
use Classes\Database\DbHelper;
use Classes\Validation\Validation;

require_once "../../../vendor/autoload.php";

class TagRepository
{

    private $db_helper;

    public function __construct()
    {
        $this->db_helper = new DbHelper();
    }

    public function addTag(Tag $tag)
    {
        $validation = new Validation();
        if (! $validation->isEmptyString($tag->title)) {
            $inserted  = $this->db_helper->insert('tag',[
                'tag' => $tag->title,
                'created_at' => date("Y-m-d h:i:s"),
                'updated_at' => date("Y-m-d h:i:s")
            ]);

            return $inserted;
        }

        return false;
    }

    public function removeTag(Tag $tag)
    {
        return $this->db_helper->delete('tag', 'id ='.$tag->id);
    }

    public function editTag($id, $tag)
    {
        return $this->db_helper->update('tag', ["tag" => $tag, "updated_at" => date("Y-m-d h:i:s")], 'id ='.$id);
    }

    public function getTagById($id)
    {
        return $this->db_helper->select('tag', [], ' WHERE id ='.$id);
    }

    public function getTags()
    {
        return $this->db_helper->select('tag', []);
    }
}