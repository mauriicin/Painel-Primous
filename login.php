<? 
session_start();
include("primous-config/config.inc.php");
include("primous-config/connect.php");
include("primous-config/functions.php");
if($_POST["acao"] == "logar"){
	$login = anti_injecao($_POST["email"]);
	$senha = anti_injecao($_POST["senha"]);
	$sql = "SELECT * FROM primous_usuarios WHERE email='$login' AND senha='$senha' AND ban='0'";
	$res = mysql_query($sql) or die(mysql_error());
	if(mysql_num_rows($res)>0 and $row[ban] < 1){
		$row = mysql_fetch_array($res);
		$_SESSION["admin_id"] = $row[id];
		$_SESSION["admin_nome"] = $login;
		$id = $_SESSION['admin_id'];
		$s = "UPDATE primous_usuarios SET ativo='sim' WHERE id=$id";
		$rs = mysql_query($s) or die(mysql_error());
		
		if($rs = mysql_query($s)){
	    echo "<script>location.href='index.php'</script>";
		} // Linha de Sucesso 
		
	    if($rs = die(mysql_error())){
			echo "<center><div class='alert alert-danger' style='widht:200px; height:50px;'> <b>ERRO!</b> Dados incorreto ou voc&ecirc; est&aacute; banido </div>                    </center>";
	    }// Linha de Erro 
	 }else{
		 echo "<center><div class='alert alert-danger' style='widht:200px; height:50px;'> <b>ERRO!</b> Dados incorreto ou voc&ecirc; est&aacute; banido </div>                    </center>";
	}// Linha de Erro 
	
}// Linha de login


else if($_SESSION["admin_id"] && $_SESSION["admin_nome"]){
	$sqls = "SELECT * FROM primous_usuarios WHERE id='".$_SESSION["admin_id"]."' AND email='".$_SESSION["admin_nome"]."'";
	$resa = mysql_query($sqls) or die(mysql_error());
	if(mysql_num_rows($resa)){
		echo "<script>location.href='index.php'</script>";
	}
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head><title>Login | ÁREA RESTRITA</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewpoint" content="width=device-width, initial-scale=1.0">
    <!--Loading bootstrap css-->
    <link type="text/css"
          href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,800italic,400,700,800">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
    <link type="text/css" rel="stylesheet"
          href="vendors/jquery-ui-1.10.3.custom/css/ui-lightness/jquery-ui-1.10.3.custom.css">
    <link type="text/css" rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="vendors/bootstrap/css/bootstrap.min.css">
    <!--Loading style vendors-->
    <link type="text/css" rel="stylesheet" href="vendors/animate.css/animate.css">
    <!--Loading style-->
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <link type="text/css" rel="stylesheet" href="css/style-mango.css" id="theme-style">
    <link type="text/css" rel="stylesheet" href="css/style-responsive.css">
    <link type="text/css" rel="stylesheet" href="css/vendors.css">
    <link type="text/css" rel="stylesheet" href="css/themes/default.css" id="color-style">
    <link href="images/favicon.png" rel="shortcut icon">
</head>
<body id="signin-page" class="animated bounceInDown">
<div id="signin-page-content">
        <form method="POST">
 <input type="hidden" name="acao" value="logar">
        <h1 class="block-heading">Login 3.0</h1>

        <p>Bem vinda a &aacute;rea Administrativa.</p>

        <div class="form-group">
            <div class="input-icon"><i class="fa fa-user"></i><input type="text" placeholder="Email" name="email" class="form-control" value=""></div>
        </div>
        <div class="form-group">
            <div class="input-icon"><i class="fa fa-key"></i><input type="password" placeholder="Senha" name="senha" class="form-control" value=""></div>
        </div>
        <div class="form-group">
            <button class="btn btn-primary">Entrar
                &nbsp;<i class="fa fa-chevron-circle-right"></i></button>
        </div>
        <hr>
    </form>
</div>
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/jquery-ui.js"></script>
<!--loading bootstrap js-->
<script src="vendors/bootstrap/js/bootstrap.min.js"></script>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<script src="vendors/jquery-cookie/jquery.cookie.js"></script>
</body>
</html>