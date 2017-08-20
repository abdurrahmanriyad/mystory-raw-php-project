<?php

require_once "DbFunctions.php";
class Product
{
    private $DbFunctions = "";

    function __construct()
    {
        $this->DbFunctions = new Dbfunctions();
    }

    public function getAllProducts(){
        return $this->DbFunctions->get("SELECT product.id, product.title, img_title, quantity, price, availability, product_category.id as category_id, product_category.title as category_title FROM product JOIN product_category ON product.product_category_id = product_category.id");
    }
}