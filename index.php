<? 
session_start();
include("primous-config/config.inc.php");
include("primous-config/connect.php");
include("primous-config/autentica_user.php");
include("primous-config/functions.php");
if(!$cp){
	$cp = $_GET['pg'];
	$c = $_GET['p'];
	$tp_id=$_POST["tp_id"];
}
	$sql = "SELECT * FROM primous_usuarios WHERE id='".$_SESSION["admin_id"]."' LIMIT 1";
	$ver = mysql_query($sql) or die(mysql_error());
	$verr = mysql_fetch_array($ver);

        $codificada = base64_encode($senha);

$sql = "SELECT * FROM primous_config WHERE id='1' LIMIT 1";
	$configs = mysql_query($sql) or die(mysql_error());
	$configsa = mysql_fetch_array($configs);

?>
<?php

if (isset($_GET['Deslogar'])) {

    session_destroy();

echo "<script>window.location='login.php?fail=deslogar'</script>";

	exit(); }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head><title>Primous Admin 3.0 - <?=$configsa['nomeradio'];?> - <?=$configsa['slogan'];?></title>
    <meta charset="utf-8">
    <meta http-equiv="content-Language" content="pt-br">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewpoint" content="width=device-width, initial-scale=1.0">
    <link href="images/favicon.png" rel="shortcut icon">
    <!--Loading bootstrap css-->
    <link type="text/css"
          href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,800italic,400,700,800">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
    <link type="text/css" rel="stylesheet"
          href="vendors/jquery-ui-1.10.3.custom/css/ui-lightness/jquery-ui-1.10.3.custom.css">
    <link type="text/css" rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="vendors/bootstrap/css/bootstrap.min.css">
    <!--LOADING SCRIPTS FOR PAGE-->
    <link type="text/css" rel="stylesheet" href="vendors/jquery-news-ticker/jquery.news-ticker.css">
    <link type="text/css" rel="stylesheet" href="vendors/jquery-jvectormap/jquery-jvectormap-1.2.2.css">
    <!--Loading style vendors-->
    <link type="text/css" rel="stylesheet" href="vendors/animate.css/animate.css">
    <link type="text/css" rel="stylesheet" href="vendors/jquery-pace/pace.css">
    <!--Loading style-->
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <link type="text/css" rel="stylesheet" href="css/style-mango.css" id="theme-style">
    <link type="text/css" rel="stylesheet" href="css/vendors.css">
    <link type="text/css" rel="stylesheet" href="css/themes/default.css" id="color-style">
    <link type="text/css" rel="stylesheet" href="css/style-responsive.css">
    <link rel="shortcut icon" href="http://www.next-themes.com/mango/code/images/favicon.ico">
</head>
<body>
<div>
    <!--BEGIN TO TOP--><a id="totop" href="#"><i class="fa fa-angle-up"></i></a><!--END BACK TO TOP-->
    <div id="wrapper"><!--BEGIN TOPBAR-->
        <nav id="topbar" role="navigation" style="margin-bottom: 0;" class="navbar navbar-default navbar-static-top">
            <div class="navbar-header">
                <button type="button" data-toggle="collapse" data-target=".sidebar-collapse" class="navbar-toggle"><span
                        class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span
                        class="icon-bar"></span><span class="icon-bar"></span></button>
                <a id="logo" href="index.php" class="navbar-brand"><img src="images/logo.png" ></a></div>
            <div class="topbar-main"><a id="menu-toggle" href="#" class="btn hidden-xs"><i class="fa fa-bars"></i></a>

                
                    <div id="box-bem-vindo"> Bem vindo(a) <b><?=$verr['usuario'];?></b> ao painel Primous Admin 3.0</div>
                
                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown"><a data-toggle="dropdown" href="#" class="dropdown-toggle"><i
                            class="fa fa-user fa-fw"></i></a>
                        <ul class="dropdown-menu dropdown-alerts animated bounceInDown">
                            <li><a href="#"><span class="label label-blue"><i class="fa fa-comment fa-fw"></i></span>  Bate - Papo</a></li>
                            <li><a href="#"><span class="label label-violet"><i class="fa fa-twitter fa-fw"></i></span>Twitter</a></li>
                            <li><a href="#"><span class="label label-pink"><i class="fa fa-envelope fa-fw"></i></span>Pedidos</a></li>
                            <li><a href="#"><span class="label label-green"><i class="fa fa-tasks fa-fw"></i></span>Dados Locutor</a></li>
                            <li><a href="#"><span class="label label-yellow"><i class="fa fa-upload fa-fw"></i></span>Vinhetas</a></li>
                            <li></li>
                        </ul>
                    </li>
                     <li class="dropdown"><a data-toggle="dropdown" href="#" class="dropdown-toggle"><i
                            class="fa fa-envelope fa-fw"></i></a>
                        <ul class="dropdown-menu dropdown-messages animated bounceInUp">
                            <?
    $sqlped ="SELECT id, pedido, nome, estado, data FROM primous_pedidos";
	$sqlped.=" ORDER BY data DESC LIMIT 5";
    $resped = mysql_query($sqlped) or die(mysql_error());
    $i=1;
    $total = mysql_num_rows($resped);
    while($pedidos=mysql_fetch_array($resped)){
    ?>
                            <li>
                                <button type="button" data-target="#modal-default<?=$pedidos[id]?>" data-toggle="modal" class="class-button-pedidos">
                                   <?=$pedidos[nome]?></br>
                                    <span><b><?=$pedidos[estado]?></b></span>
                                </button>
                            </li>
     <?
        $i++;
    }
    ?>
                            <li><a href="#">Ver Todos Pedidos</a></li>
                        </ul>
                    <li class="dropdown hi"><a data-toggle="dropdown" href="#" class="dropdown-toggle"><img
                            src="<?=$verr['imagem'];?>" alt="" class="img-responsive img-circle"/>&nbsp;
                        <?=$verr['usuario'];?>
                        &nbsp;<span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-user pull-right animated bounceInLeft">
                            <li>
                                <div class="navbar-content">
                                    <div class="row">
                                        <div class="col-md-5 col-xs-5"><img
                                                src="<?=$verr['imagem'];?>" style="width: 103px; height: 103px;" alt=""
                                                class="img-responsive img-circle"/>

                                            <p class="text-center mtm"><a href="#" class="change-avatar">
                                                <small>Alterar Imagem</small>
                                            </a></p>
                                        </div>
                                        <div class="col-md-7 col-xs-5"><span><?=$verr['usuario'];?></span>

                                            <p class="text-muted small"><?=$verr['email'];?></p>

                                            <div class="divider"></div>
                                            <a href="#" class="btn btn-primary btn-sm">Ver Pefil</a></div>
                                    </div>
                                </div>
                                <div class="navbar-footer">
                                    <div class="navbar-footer-content">
                                        <div class="row">
                                            <div class="col-md-6 col-xs-6"><a href="index.php?pg=1&p=11" class="btn btn-default btn-sm">Alterar Rede Social</a></div>
                                            <div class="col-md-6 col-xs-6"><a href="index.php?Deslogar=1"
                                                                              class="btn btn-default btn-sm pull-right">Sair</a></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <!--END TOPBAR--><!--BEGIN SIDEBAR MENU-->
        <nav id="sidebar" role="navigation" class="navbar-default navbar-static-side">
            <div class="sidebar-collapse menu-scroll">
                <ul id="side-menu" class="nav">
                    <li class="clock"><strong id="get-date"></strong>

                        <div class="digital-clock">
                            <div id="getHours" class="get-time"></div>
                            <span>:</span>

                            <div id="getMinutes" class="get-time"></div>
                            <span>:</span>

                            <div id="getSeconds" class="get-time"></div>
                        </div>
                    </li>
                    <li class="sidebar-heading"><center><h4 style="text-transform: uppercase;"><?=$configsa['nomeradio'];?></h4></center></li>
                    <?php include('primous-pages/menu.php'); ?>
                </ul>
            </div>
        </nav>
        <!--END SIDEBAR MENU--><!--BEGIN PAGE WRAPPER-->
        <div id="page-wrapper"><!--BEGIN PAGE HEADER & BREADCRUMB-->
            <div class="page-header-breadcrumb">
                <div class="page-heading hidden-xs"><h1 class="page-title" data-hover="tooltip" data-placement="bottom" title="Cargo Atual é:"><?php $sql_c = mysql_query("SELECT * FROM primous_usuario_rel r, primous_cargos t WHERE r.tp_usr_id=t.tp_usr_id AND r.usr_id='".$_SESSION['admin_id']."' ORDER BY t.tp_usr_ordem");while($ver_c=mysql_fetch_array($sql_c)){echo $ver_c['tp_usr_nome'].",";}?></h1></div>
                <ol class="breadcrumb page-breadcrumb">
                    <li><i class="fa fa-microphone"></i>&nbsp;<b>NoAIR:</b>&nbsp;&nbsp;Wallacy Guimarães &nbsp;&nbsp;<i
                            class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li>&nbsp;<b>Com:&nbsp;&nbsp;</b>No Breack</li>
                </ol>            </div>
            <!--END PAGE HEADER & BREADCRUMB--><!--BEGIN CONTENT-->
            <div class="page-content">  
                <div class="row">
                
                
                
                    <div class="col-lg-12">
                    
                    
                        <div class="portlet">
                        <!-- CONTEUDO site -->
                          <?php include('primous-pages/conteudo.php'); ?>
                            <!-- FIM CONTEUDO SITE -->
                        </div>
                    </div>
                </div>
                
            </div>
            <!--END CONTENT--><!--BEGIN FOOTER-->
            <div class="page-footer">
                <div class="copyright">2014 © Primous Admin - Todos Direitos Reservados - <b><a href="http://primousdesign.com" target="_black">PRIMOUS DESIGN</a></b>.</div>
            </div>
            <!--END FOOTER--></div>
        <!--END PAGE WRAPPER--></div>
</div>

<?
    $sqlpd ="SELECT id, pedido, nome, estado, data FROM primous_pedidos";
    $respd = mysql_query($sqlpd) or die(mysql_error());
    $total = mysql_num_rows($respd);
    while($verped=mysql_fetch_array($respd)){
    ?>
<div id="modal-default<?=$verped[id]?>" tabindex="-1" role="dialog" aria-labelledby="modal-default-label"
                     aria-hidden="true" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" data-dismiss="modal" aria-hidden="true"
                                        class="close">&times;</button>
                                <h4 id="modal-default-label" class="modal-title"><?=$verped[nome]?></h4></div>
                            <div class="modal-body"><?=$verped[pedido]?></div>
                            <div class="modal-footer">
                                <button type="button" data-dismiss="modal" class="btn btn-primary">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
 <? }?>



<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
<!--loading bootstrap js-->
<script src="vendors/bootstrap/js/bootstrap.min.js"></script>
<script src="vendors/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js"></script>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<script src="vendors/metisMenu/jquery.metisMenu.js"></script>
<script src="vendors/slimScroll/jquery.slimscroll.js"></script>
<script src="vendors/jquery-cookie/jquery.cookie.js"></script>
<script src="js/jquery.menu.js"></script>
<script src="vendors/jquery-pace/pace.min.js"></script>
<!--LOADING SCRIPTS FOR PAGE-->
<script src="vendors/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="vendors/moment/moment.js"></script>
<script src="vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="vendors/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script src="vendors/bootstrap-clockface/js/clockface.js"></script>
<script src="vendors/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script src="vendors/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script src="vendors/jquery-maskedinput/jquery-maskedinput.js"></script>
<script src="js/form-components.js"></script>
<!--CORE JAVASCRIPT-->
<script src="js/app.js"></script>
<script src="js/main.js"></script>
<script src="js/holder.js"></script>
<script type="text/javascript">(function (i, s, o, g, r, a, m) {
    i['GoogleAnalyticsObject'] = r;
    i[r] = i[r] || function () {
        (i[r].q = i[r].q || []).push(arguments)
    }, i[r].l = 1 * new Date();
    a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
    a.async = 1;
    a.src = g;
    m.parentNode.insertBefore(a, m)
})(window, document, 'script', '../../../www.google-analytics.com/analytics.js', 'ga');
ga('create', 'UA-145464-11', 'next-themes.com');
ga('send', 'pageview');


</script>
</body>
</html>