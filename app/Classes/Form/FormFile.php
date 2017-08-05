<?php
/**
 * Created by PhpStorm.
 * User: primez
 * Date: 8/5/17
 * Time: 12:39 PM
 */

namespace Classes\Form;

require_once "../../../vendor/autoload.php";


class FormFile
{

    public function uploadFile($file)
    {
        if ($file['name']) {

            if (!$file['error'])
            {

                $valid_extensions = array("jpeg", "jpg", "png");
                $temporary = explode(".", $file['name']);
                $file_extension = end($temporary);

                if ((($file["type"] == "image/png")
                        || ($file["type"] == "image/jpg")
                        || ($file["type"] == "image/jpeg"))
                    && ($file["size"] < 2048000)
                    && in_array($file_extension, $valid_extensions)){

                    if (file_exists("../../../uploads/" . $file["name"])) {
                        return false;
                    } else {
                        move_uploaded_file($file["tmp_name"],
                            '../../../uploads/'. $file["name"]);
                        return $file["name"];
                    }

                }

            }
        }

        return false;
    }

}