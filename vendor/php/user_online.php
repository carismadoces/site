<?php
#Contador de usu�rios on-line - Vers�o script para implementar diretamente no site
session_start(); //S� descomente caso seu site n�o tenha uma sess�o j� iniciada
//------------------------Configura��es--------------------------
$host = "localhost"; //servidor de banco de dados
$user = "carismac_user"; //usuario do banco de dados
$senha = "carismac_user"; //senha do banco de dados
$db = "carismac_prod"; //banco de dados


//conex�o com o servidor
$conect = mysql_connect($host, $user, $senha);

// Caso a conex�o seja reprovada, exibe na tela uma mensagem de erro
if (!$conect) die ("<h1>Falha na coneco com o Banco de Dados!</h1>");

// Caso a conex�o seja aprovada, ent�o conecta o Banco de Dados.
$db = mysql_select_db($db);

//---------------------------------------------------------------
date_default_timezone_set("Brazil/East");

$sessao = session_id();
$entrada = time();
//pega o ip
$ip = $_SERVER['REMOTE_ADDR'];
$origem = $_GET['origem'];

$tempo_inativo="10"; //Tempo máximo de inatividade
$sql_delete = "DELETE FROM online WHERE ('$entrada' - ult_click) / 60 >= $tempo_inativo";
$exe_delete = mysql_query($sql_delete) or die (mysql_error());

$sql_busca = "SELECT * FROM online WHERE sessao = '$sessao' AND ip = '$ip'";
$exe_busca = mysql_query($sql_busca) or die (mysql_error());
$num_busca = mysql_num_rows($exe_busca);

// incluir
if ($num_busca == 0){
   $sql_inclu = "INSERT INTO online(entrada, sessao, ult_click, ip) VALUES
               ('$entrada', '$sessao', '$entrada', '$ip')";

   $exe_inclu = mysql_query($sql_inclu) or die (mysql_error());

   // Atualiza contador
   $query_quantidade = "SELECT quantidade FROM contador_usuario WHERE id=1";
   $count = mysql_query($query_quantidade);

   $quantidade= mysql_fetch_row($count);
   $resultado= ((int)$quantidade[0]) +1;

   $sql_contador = "UPDATE contador_usuario set quantidade='$resultado' WHERE id=1";
   mysql_query($sql_contador);

}
else {
//Altera
   $sql_up = "UPDATE online SET ult_click = '$entrada' WHERE sessao = '$sessao' || ip = '$ip'";
   $exe_up = mysql_query($sql_up) or die (mysql_error());
}

$dataAtual = date("Y-m-d H:i:s");

// Atualiza tabela entradas_usuario
$sql_insert_entrada_usuario = "INSERT INTO entradas_usuario(entrada, sessao, ult_click, ip, origem) VALUES
		('$entrada', '$sessao', '$dataAtual', '$ip', '$origem')";

mysql_query($sql_insert_entrada_usuario) or die (mysql_error());

//verifica quantos usuarios est�o online
$sql_online = "SELECT * FROM online";
$exe_online = mysql_query($sql_online) or die (mysql_error());
$num_online = mysql_num_rows($exe_online); //Essa vari�vel cont�m o n�mero de usu�rios on-line
//Insira $num_online em qualquer lugar da sua p�gina.
//Cr�ditos: Jailton
?>
