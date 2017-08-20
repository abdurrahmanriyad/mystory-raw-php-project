<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once "lib/DbFunctions.php";
require_once "lib/Product.cls.php";
require_once "middleware/Authentication.php";

$app = new \Slim\App;

$app->get('/', function(Request $request, Response $response){
    echo "hello world";
});



/**
 * route for login user
 */
$app->post('/api/v1/login', function(Request $request, Response $response){
    $email = $request->getParam('email');
    $pass  = $request->getParam('pass');

    $Dbfunctions =  new Dbfunctions();
    $result = $Dbfunctions->getUserByEmailAndPassword($email, $pass);

    if($result) {
        $data = array('error' => 'false', 'user' => $result);
        return $response->withJson($data);
    }else {
        $data = array('error' => 'true', 'message' => 'No user found');
        return $response->withJson($data);
    }

});


/**
 * route for register user
 */
$app->post('/api/v1/register', function(Request $request, Response $response){
    $name  = $request->getParam('name');
    $father_name  = $request->getParam('father_name');
    $mother_name  = $request->getParam('mother_name');
    $mobile  = $request->getParam('mobile');
    $address = $request->getParam('address');
    $username = $request->getParam('username');
    $pass  = $request->getParam('password');

//    echo '<pre>' . var_dump($request, true) . '</pre>';

    $Dbfunctions =  new Dbfunctions();
    $result = $Dbfunctions->createStudent($name, $father_name, $mother_name, $mobile, $address, $username, $pass);

    if($result) {
        $data = array('error' => 'false', 'user' => $result);
        return $response->withJson($data);
    }else {
        $data = array('error' => 'true', 'message' => 'Failed to create');
        return $response->withJson($data);
    }

});


/**
 * route for update user
 */
$app->put('/api/v1/update', function(Request $request, Response $response){
    $id  = $request->getParam('id');
    $name = $request->getParam('name');

    $Dbfunctions =  new Dbfunctions();
    $result = $Dbfunctions->updateUser($id, $name);
    if($result) {
        $data = array('error' => 'false', 'user' => $result);
        return $response->withJson($data);
    }else {
        $data = array('error' => 'true', 'message' => 'Failed to create');
        return $response->withJson($data);
    }

});


/**
 * route for update user
 */
$app->delete('/api/v1/delete', function(Request $request, Response $response){
    $id  = $request->getParam('id');

    $Dbfunctions =  new Dbfunctions();
    $result = $Dbfunctions->deleteUser($id);
    if($result) {
        $data = array('error' => 'false', 'message' => 'successfully deleted');
        return $response->withJson($data);
    }else {
        $data = array('error' => 'true', 'message' => 'Failed to delete');
        return $response->withJson($data);
    }

});



//$app->get('/api/v1/test', function(Request $request, Response $response){
//
//
//
//})->add(new ApiAuthMiddleware());
//
//
//$app->post('/api/v1/test', function(Request $request, Response $response){
//    echo $request->getAttribute('user_id');
//})->add(new ApiAuthMiddleware());
//


$app->get('/api/v1/products', function(Request $request, Response $response){
    $product =  new Product();
    $result = $product->getAllProducts();
    if($result) {
        return $response->withJson($result);
    }else {
        $data = array('error' => 'true', 'message' => 'Failed to fetch products');
        return $response->withJson($data);
    }

});



