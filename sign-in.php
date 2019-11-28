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
if (!isset($_POST["nick"]) || !isset($_POST["pass"])) {
    $response["response"] = "incorrect request nickname or password not entered.";
    echo json_encode($response);
    exit;
}
/* 
* validation to prevent 
* injection attacks
*/
$nick = strtolower(addslashes($_POST["nick"]));
$pass = addslashes($_POST["pass"]);
$pass = hash('sha256', $pass);

$account = HandlerSQL::listUser($nick, $pass);

sleep( 1.8 );

if ($account) {
    $response["response"] = "ok";
    $_SESSION["ctf-user"]["nick"] = $account["nick"];
    $_SESSION["ctf-user"]["apelido"] = $account["apelido"];
    $_SESSION["ctf-user"]["description"] = $account["description"];
    $_SESSION["ctf-user"]["avatar"] = $account["avatar"];
    $_SESSION["ctf-user"]["cod"] = $account["cod"];
    $_SESSION["ctf-user"]["color"] = $account["color"];
} else {
    $response["response"] = "no";
}


sleep( 1.5 );
echo json_encode($response);

?>