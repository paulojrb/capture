<?php

class HandlerSQL {

    public static function conMySQL() {
        return new mysqli("localhost", "ydb",
            "pass", "ydb");
    }

    public static function insert($query) {
        $con = self::conMySQL();
        $end = $con->query($query);
        $con->close();
        if ($end === true) { return true; }
        else { return false; }
	}
    
    public static function all() {
        $query = "insert into desafio (tipo,img,name, token) values ('Injeção','astronaut.svg','A1', SHA2('A1hrthrthrhtrtX', 256));";
        if ( !self::insert($query) ) {
            echo "\n[FALHA] insert :: <*> $query <*>";
        }
        $query = "insert into desafio (tipo,img,name, token) values ('Quebra de autenticação','black-hole.svg','A2', SHA2('A2j7667j6j67X', 256));";
        if ( !self::insert($query) ) {
            echo "\n[FALHA] insert :: <*> $query <*>";
        }
        $query = "insert into desafio (tipo,img,name, token) values ('Exposição de dados sensíveis','universe.svg','A3', SHA2('A35h5hj56j7@X', 256));";
        if ( !self::insert($query) ) {
            echo "\n[FALHA] insert :: <*> $query <*>";
        }
        $query = "insert into desafio (tipo,img,name, token) values ('Entidades externas de XML(XXE)','space-shuttle.svg','A4', SHA2('yjjt56@X', 256));";
        if ( !self::insert($query) ) {
            echo "\n[FALHA] insert :: <*> $query <*>";
        }
        $query = "insert into desafio (tipo,img,name, token) values ('Quebra de controle de acesso','solar-system.svg','A5', SHA2('A12312312dd1X', 256));";
        if ( !self::insert($query) ) {
            echo "\n[FALHA] insert :: <*> $query <*>";
        }
        $query = "insert into desafio (tipo,img,name, token) values ('Configurações de segurança incorretas','mars.svg','A6', SHA2('@@23423', 256));";
        if ( !self::insert($query) ) {
            echo "\n[FALHA] insert :: <*> $query <*>";
        }
        $query = "insert into desafio (tipo,img,name, token) values ('Cross-Site Scripting','orbit.svg','A7', SHA2('luasdasdaasdasdas', 256));";
        if ( !self::insert($query) ) {
            echo "\n[FALHA] insert :: <*> $query <*>";
        }
        $query = "insert into desafio (tipo,img,name, token) values ('Desserialização insegura','half-moon.svg','A8', SHA2('fzzz3fs3fs3aaa@@11', 256));";
        if ( !self::insert($query) ) {
            echo "\n[FALHA] insert :: <*> $query <*>";
        }
        $query = "insert into desafio (tipo,img,name, token) values ('Utilização de componentes vulneráveis','comet.svg','A9', SHA2('f1fs3fssdas13aaa@@11', 256));";
        if ( !self::insert($query) ) {
            echo "\n[FALHA] insert :: <*> $query <*>";
        }
        $query = "insert into desafio (tipo,img,name, token) values ('Registro e monitorização insuficientes','milky-way.svg','A10', SHA2('erferfcwwer.', 256));";
        if ( !self::insert($query) ) {
            echo "\n[FALHA] insert :: <*> $query <*>";
        }
        $query = "insert into info_desafio (name,description, type) values ('Registro e Monitorização','Monitorar atividades suspeitas é uma parte importante em manter seu sistema seguro, evita vários ataques e viabiliza a respostas a incidentes.', 'Configurações de segurança incorretas');";
        if ( !self::insert($query) ) {
            echo "\n[FALHA] insert :: <*> $query <*>";
        }
        $query = "insert into info_desafio (name,description, type) values ('Componentes vulneráveis','Sua aplicação pode está bem protegida, porém componentes podem trazer vetores de ataques, revisar versões para identificar vulnerabilidades é parte importante em manter um sistema seguro.', 'Configurações de segurança incorretas');";
        if ( !self::insert($query) ) {
            echo "\n[FALHA] insert :: <*> $query <*>";
        }
        $query = "insert into info_desafio (name,description, type) values ('Linguagem de script','Para resolver esse desafio você precisa entender porque uma falha de Cross-Site Scripting acontece e quais os vetores de ataque, lembre-se não é porque você não vê, que não está lá.', 'Cross-Site Scripting');";
        if ( !self::insert($query) ) {
            echo "\n[FALHA] insert :: <*> $query <*>";
        }
        $query = "insert into info_desafio (name,description, type) values ('Configurações de segurança','Configurar bem um servidor ou aplicação é crucial para mater o sistema seguro, porém manter senha default ou muito fraca ainda é muito comum.', 'Configurações');";
        if ( !self::insert($query) ) {
            echo "\n[FALHA] insert :: <*> $query <*>";
        }
        $query = "insert into info_desafio (name,description, type) values ('Quebra de controle de acesso','As restrições sobre o que os utilizadores autenticados estão autorizados a fazer nem sempre são corretamente verificadas. Os atacantes podem abusar destas falhas para aceder a funcionalidades ou dados para os quais não têm autorização.', 'Controle de acesso');";
        if ( !self::insert($query) ) {
            echo "\n[FALHA] insert :: <*> $query <*>";
        }
        $query = "insert into info_desafio (name,description, type) values ('Exposição de dados sensíveis','No desenvolvimento de uma aplicação é comum ver deixar comentários de debugging, porém isso pode se tornar uma falha grave, revise seus cometários!', 'Dados sensíveis');";
        if ( !self::insert($query) ) {
            echo "\n[FALHA] insert :: <*> $query <*>";
        }
        $query = "insert into info_desafio (name,description, type) values ('Quebra de autenticação','Outras vulnerabilidades pode causar consequencias em vários pilares da segurança da informação, a quebra de autenticação é uma delas.', 'Autenticação');";
        if ( !self::insert($query) ) {
            echo "\n[FALHA] insert :: <*> $query <*>";
        }
        $query = "insert into info_desafio (name,description, type) values ('SQL Injection','A mais comum e a mais grave, tome cuidado em qualquer campo que possa ser manipulado pelo usuário, caso uma falha dessa ocorra seu sistema pode ser totalmente comprometido.', 'Injeção');";
        if ( !self::insert($query) ) {
            echo "\n[FALHA] insert :: <*> $query <*>";
        }
        $query = "";
        if ( !self::insert($query) ) {
            echo "\n[FALHA] insert :: <*> $query <*>";
        }
        
    }

}

//HandlerSQL::all();
