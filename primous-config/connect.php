<?
/*
* Painel Zone Admin 2.0
* Mais informações pelo skype: higorsales.web / dj12mauricio
* www.radioplayzone.com.br
*/
session_start();
$conn =mysql_connect($_dbHost,$_dbUser,$_dbPasswd);
if($conn){
	mysql_select_db($_dbDatabase);
}else{
	echo "Erro ao conectar-se com o banco";
	exit;
}
?>
