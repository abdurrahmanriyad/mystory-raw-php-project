<?php
function test(){

     echo "http://" . $_SERVER['SERVER_NAME'].":8888/storyteller";
}
if (! function_exists('testme')) {

    function testme()
    {
        echo "called";
    }
}

if (! function_exists('base_url')) {
    /**
     * @param $url
     * @return string
     */
    function base_url($url = '')
    {
        // output: /myproject/index.php
        $currentPath = $_SERVER['PHP_SELF'];

        // output: localhost
        $hostName = $_SERVER['HTTP_HOST'];

        // output: http://
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';

        // return: http://localhost/myproject/
        return $protocol.$hostName."/mystory/".$url;
    }
}


if (! function_exists('escape')) {

    /**
     * @param $string
     */
    function escape ($string) {
        return htmlentities($string, ENT_QUOTES, 'UTF-8');
    }
}

