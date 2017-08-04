<?php
/**
 * Created by PhpStorm.
 * User: primez
 * Date: 8/3/17
 * Time: 12:40 PM
 */

namespace Classes\Developer;


class Developer
{
    private $name;
    private $responsibility;
    private $photo_url;
    private $social_urls;

    /**
     * Developer constructor.
     * @param $name
     * @param $responsibility
     * @param $photo_url
     * @param $social_urls
     */
    public function __construct($name, $responsibility, $photo_url, array $social_urls)
    {
        $this->name = $name;
        $this->responsibility = $responsibility;
        $this->photo_url = $photo_url;
        $this->social_urls = $social_urls;
    }

}