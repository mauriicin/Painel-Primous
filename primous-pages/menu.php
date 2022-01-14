<li><a href="index.php"><i class="fa fa-home fa-fw"></i>&nbsp;
                        Home</a>
                    </li>
<?
	$sql = "SELECT * \n".
			"FROM primous_canais c, primous_permissao p, primous_usuario_rel r \n".
			"WHERE c.aca_status = 'Ativo' \n".
			"AND r.usr_id='".$_SESSION["admin_id"]."'\n".
			"AND r.tp_usr_id=p.tp_usr_id\n".
			"AND c.aca_id=p.aca_id \n".
			"AND (c.aca_pai IS NULL OR c.aca_pai = 0) \n".
			"GROUP BY p.aca_id\n".
			"ORDER BY c.aca_ordem";
	$res = mysql_query($sql) or die(mysql_error());
	while($row = mysql_fetch_array($res)){
?>
<li>
                          <a href="#"><i class="<?=$row['aca_imagem'];?>"></i>&nbsp;
                        <?=$row['aca_nome'];?><span class="fa arrow"></span></a>
<ul class="nav nav-second-level">
<?php
$sub = mysql_query(" SELECT * FROM primous_canais c, primous_permissao p, primous_usuario_rel r WHERE c.aca_pai = $row[aca_id] AND c.aca_status='Ativo' AND r.usr_id=$_SESSION[admin_id] AND r.tp_usr_id=p.tp_usr_id AND c.aca_id=p.aca_id GROUP BY p.aca_id ORDER BY c.aca_ordem ");
while ($ver = mysql_fetch_array ($sub)){
?>

<li>
                           <a href="index.php?pg=<?=$row['aca_id'];?>&p=<?=$ver['aca_id'];?>">
                                 <?=$ver['aca_nome'];?>
                            </a>
                        </li> 

<? }  ?>
</ul>
</li>
<? }  ?>
<li class="sidebar-heading"><h4>Extras</h4></li>
<li><a href=""><i class="fa fa-bar-chart-o fa-fw"></i>&nbsp; Chat Equipe</a></li>
<li><a href=""><i class="fa fa-eye fa-fw"></i>&nbsp; Uploads</a></li>
<li><a href=""><i class="fa fa-eye fa-fw"></i>&nbsp; Logs de Entrada</a></li>


                        
                           
                        
               