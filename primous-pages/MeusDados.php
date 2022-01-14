<div class="portlet-header">
                                <div class="caption">Meus Dados</div>
                                <div class="tools"><div class="caption">Pedidos: <span style="color: #ed5565">OFF</span></div></div>
                            </div>
                            <div class="portlet-body">
                            <?	
extract($_GET);
extract($_POST);
if($action == "F_editar"){
	$sql = "UPDATE primous_usuarios SET programa='$programa', usuario='$usuario', email='$email', senha='$senha'
	WHERE id=".$_SESSION["admin_id"];
	$res = mysql_query($sql) or die(mysql_error());
	if($res){
		echo "<div class='alert alert-success'><strong>Sucesso!</strong> Editado Com Sucesso.</div>";
	}else{
		echo "<div class='alert alert-error'><strong>Sucesso!</strong> Ocorreu um Erro.</div>";
	}
}
	$sql_f = "SELECT * FROM primous_usuarios WHERE id='".$_SESSION["admin_id"]."' LIMIT 1";
	$res_f = mysql_query($sql_f) or die(mysql_error());
	$row_f = mysql_fetch_array($res_f);
	$action = "F_editar";
?>
                                <form role="form" method="post" action="?cp=<?=$cp?>&c=<?=$c?>" class="form-horizontal">
                                <input type="hidden" name="action" value="<?=$action?>" />
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group"><label class="col-md-3 control-label">Nome:</label>

                                                <div class="col-md-9"><input type="text"name="usuario" class="form-control" value="<?=$row_f[usuario]?>"/></div>
                                            </div>
                                            <div class="form-group"><label class="col-md-3 control-label">Email:
                                                </label>

                                                <div class="col-md-9"><input type="text"
                                                                             class="form-control" name="email" value="<?=$row_f[email]?>"/></div>
                                                
                                            </div>
                                            

                                            <div class="form-group"><label class="col-md-3 control-label">Senha:</label>

                                                <div class="col-md-9"><input type="password"
                                                   class="form-control" name="senha" value="<?=$row_f[senha]?>"/></div>
                                            </div>


                                            <div class="form-group"><label class="col-md-3 control-label">Programa:
                                                </label>

                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="programa" value="<?=$row_f[programa]?>"/> 
                                                </div>
                                            </div>
                                            
                                            

       
                                              
                                            <div class="col-md-offset-9 ">
                                            <input type="submit" class="btn btn-primary btn-outlined" value="Alterar"/>
                                                </div>
                                        </div>
                                    </div>
                                </form>
                            </div>