<div class="portlet-header">
                                <div class="caption">Configuração Rádio</div>
                                <div class="tools"><div class="caption">Pedidos: <span style="color: #ed5565">OFF</span></div></div>
                            </div>
                            <div class="portlet-body">
<?php
if($action == "F_editar"){
$sql = "UPDATE primous_config SET nomeradio='$nomeradio', twitter='$twitter', facebook='$facebook', instagram='$instagram', slogan='$slogan', linksite='$linksite' WHERE id='1'";
$res = mysql_query($sql) or die(mysql_error());
if($res){
	echo "<div class='alert alert-success'><strong>Sucesso!</strong> Editado Com Sucesso.</div>";
	}else{
	echo "<div class='alert alert-error'><strong>Error!</strong> Ocorreu um Erro.</div>";
 }
}
$sql_f = "SELECT * FROM primous_config WHERE id='1' LIMIT 1";
$res_f = mysql_query($sql_f) or die(mysql_error());
$row_f = mysql_fetch_array($res_f);
$action = "F_editar";
?>
								<form method="post" action="?cp=<?=$cp?>&c=<?=$c?>" class="form-horizontal">
   								 <input type="hidden" name="action" value="<?=$action?>" />
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group"><label class="col-md-3 control-label">Nome Rádio</label>

                                                <div class="col-md-9"><input type="text" name="nomeradio" value="<?=$row_f[nomeradio]?>" class="form-control"/></div>
                                            </div>
                                            <div class="form-group"><label class="col-md-3 control-label">Twitter
                                                </label>

                                                <div class="col-md-9"><input type="text" name="twitter" value="<?=$row_f[twitter]?>" class="form-control"/></div>
                                                
                                            </div>
                                            

                                            <div class="form-group"><label class="col-md-3 control-label">Facebook</label>

                                                <div class="col-md-9"><input type="text" name="facebook" value="<?=$row_f[facebook]?>" class="form-control" placeholder="/usuario"/></div>
                                            </div>


                                            <div class="form-group"><label class="col-md-3 control-label">Instagram
                                                </label>

                                                <div class="col-md-9">
                                                    <input type="text" name="instagram" value="<?=$row_f[instagram]?>" class="form-control"/> 
                                                </div>
                                            </div>
                                            
                                            <div class="form-group"><label class="col-md-3 control-label">Slogan
                                                </label>

                                                <div class="col-md-9">
                                                    <input type="text" name="slogan" value="<?=$row_f[slogan]?>" class="form-control"/> 
                                                </div>
                                            </div>
       
                                            <div class="form-group"><label class="col-md-3 control-label">Link do Site</label>

                                                <div class="col-md-9">
                                                    <input type="text" name="linksite" value="<?=$row_f[linksite]?>" class="form-control"/>
                                                </div>
                                            </div>
                                              
                                            <div class="col-md-offset-9 ">
                                                    <button type="submit" class="btn btn-primary btn-outlined">Salvar Alterações
                                                    </button>
                                                </div>
                                        </div>
                                    </div>
                                </form>
                            </div>