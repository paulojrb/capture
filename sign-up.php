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
require_once('./php/handler-sql.php');
#require_once('../location.php');

/* variables */
$response = array();

/*
* requisição incorreta
*/
if ( !isset($_POST["nick"]) || !isset($_POST["pass"]) || !isset($_POST["apelido"]) || !isset($_POST["description"]) || !isset($_POST["token"]) || !isset($_POST["img"]) || !isset($_POST["color"]) ) {
    $response["response"] = "incorrect request nickname or password not entered.";
    echo json_encode($response);
    exit;
}
/* 
* validation to prevent 
* injection attacks
*/
$nick = addslashes($_POST["nick"]);
$pass = addslashes($_POST["pass"]);
$apelido = addslashes($_POST["apelido"]);
$description = addslashes($_POST["description"]);
$token = addslashes($_POST["token"]);
$img = addslashes($_POST["img"]);
$color = addslashes($_POST["color"]);

echo json_encode($response);

/*
$account = HandlerSQL::createUser($nick, $apelido, $description, $pass, $token, $color, $img);

if ($account) {
    $response["response"] = "ok";
} else {
    $response["response"] = "no";
}

sleep( 1.5 );
echo json_encode($response);
*/
?>