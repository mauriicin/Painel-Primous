<?
/*
* Painel Zone Admin 2.0
* Mais informações pelo skype: higorsales.web / dj12mauricio
* www.radioplayzone.com.br
*/
?>
<?
$host = "localhost";
$dbuser = "primousd_admin";
$dbpwd = "99847374";
$db = "primousd_admin";
$connect = mysql_pconnect($host, $dbuser, $dbpwd);
if(!$connect)
echo("Could not connect to database...");
else
$select = mysql_select_db($db);
?>