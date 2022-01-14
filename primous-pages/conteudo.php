<?



if($c){

	$nav = $c;

}else{

	$nav = $cp;

}

if(!$nav){

	//$nav = $admin["paizao"];

}

if($nav){

			$sql = "SELECT * FROM primous_canais c \n".

					"WHERE c.aca_id LIKE '$nav' \n".

					"AND c.aca_status='Ativo'\n".

					"LIMIT 1";

			$sql = "SELECT * FROM primous_canais c, primous_permissao p , primous_usuario_rel r \n".

					"WHERE c.aca_id LIKE '$nav' \n".

					"AND r.usr_id='".$_SESSION["admin_id"]."'\n".

					"AND r.tp_usr_id=p.tp_usr_id\n".

					"AND c.aca_id=p.aca_id \n".

					"GROUP BY p.aca_id\n".

					"LIMIT 1";

			$res = mysql_query($sql) or die(mysql_error());

			if(mysql_num_rows($res) > 0){

				$row = mysql_fetch_array($res);

				## LOG DE EVENTOS ##

				$action=$_GET["action"];

				if($action == ""){

					$action=$_POST["action"];

				}

				if($action != "editar" && $action != "inserir" && $action){

					$post = busca_post();

					$get = busca_get();

					$ip = $_SERVER["REMOTE_ADDR"];

					$sql = "INSERT INTO primous_log_usuario (usr_id, log_ip, log_data, log_action, aca_id, log_varpost, log_varget) 

										VALUES ('".$_SESSION[admin_nome]."', '$ip', '".time()."', '$action', '$row[aca_id]', '$post', '$get')";

					$res = mysql_query($sql) or die(mysql_error());

				}

				####################

				include($row[aca_diretorio]);

			}else{

				echo "	<script>

							alert('Esse canal nao existe ou voce nao tem as devidas permissoes');

							location.href='index.php'

						</script>";

			}

?>		

<?

}else{

	include("./primous-pages/inicio.php");

}

?>       

          