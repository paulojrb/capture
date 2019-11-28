create user 'ydb'@'localhost' IDENTIFIED BY 'pass';
create database ydb;
grant all privileges on ydb.* to 'ydb'@'localhost';
use ydb;

create table user(
    cod int not null primary key auto_increment,
    nick varchar(50) not null,
    passwd varchar(64) not null,
    apelido varchar(40) null,
    description varchar(100) null,
    avatar int null,
    rating int null,
    token int not null,
    color varchar(30) null
);

create table desafio(
    cod int not null primary key auto_increment,
    name varchar(50),
    img varchar(50) null,
    tipo varchar(100),
    token varchar(64)
);

create table user_rating(
    cod int not null primary key auto_increment,
    user_m int not null,
    user int not null,
    rating int not null
);

create table info_desafio(
    cod int not null primary key auto_increment,
    name varchar(50) not null,
    description varchar(1000) not null,
    type varchar(100) not null
);

create table token(
    cod int not null primary key auto_increment,
    token varchar(64)
);

create table avatar(
    cod int not null primary key auto_increment,
    img varchar(50) not null
);

create table feed(
    cod int not null primary key auto_increment,
    user int not null,
    comment varchar(200) null,
    data timestamp not null
);

create table user_desafio(
    cod int not null primary key auto_increment,
    nick int not null,
    desafio int not null,
    data timestamp not null
);


insert into feed (user, comment, data) values (1,'<b>A0 de Redirecionamentos invalidos</b>.', now());
insert into feed (user,comment, data) values (1,'<b>A4 de Referencia insegura e direta a objetos (IDOR)</b>.', now());
insert into feed (user,comment, data) values (2,'<b>A1 de Exposicao de dados sensiveis</b>.', now());
insert into feed (user,comment, data) values (5,'<b>A1 de Redirecionamentos invalidos</b>.', now());
insert into feed (user,comment, data) values (6,'<b>A4 de Cross-Site Request Forgery (CSRF)</b>.', now());
insert into feed (user,comment, data) values (6,'<b>A2 de Utilizacao de componentes vulneraveis</b>.', now());
insert into feed (user,comment, data) values (6,'<b>A1 Quebra de autenticacao e hestao de sessao</b>.', now());

insert into token (token) values (SHA2('desafio_1', 256));
insert into token (token) values (SHA2('desafio_2', 256));
insert into token (token) values (SHA2('desafio_3', 256));
insert into token (token) values (SHA2('desafio_4', 256));
insert into token (token) values (SHA2('desafio_5', 256));
insert into token (token) values (SHA2('desafio_6', 256));

insert into user (rating, nick, passwd, apelido, description, token, color) values (4, 'elliot', SHA2('pass', 256), 'mr robot', 'Ola amigo', 1, 'olive');
insert into user (rating, nick, passwd, apelido, description, token, color) values (2,'tyrell', SHA2('pass', 256), 'tyrell wellick', 'bonsoir elliot', 1, 'red');
insert into user (rating, nick, passwd, apelido, description, token, color) values (1,'darlene', SHA2('pass', 256), 'darlene alderson', 'foda-se', 1, 'red');
insert into user (rating, nick, passwd, apelido, description, token, color) values (1,'philip', SHA2('pass', 256), 'philip price', 'god group', 1, 'red');
insert into user (rating, nick, passwd, apelido, description, token, color) values (3,'leon', SHA2('pass', 256), 'dragon', 'quale primo', 1, 'red');
insert into user (rating, nick, passwd, apelido, description, token, color) values (2,'zhang', SHA2('pass', 256), 'white rose', 'controll', 1, 'red');


insert into avatar (img) values ('christian.jpg');
insert into avatar (img) values ('daniel.jpg');
insert into avatar (img) values ('elliot.jpg');
insert into avatar (img) values ('elyse.png');
insert into avatar (img) values ('ade.jpg');
insert into avatar (img) values ('helen.jpg');
insert into avatar (img) values ('jenny.jpg');
insert into avatar (img) values ('joe.jpg');
insert into avatar (img) values ('kristy.png');
insert into avatar (img) values ('laura.jpg');
insert into avatar (img) values ('matt.jpg');
insert into avatar (img) values ('matthew.png');
insert into avatar (img) values ('molly.png');
insert into avatar (img) values ('nan.jpg');
insert into avatar (img) values ('rachel.png');
insert into avatar (img) values ('steve.jpg');
insert into avatar (img) values ('veronika.jpg');
insert into avatar (img) values ('zoe.jpg');
insert into avatar (img) values ('stivie.jpg');
insert into avatar (img) values ('patrick.png');
insert into avatar (img) values ('lindsay.png');

update user set avatar = 12 where cod = 1;
update user set avatar = 7 where cod = 2;
update user set avatar = 2 where cod = 3;
update user set avatar = 5 where cod = 4;
update user set avatar = 11 where cod = 5;
update user set avatar = 9 where cod = 6;

insert into user_desafio (nick, desafio, data) values (1, 1, now());
insert into user_desafio (nick, desafio, data) values (1, 3, now());
insert into user_desafio (nick, desafio, data) values (1, 5, now());
insert into user_desafio (nick, desafio, data) values (1, 6, now());

insert into user_desafio (nick, desafio, data) values (2, 2, now());

insert into user_desafio (nick, desafio, data) values (3, 2, now());
insert into user_desafio (nick, desafio, data) values (3, 3, now());


insert into user_desafio (nick, desafio, data) values (4, 1, now());
insert into user_desafio (nick, desafio, data) values (4, 6, now());


insert into user_desafio (nick, desafio, data) values (5, 1, now());
insert into user_desafio (nick, desafio, data) values (5, 3, now());
insert into user_desafio (nick, desafio, data) values (5, 5, now());


insert into user_desafio (nick, desafio, data) values (6, 1, now());
insert into user_desafio (nick, desafio, data) values (6, 3, now());
insert into user_desafio (nick, desafio, data) values (6, 5, now());

insert into user_rating (user_m, user, rating) values (1, 1, 3);
insert into user_rating (user_m, user, rating) values (1, 2, 3);
insert into user_rating (user_m, user, rating) values (1, 3, 3);
insert into user_rating (user_m, user, rating) values (1, 4, 3);
insert into user_rating (user_m, user, rating) values (1, 5, 3);
insert into user_rating (user_m, user, rating) values (1, 6, 3);

insert into user_rating (user_m, user, rating) values (2, 1, 1);
insert into user_rating (user_m, user, rating) values (2, 2, 1);
insert into user_rating (user_m, user, rating) values (2, 3, 1);
insert into user_rating (user_m, user, rating) values (2, 4, 1);
insert into user_rating (user_m, user, rating) values (2, 5, 1);
insert into user_rating (user_m, user, rating) values (2, 6, 1);

insert into user_rating (user_m, user, rating) values (3, 1, 1);
insert into user_rating (user_m, user, rating) values (3, 2, 1);
insert into user_rating (user_m, user, rating) values (3, 3, 1);
insert into user_rating (user_m, user, rating) values (3, 4, 1);
insert into user_rating (user_m, user, rating) values (3, 5, 1);
insert into user_rating (user_m, user, rating) values (3, 6, 1);

insert into user_rating (user_m, user, rating) values (4, 1, 1);
insert into user_rating (user_m, user, rating) values (4, 2, 1);
insert into user_rating (user_m, user, rating) values (4, 3, 1);
insert into user_rating (user_m, user, rating) values (4, 4, 1);
insert into user_rating (user_m, user, rating) values (4, 5, 1);
insert into user_rating (user_m, user, rating) values (4, 6, 1);

insert into user_rating (user_m, user, rating) values (5, 1, 1);
insert into user_rating (user_m, user, rating) values (5, 2, 1);
insert into user_rating (user_m, user, rating) values (5, 3, 1);
insert into user_rating (user_m, user, rating) values (5, 4, 1);
insert into user_rating (user_m, user, rating) values (5, 5, 1);
insert into user_rating (user_m, user, rating) values (5, 6, 1);

insert into user_rating (user_m, user, rating) values (6, 1, 1);
insert into user_rating (user_m, user, rating) values (6, 2, 1);
insert into user_rating (user_m, user, rating) values (6, 3, 1);
insert into user_rating (user_m, user, rating) values (6, 4, 1);
insert into user_rating (user_m, user, rating) values (6, 5, 1);
insert into user_rating (user_m, user, rating) values (6, 6, 1);


insert into info_desafio (name,description, type) values ('Registro e Monitorização','Monitorar atividades suspeitas é uma parte importante em manter seu sistema seguro, evita vários ataques e viabiliza a respostas a incidentes.', 'Configurações de segurança incorretas');

insert into info_desafio (name,description, type) values ('Componentes vulneráveis','Sua aplicação pode está bem protegida, porém componentes podem trazer vetores de ataques, revisar versões para identificar vulnerabilidades é parte importante em manter um sistema seguro.', 'Configurações de segurança incorretas');

insert into info_desafio (name,description, type) values ('Linguagem de script','Para resolver esse desafio você precisa entender porque uma falha de Cross-Site Scripting acontece e quais os vetores de ataque, lembre-se não é porque você não vê, que não está lá.', 'Cross-Site Scripting');

insert into info_desafio (name,description, type) values ('Configurações de segurança','Configurar bem um servidor ou aplicação é crucial para mater o sistema seguro, porém manter senha default ou muito fraca ainda é muito comum.', 'Configurações');

insert into info_desafio (name,description, type) values ('Quebra de controle de acesso','As restrições sobre o que os utilizadores autenticados estão autorizados a fazer nem sempre são corretamente verificadas. Os atacantes podem abusar destas falhas para aceder a funcionalidades ou dados para os quais não têm autorização.', 'Controle de acesso');

insert into info_desafio (name,description, type) values ('Exposição de dados sensíveis','No desenvolvimento de uma aplicação é comum ver deixar comentários de debugging, porém isso pode se tornar uma falha grave, revise seus cometários!', 'Dados sensíveis');

insert into info_desafio (name,description, type) values ('Quebra de autenticação','Outras vulnerabilidades pode causar consequencias em vários pilares da segurança da informação, a quebra de autenticação é uma delas.', 'Autenticação');

insert into info_desafio (name,description, type) values ('SQL Injection','A mais comum e a mais grave, tome cuidado em qualquer campo que possa ser manipulado pelo usuário, caso uma falha dessa ocorra seu sistema pode ser totalmente comprometido.', 'Injeção');


insert into desafio (tipo,img,name, token) values ('Injeção','astronaut.svg','A1', SHA2('A1hrthrthrhtrtX', 256));
-- CC1F26DFBB9758FB04041FE6C477B05802A92C1C77B05B6CC289D79A752E534E
insert into desafio (tipo,img,name, token) values ('Quebra de autenticação','black-hole.svg','A2', SHA2('A2j7667j6j67X', 256));
-- EA6A9BD2A035C90ABAC2DE4DFD4210EF4438905EC4EB408625B79F44D8BE55C1
insert into desafio (tipo,img,name, token) values ('Exposição de dados sensíveis','universe.svg','A3', SHA2('A35h5hj56j7@X', 256));
-- 140FFB741B1B7F7EAB6C3C35959DB2CBC3B02089A4E6262E88C79F02FEE11113
insert into desafio (tipo,img,name, token) values ('Entidades externas de XML(XXE)','space-shuttle.svg','A4', SHA2('yjjt56@X', 256));
-- 3081080D95B5DEEDD3F32B06F428D15E94F26EE8CDD6E4A279C08B8EBD3D3336
insert into desafio (tipo,img,name, token) values ('Quebra de controle de acesso','solar-system.svg','A5', SHA2('A12312312dd1X', 256));
-- 6BD90B9D5853F14BB78A2947D6C7E6FA68CFED7CD225A42F76C4FA27B6A22DB1
insert into desafio (tipo,img,name, token) values ('Configurações de segurança incorretas','mars.svg','A6', SHA2('@@23423', 256));
-- 59512AA6C0B6534B6426F77EDB15DCACA14A7C47E572F8F1C237A0FC7F653F2D
insert into desafio (tipo,img,name, token) values ('Cross-Site Scripting','orbit.svg','A7', SHA2('luasdasdaasdasdas', 256));
-- B1D18BF28DA6A5565C7634AC9E33EF22B26E4A62ED7CD672E2D45CB749EEDF8C
insert into desafio (tipo,img,name, token) values ('Desserialização insegura','half-moon.svg','A8', SHA2('fzzz3fs3fs3aaa@@11', 256));
-- 539A531D2A8AC762A0DC4A95D1AD57AFF1308D6548035EEC81335B70B571208D
insert into desafio (tipo,img,name, token) values ('Utilização de componentes vulneráveis','comet.svg','A9', SHA2('f1fs3fssdas13aaa@@11', 256));
-- 95DDFD50D02AA441B347A64DBAC21524BAD0618DD4F53B3B8792342D00264913
insert into desafio (tipo,img,name, token) values ('Registro e monitorização insuficientes','milky-way.svg','A10', SHA2('erferfcwwer.', 256));
-- E2B520EEB2BCD332DCD107BC8ED3AE07F606F6FD5B35B113BC7C3808B7A4D222