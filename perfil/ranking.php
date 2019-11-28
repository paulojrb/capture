<?php

/* required for authenticaiton */
session_start();

/*
* are you logged in?
*/
if ( !isset($_SESSION["ctf-user"]) ) {
    header("Location: logoff.php");
}

/* include files */
require_once('../php/handler-sql.php');

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="../img/png/favicon.png" type="image/png" />
    <title>Ranking - C.T.F</title>
    <script
      src="https://code.jquery.com/jquery-3.4.1.js"
      integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
      crossorigin="anonymous">
    </script>
    <link rel="stylesheet" type="text/css" href="../semantic/semantic.css">
    <link rel="stylesheet" type="text/css" href="">
    <script src="../semantic/semantic.js"></script>
</head>
<body style="padding: 7px;">

    <div class="ui <?php echo $_SESSION["ctf-user"]["color"]; ?> inverted menu">
        <div class="header item">
            Capture The Flag
        </div>
        <a href="./" class="item">
            Perfil
        </a>
    </div>
    
    <!-- View ALL -->
    <div class="ui one column grid" style="padding-top: 0px;">
        
        <div class="column">
            <table class="ui celled structured table">
                <thead>
                    <tr>
                        <th rowspan="2" class="center aligned"> <h1>Jogador</h1></th>
                        <th colspan="10">Challenges</th>
                    </tr>
                    <tr>
                        <th class="center aligned">A1</th>
                        <th class="center aligned">A2</th>
                        <th class="center aligned">A3</th>
                        <th class="center aligned">A4</th>
                        <th class="center aligned">A5</th>
                        <th class="center aligned">A6</th>
                        <th class="center aligned">A7</th>
                        <th class="center aligned">A8</th>
                        <th class="center aligned">A9</th>
                        <th class="center aligned">A0</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $ranking = HandlerSQL::Ranking(); $jogador_ndesafios = array(); ?>
                    <?php foreach ($ranking as $jogador): ?>
                        <?php 
                            $temp_jogador = HandlerSQL::listUserByCod($jogador["cod"]);
                            $temp_avatar = HandlerSQL::getAvatarByCod($temp_jogador["avatar"]);
                        ?>
                        <tr>
                            <td>
                                <img class="ui avatar image" src="../img/png/<?php echo $temp_avatar; ?>">
                                <span><?php echo $temp_jogador["nick"]; ?></span>
                            </td>
                            <td class="center aligned">
                                <?php 
                                    if ( HandlerSQL::userTemDesafio($jogador["cod"], 1) ) {
                                        echo "<i class='large green checkmark icon'></i>";
                                    } 
                                ?>
                            </td>
                            <td class="center aligned">
                                <?php 
                                    if ( HandlerSQL::userTemDesafio($jogador["cod"], 2) ) {
                                        echo "<i class='large green checkmark icon'></i>";
                                    } 
                                ?>
                            </td>
                            <td class="center aligned">
                                <?php 
                                    if ( HandlerSQL::userTemDesafio($jogador["cod"], 3) ) {
                                        echo "<i class='large green checkmark icon'></i>";
                                    } 
                                ?>
                            </td>
                            <td class="center aligned">
                                <?php 
                                    if ( HandlerSQL::userTemDesafio($jogador["cod"], 4) ) {
                                        echo "<i class='large green checkmark icon'></i>";
                                    } 
                                ?>
                            </td>
                            <td class="center aligned">
                                <?php 
                                    if ( HandlerSQL::userTemDesafio($jogador["cod"], 5) ) {
                                        echo "<i class='large green checkmark icon'></i>";
                                    } 
                                ?>
                            </td>
                            <td class="center aligned"> <?php 
                                    if ( HandlerSQL::userTemDesafio($jogador["cod"], 6) ) {
                                        echo "<i class='large green checkmark icon'></i>";
                                    } 
                                ?>
                            </td>
                            <td class="center aligned">
                                <?php 
                                    if ( HandlerSQL::userTemDesafio($jogador["cod"], 7) ) {
                                        echo "<i class='large green checkmark icon'></i>";
                                    } 
                                ?>
                            </td>
                            <td class="center aligned">
                                <?php 
                                    if ( HandlerSQL::userTemDesafio($jogador["cod"], 8) ) {
                                        echo "<i class='large green checkmark icon'></i>";
                                    } 
                                ?>
                            </td>
                            <td class="center aligned">
                                <?php 
                                    if ( HandlerSQL::userTemDesafio($jogador["cod"], 9) ) {
                                        echo "<i class='large green checkmark icon'></i>";
                                    } 
                                ?>
                            </td>
                            <td class="center aligned">
                                <?php 
                                    if ( HandlerSQL::userTemDesafio($jogador["cod"], 10) ) {
                                        echo "<i class='large green checkmark icon'></i>";
                                    } 
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
    <!-- View ALL -->
    
    <script src=""></script>
    <script>
        
    </script>
</body>
</html>