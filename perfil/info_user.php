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
if ( !isset($_POST["user"]) ) {
    $response["response"] = "incorrect request.";
    echo json_encode($response);
    exit;
}
/* 
* validation to prevent 
* injection attacks
*/
$user = addslashes($_POST["user"]);

$account = HandlerSQL::listUserByCod($user);

if ($account) {
    $response["response"] = "ok";
    $response["user-ctf"]["nick"] = $account["nick"];
    $response["user-ctf"]["apelido"] = $account["apelido"];
    $response["user-ctf"]["description"] = $account["description"];
    $response["user-ctf"]["avatar"] = HandlerSQL::getAvatarByCod($account["avatar"]);
    $response["user-ctf"]["cod"] = $account["cod"];
    $response["user-ctf"]["desafios"] = HandlerSQL::listDesafiosByUser($account["cod"]);

} else {
    $response["response"] = "no";
}

echo json_encode($response);

?>