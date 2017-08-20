<?php
//require_once "../lib/DbFunctions.php";
class ApiAuthMiddleware{

    public function __invoke($request, $response, $next)
    {
        if(isset($request->getHeader('apikey')[0])){
            $Dbfunctions =  new Dbfunctions();
            $apikey = $request->getHeader('apikey')[0];
            if(!$Dbfunctions->isValidApiKey($apikey)){
                $data = array('error' => 'true', 'user' => "Access Denied. Invalid Api key");
                $response = $next($request, $response);
                return $response->withJson($data);
            }else{
                $user = $Dbfunctions->getUserId($apikey);
                if ($user != NULL)
                    $user_id = $user["id"];
                    $request = $request->withAttribute('user_id', $user_id);
            }
        } else {
            $data = array('error' => 'true', 'user' => "Api key is missing");
            $response = $next($request, $response);
            return $response->withJson($data);
        }
        $response = $next($request, $response);
        return $response;
    }

}