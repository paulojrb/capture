<?php

ini_set( 'display_errors', 0 );

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

$avatar = HandlerSQL::getAvatarByCod($_SESSION["ctf-user"]["avatar"]);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="../img/png/favicon.png" type="image/png" />
    <title>Capture The Flag - (CTF)</title>
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

    <div class="ui left vertical sidebar menu">
        <div class="ui middle aligned animated relaxed list" style="padding: 7px;">

            <?php $ranking = HandlerSQL::Ranking(); $jogador_ndesafios = array(); ?>

            <?php foreach ($ranking as $jogador): ?>

            <div class="item">

                <?php 
                    $temp_jogador = HandlerSQL::listUserByCod($jogador["cod"]);
                    $temp_avatar = HandlerSQL::getAvatarByCod($temp_jogador["avatar"]);
                    $jogador_ndesafios[$jogador["cod"]] = $jogador["num"]; 
                ?>
                <img class="ui avatar image" src="../img/png/<?php echo $temp_avatar; ?>">
                <div class="content">
                    <a class="header"><?php echo $temp_jogador["nick"]; ?></a>
                    <div class="description"><?php echo $temp_jogador["description"]; ?>.</div>
                </div>
            </div>

            <?php endforeach; ?>

        </div>
    </div>
    
    <div class="ui right vertical sidebar menu">
        <div class="ui comments" style="padding: 7px;">
            <?php $result = HandlerSQL::listFeed(); ?>
            <?php foreach ($result as $value): ?>
                <?php $user = HandlerSQL::listUserByCod($value["user"]); ?>
                <?php $user_avatar = HandlerSQL::getAvatarByCod($value["user"]); ?>
                <div class="comment">
                    <div class="content">
                        <a class="ui <?php echo $user["color"]; ?> image small label">
                            <img src="../img/png/<?php echo $user_avatar; ?>">
                            <?php echo $user["nick"]; ?>
                        </a>
                        <div class="metadata">
                            <span class="date"><?php echo date("M j, h:m:s", $value["data"]); ?></span>
                        </div>
                        <div class="text">
                            <?php echo $value["comment"]; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>

    <div class="ui <?php echo $_SESSION["ctf-user"]["color"]; ?> inverted menu" style="
            margin-top: 0px;
        ">
        <div class="header item">
            Capture The Flag
        </div>
        <a href="./ranking.php" class="item">
            Ranking
        </a>
        <div class="right menu">
            
            <a href="logoff.php" class="ui item">
                <i class="sign-out icon"></i>
            </a>
        </div>
    </div>
    <div class="ui one column grid" style="padding-top: 0px;">
        <div class="mobile only sixteen wide column">
            <div class="ui fluid two item menu">
                <a class="item" id="bt-m-ranking">ranking</a>
                <a class="item" id="bt-m-feed">feed</a>
            </div>
        </div>
    </div>
    
    <!-- View ALL -->
    <div class="ui three column grid" style="padding-top: 0px;">
        
        <!-- Menu lateral Esquerdo -->
        <div class="three wide computer only column">
            <div class="ui segment">
                <h1 class="ui header">   
                    <img class="ui massive circular image" src="../img/png/<?php echo $avatar ?>" >
                    <div class="content">
                        <?php echo $_SESSION["ctf-user"]["nick"]; ?>
                      <div class="sub header"><?php echo $_SESSION["ctf-user"]["apelido"]; ?></div>
                    </div>
                </h1>
            </div>
            <div class="ui segment">
                <div class="ui bottom attached violet basic label">Ranking ctf</div>
                <div class="ui middle aligned animated relaxed list">

                    <?php $ranking = HandlerSQL::Ranking(); $jogador_ndesafios = array(); ?>

                    <?php foreach ($ranking as $jogador): ?>

                    <div class="item">

                        <?php 
                            $temp_jogador = HandlerSQL::listUserByCod($jogador["cod"]);
                            $temp_avatar = HandlerSQL::getAvatarByCod($temp_jogador["avatar"]);
                            $jogador_ndesafios[$jogador["cod"]] = $jogador["num"]; 
                        ?>
                        <img class="ui avatar image" src="../img/png/<?php echo $temp_avatar; ?>">
                        <div class="content">
                            <a class="header"><?php echo $temp_jogador["nick"]; ?></a>
                            <div class="description"><?php echo $temp_jogador["description"]; ?>.</div>
                        </div>
                    </div>

                    <?php endforeach; ?>
                    <?php //print_r($jogador_ndesafios); ?>

                </div>
            </div>
        </div>
        <!-- Menu lateral -->
        
        <!-- Middler View -->
        <div class="nine wide widescreen eight wide computer ten wide tablet sixteen wide mobile column">
            <h2 class="ui block header">
                <i class="globe icon"></i>
                <div class="content">
                    Capture the flag
                    <div class="sub header">Welcome, my son, welcome to the machine.</div>
                </div>
            </h2>

            <div class="ui styled fluid accordion">
                
                <div class="active title">
                    <i class="dropdown icon"></i>
                    Jogadores
                </div>
                <div class="active content">
                    <div class="ui three stackable cards">
                        <?php $result = HandlerSQL::listUsers(); ?>
                        <?php foreach ($result as $value): ?>
                            <?php $user_avatar = HandlerSQL::getAvatarByCod($value["avatar"]); $rating = HandlerSQL::getRating($_SESSION["ctf-user"]["cod"], $value["cod"]); ?>
                            <div class="ui fluid raised link card y">
                                <div class="blurring dimmable image">
                                    <div class="ui dimmer">
                                        <div class="content">
                                        <div class="center">
                                            <div class="ui mini <?php echo $value["color"]; ?> inverted button btcard" id="btcard_<?php echo $value["cod"]; ?>">View Profile</div>
                                        </div>
                                        </div>
                                    </div>
                                    <img src="../img/png/<?php echo $user_avatar; ?>">
                                </div>
                                
                                <div class="content" style="padding-bottom: 5px;">
                                    <a class="header"><?php echo $value["nick"]; ?></a>
                                </div>
                                <div class="extra content" style="padding-bottom: 13px;padding-top: 5px;">
                                    Rating:
                                    <div class="ui star rating rt" data-rating="<?php echo $rating; ?>" id="r_<?php echo $value["cod"]; ?>"></div>
                                </div>
                                <div class="ui bottom attached indicating  progress" data-value="<?php echo $jogador_ndesafios[$value["cod"]]; ?>" data-total="11">
                                    <div class="bar"></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div style="padding-top: 20px;"></div>

            <div class="ui styled fluid accordion">
                <div class="title">
                    <i class="dropdown icon"></i>
                    Desafios
                </div>
                <div class="content">
                    <div class="ui two stackable cards">
                        <?php $result = HandlerSQL::listInfoDesafios(); ?>
                        <?php foreach ($result as $value): ?>

                            <div class="ui fluid raised link card">
                                <div class="content" style="padding-bottom: 15px;">
                                <div class="ui right floated heart rating" data-rating="1" data-max-rating="1"></div>
                                    <div class="header" style="padding-top: 5px;"><?php echo $value["name"]; ?></div>
                                    <div class="description">
                                    <p>
                                        <?php echo $value["description"]; ?>
                                    </p>
                                    </div>
                                </div>
                                <div class="extra content" style="padding-bottom: 10px;padding-top: 0px;">
                                    <span class="right floated author">
                                        <?php echo $value["type"]; ?>
                                    </span>
                                </div>
                            </div>

                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
            
        </div>
        <!-- Middler View only six wide tablet only column -->
        
        <div class="four wide widescreen five wide computer only six wide tablet only column">
            
            <div class="ui positive message hidden">
                <i class="close icon"></i>
                <div class="header">
                Flag resgatada!
                </div>
                <p><b>Parabéns!!</b> Você resolveu o desafio e resgatou a flag.</p>
            </div>

            <div class="ui negative message hidden" style="margin-top: 0px;">
                <i class="close icon"></i>
                <div class="header">
                Flag inválida!
                </div>
                <p>Essa não é a flag correta ou já foi resgatada.</p>
            </div>

            <div class="ui piled segment" style="margin-bottom: 20px;margin-top: 0px;">
                <div class="ui form">
                    <div class="field">
                        <label>Resgatar flag</label>
                        <input id="flag" type="text" placeholder="Inserir flag">
                    </div>
                </div>
            </div>

            <div class="ui segment">
                <a class="ui blue ribbon label">Time Line</a> Feed Game
                <div class="ui comments">
                    <?php $result = HandlerSQL::listFeed(); ?>
                    <?php foreach ($result as $value): ?>
                        <?php $user = HandlerSQL::listUserByCod($value["user"]); ?>
                        <?php $user_avatar = HandlerSQL::getAvatarByCod($value["user"]); ?>
                        <div class="comment">
                            <div class="content">
                                <a class="ui <?php echo $user["color"]; ?> image small label">
                                    <img src="../img/png/<?php echo $user_avatar; ?>">
                                    <?php echo $user["nick"]; ?>
                                </a>
                                <div class="metadata">
                                    <span class="date"><?php echo date("M j, h:m:s", $value["data"]); ?></span>
                                </div>
                                <div class="text">
                                    <?php echo $value["comment"]; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    
                </div>
            </div>
        </div>
        
    </div>
    <!-- View ALL -->

    <div class="ui modal pf">
        <div class="header">
            Player Perfil Detail
        </div>
        <div class="image scrolling content">
            <div class="ui medium image">
                <img id="i-user" src="../img/png/zoe.jpg">
            </div>
            <div class="description">
                <div class="ui header" id="n-user"></div>
                <div class="ui list" id="l-user">
                    
                </div>
            </div>
        </div>
        <div class="actions">
            <div class="ui black deny button">
                Close
            </div>
        </div>
    </div>
    
    <!-- Modal indisponível -->
    <div id="error-modal" class="ui basic tiny modal">
        <div class="ui icon header">
            <i class="exclamation triangle icon"></i>
            Internal Server Error
        </div>
        <div class="content">
            <p style="text-align: center">Sorry for the inconvenience, unable to login due to internal server error, please wait for server to be relocated.</p>
        </div>
    </div>
    
    <script src="../js/resgatar-flag.js"></script>
    <script>
        $('#bt-m-ranking').click(function() {
            $('.ui.left.vertical.sidebar.menu')
                .sidebar('setting', 'transition', 'overlay')
                .sidebar('toggle')
            ;
        });
        $('#bt-m-feed').click(function() {
            $('.ui.right.vertical.sidebar.menu')
                .sidebar('setting', 'transition', 'overlay')
                .sidebar('toggle')
            ;
        });
        $('.ui.accordion')
            .accordion()
        ;
        $('.ui.rating')
            .rating()
        ;
        $('.ui.fluid.raised.link.card.y .image').dimmer({
            on: 'hover'
        });
        $('.message .close')
        .on('click', function() {
            $(this)
                .closest('.message')
                .transition('fade')
            ;
        })
        ;
        $(".ui.mini.inverted.button").click(function(){
            $('.ui.modal.pf')
                .modal({
                    inverted: true,
                })
                .modal('setting', 'transition', 'horizontal flip')
                .modal('show')
            ;
        });
        $('.ui.progress')
            .progress('increment')
        ;
        $(document).on("click",".btcard",function(e){
            var seat_number = this.id.match(/\d/g);
            $.ajax({
                url: './info_user.php',
                type: 'POST',
                dataType: 'json',
                data: 'user='+seat_number,
                success: function(response) {
                    console.log(response)
                    if (response.response == "ok") {
                        $('#l-user').html("")
                        $('#n-user').text(response["user-ctf"]["nick"])
                        $('#i-user').attr('src', '../img/png/'+response["user-ctf"]["avatar"])
                        for (i=0; i < response["user-ctf"]["desafios"].length; i++) {
                            temphtml = `
                            <div class="item">
                                <img class="ui avatar image" src="../img/svg/${response["user-ctf"]["desafios"][i]["img"]}">
                                <div class="content">
                                <div class="header">Desafio ${response["user-ctf"]["desafios"][i]["name"]}</div>
                                ${response["user-ctf"]["desafios"][i]["tipo"]}
                                </div>
                            </div>
                            `
                            $('#l-user').html($('#l-user').html()+temphtml)
                        }
                        
                    }
                },
                error: function() {
                    $('#error-modal')
                        .modal({
                            inverted: true
                        })
                        .modal('show')
                    ;
                },
            });
        });
        
        $(document).on("click",".rt",function(e){
            var seat_number = this.id.match(/\d/g);
            is = e.currentTarget.querySelectorAll('i')
            num = 0
            for (i = 0; i < is.length; i++) {
                if (is[i].classList.contains('active')) {
                    num++;
                }
            }
            $.ajax({
                url: './alter-rating.php',
                type: 'POST',
                dataType: 'json',
                data: 'user='+seat_number+'&rating='+num,
                success: function(response) {
                    console.log(response)
                    if (response.response == "ok") {
                        console.log('alter rating')
                    }
                },
                error: function() {
                    $('#error-modal')
                        .modal({
                            inverted: true
                        })
                        .modal('show')
                    ;
                },
            });
        });
    </script>
</body>
</html>