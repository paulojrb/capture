<?php
/*
* GNU GENERAL PUBLIC LICENSE
* Version 3, 29 June 2007
*
* Copyright (C) 2007 Free Software Foundation, Inc. <https://fsf.org/>
* Everyone is permitted to copy and distribute verbatim copies
* of this license document, but changing it is not allowed.
* https://www.gnu.org/licenses/gpl-3.0.txt
*/

/*
* By Paulo Roberto Júnior
*/

/* Required for loggin session */
session_start();

/* set header */
header("Content-Type: application/json; charset=utf-8");

/* include files */
require_once('../php/handler-sql.php');
#require_once('../location.php');

/* variables */
$response = array();

/*
* requisição incorreta
*/
if ( !isset($_POST["token"]) ) {
    $response["response"] = "incorrect request.";
    echo json_encode($response);
    exit;
}
/* 
* validation to prevent 
* injection attacks
*/
$token = addslashes($_POST["token"]);

$resp = HandlerSQL::resgarteFlag($_SESSION["ctf-user"]["cod"], $token);

if ($resp) {
    $response["resgate"] = "ok";
    HandlerSQL::insertFeed($_SESSION["ctf-user"]["cod"], $token);
} else {
    $response["resgate"] = "no";
}

echo json_encode($response);

?>