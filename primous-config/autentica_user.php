<?
if($_SESSION["admin_id"] && $_SESSION["admin_nome"]){
	$sql = "SELECT * FROM primous_usuarios WHERE id='".$_SESSION["admin_id"]."' AND email='".$_SESSION["admin_nome"]."'";
	$res = mysql_query($sql) or die(mysql_error());
	if(mysql_num_rows($res)<=0){
		echo "<script>location.href='login.php'</script>";
	}
}else{
	echo "<script>location.href='login.php'</script>";
}
?>