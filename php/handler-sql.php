<?php

class HandlerSQL {

    public static function conMySQL() {
        return new mysqli("localhost", "ydb",
            "pass", "ydb");
    }

    public static function execSelect($query) {
        try {
          $con = self::conMySQL();
          $lResult = $con->query($query);
          return $lResult ? $lResult->fetch_assoc() : null;
        }
        catch (Exception $e) {
          throw(new Exception(" + Error: ".$e));
        }
    }

    public static function insert($query) {
        $con = self::conMySQL();
        $end = $con->query($query);
        $con->close();
        if ($end === true) { return true; }
        else { return false; }
	}
    
    public static function alterRating($user_m, $user, $rating) {
        $query = "update user_rating set rating = $rating where user_m = $user_m and user = $user;";
        if (self::insert($query))
            return true;
        return false;
    }
    
    public static function insertUserRating($cod, $num) {
        $query = "insert into user_rating (user_m, user, rating) values ($cod, $num, 1);";
        if (self::insert($query))
            return true;
        return false;
    }
    
    public static function createUser($nick, $apelido, $description, $passwd, $token, $color, $img) {
        $cod_img = self::getCodByAvatar($img);
        $query = "insert into user (avatar, color, nick, passwd, apelido, description, token, rating)".
            " values ($cod_img, '$color', '$nick', SHA2('$passwd', 256), '$apelido', '$description', 1, 1);";
        if (self::insert($query)) {
            $cod = self::getCodByNick($nick);
            for ($i = 1; $i < 7; $i++) {
                var_dump(self::insertUserRating($cod, $i));
            }
            return true;            
        }
        return false;
    }
    
    public static function insertFeed($user, $desafio) {
        $query = "select cod, name, tipo from desafio where token = '$desafio'";
        if ($result = self::execSelect($query)) {
            $comment = $result["name"]." de ".$result["tipo"];
        }
        $query = "insert into feed (user, comment, data) ".
            "values ('$user', '$comment', now() )";
        
        if ( self::insert($query) ) {
            return true;
        } else {
            return false;
        }
    }
    
    public static function getCodByNick($nick) {
        $query = "select cod from user where nick = '$nick'";
        if ($result = self::execSelect($query))
            return $result["cod"];
        return null;
    }
    
    public static function resgarteFlag($user, $flag) {
        $query = "select cod from desafio where token = '$flag'";
        if ($result = self::execSelect($query)) {
            $cod_flag = $result["cod"];
            if ( self::userTemDesafio($user, $cod_flag) ) {
                return false;
            } else {
                $query = "insert into user_desafio (nick, desafio, data) values ($user, $cod_flag, now())";
                if ( self::insert($query) ) {
                    return true;
                } else {
                    return false;
                }
            }
        }
        else
            return false;
    }
    
    public static function userTemDesafio($user, $desafio) {
        $query = "select * from user_desafio where nick=$user and desafio = $desafio";
        if (self::execSelect($query))
            return true;
        return false;
    }
    
    public static function getRating($user_m, $user) {
        $query = "select * from user_rating where user_m = $user_m and user=$user";
        if ($result = self::execSelect($query))
            return $result["rating"];
        return null;
    }

    public static function listUser($nick, $passwd) {
        $query = "select cod, nick, apelido, description, avatar, rating, color ".
            "from user where ".
            "nick='$nick' and passwd='$passwd'";
        if ($result = self::execSelect($query))
            return $result;
        return null;
    }

    public static function listUserByCod($cod) {
        $query = "select cod, nick, apelido, description, avatar, rating, color ".
            "from user where cod=$cod";
        if ($result = self::execSelect($query))
            return $result;
        return null;
    }
    
    public static function Ranking() {
        $user_desafio = array();
        $jogadores = self::listUsers();
        $desafios = self::listDesafios();
        foreach ($jogadores as $jogador) {
            $user_desafio[$jogador["nick"]]["num"] = 0;
            $user_desafio[$jogador["nick"]]["cod"] = $jogador["cod"];
            foreach ($desafios as $value) {
                if (self::listUserDesafioByCod($jogador["cod"],$value["cod"]) != NULL) {
                    $user_desafio[$jogador["nick"]]["num"]++;
                }
            }
        }
        rsort($user_desafio);
        return $user_desafio;
    }

    public static function listUserDesafio() {
        $user_desafio = array();
        $jogadores = self::listUsers();
        $desafios = self::listDesafios();
        foreach ($jogadores as $jogador) {
            foreach ($desafios as $value) {
                if (self::listUserDesafioByCod($jogador["cod"],$value["cod"]) == NULL) {
                    $user_desafio[$jogador["nick"]][$value["name"]] = 0;
                } else {
                    $user_desafio[$jogador["nick"]][$value["name"]] = 1;
                }
            }
        }
        return $user_desafio;
    }
    

    public static function listUsers() {
        $query = "select cod, nick, apelido, description, avatar, rating, color from user";
        $con = self::conMySQL();
        $response = array();
        
        if ($result = $con->query($query)) {
            while ($row = $result->fetch_assoc()) {
                $temp_arr = array();
                foreach ($row as $key => $value ) {
                    $temp_arr[$key] = $value;
                }
                array_push($response, $temp_arr);
            }
        }
        return $response;
    }

    public static function listInfoDesafios() {
        $query = "select * from info_desafio";
        $con = self::conMySQL();
        $response = array();
        
        if ($result = $con->query($query)) {
            while ($row = $result->fetch_assoc()) {
                $temp_arr = array();
                foreach ($row as $key => $value ) {
                    $temp_arr[$key] = $value;
                }
                array_push($response, $temp_arr);
            }
        }
        return $response;
    }

    public static function listFeed() {
        $query = "select * from feed order by cod limit 10";
        $con = self::conMySQL();
        $response = array();
        
        if ($result = $con->query($query)) {
            while ($row = $result->fetch_assoc()) {
                $temp_arr = array();
                foreach ($row as $key => $value ) {
                    $temp_arr[$key] = $value;
                }
                array_push($response, $temp_arr);
            }
        }
        return $response;
    }

    public static function listDesafios() {
        $query = "select * from desafio";
        $con = self::conMySQL();
        $response = array();
        
        if ($result = $con->query($query)) {
            while ($row = $result->fetch_assoc()) {
                $temp_arr = array();
                foreach ($row as $key => $value ) {
                    $temp_arr[$key] = $value;
                }
                array_push($response, $temp_arr);
            }
        }
        return $response;
    }

    public static function listDesafiosByUser($cod) {
        $query = "select desafio.name, desafio.img, desafio.tipo from user_desafio inner join desafio on desafio.cod=user_desafio.desafio where nick=$cod order by name";
        $con = self::conMySQL();
        $response = array();
        
        if ($result = $con->query($query)) {
            while ($row = $result->fetch_assoc()) {
                $temp_arr = array();
                foreach ($row as $key => $value ) {
                    $temp_arr[$key] = $value;
                }
                array_push($response, $temp_arr);
            }
        }
        return $response;
    }

    public static function listUserDesafioByCod($nick, $desafio) {
        $query = "select * from user_desafio where nick=$nick and desafio=$desafio";
        if ($result = self::execSelect($query))
            return $result;
        return null;
    }
    
    public static function getAvatarByCod($cod) {
        $query = "select img from avatar where cod = $cod";
        if ($result = self::execSelect($query))
            return $result["img"];
        return null;
    }
    public static function getCodByAvatar($img) {
        $query = "select cod from avatar where img = '$img'";
        if ($result = self::execSelect($query))
            return $result["cod"];
        return null;
    }

}

//var_dump(HandlerSQL::createUser('paulojrb', 'Robert', 'ola amigo...', 'pass', '1', 'red', 'daniel.jpg'));
