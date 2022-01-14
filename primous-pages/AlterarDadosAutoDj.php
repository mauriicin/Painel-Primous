<div class="portlet-header">
                                <div class="caption">Configuração Auto DJ</div>
                                <div class="tools"><div class="caption">Pedidos: <span style="color: #ed5565">OFF</span></div></div>
                            </div>
                            <div class="portlet-body">
<?php
if($action == "F_editar"){
$sql = "UPDATE primous_autodj SET nome='$nome', programa='$programa', imagem='$imagem', facebook='$facebook', twitter='$twitter' WHERE id='1'";
$res = mysql_query($sql) or die(mysql_error());
if($res){
	echo "<div class='alert alert-success'><strong>Sucesso!</strong> Editado Com Sucesso.</div>";
	}else{
	echo "<div class='alert alert-error'><strong>Error!</strong> Ocorreu um Erro.</div>";
 }
}
$sql_f = "SELECT * FROM primous_autodj WHERE id='1' LIMIT 1";
$res_f = mysql_query($sql_f) or die(mysql_error());
$row_f = mysql_fetch_array($res_f);
$action = "F_editar";
?>
                                <form role="form" method="post" class="form-horizontal" action="?cp=<?=$cp?>&c=<?=$c?>">
<input type="hidden" name="action" value="<?=$action?>" />
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group"><label class="col-md-3 control-label">Nome Auto Dj:</label>

                                                <div class="col-md-9"><input type="text"
                                                                             class="form-control" name="nome" value="<?=$row_f[nome]?>"/></div>
                                            </div>
                                            <div class="form-group"><label class="col-md-3 control-label">Programa:
                                                </label>

                                                <div class="col-md-9"><input type="text"
                                                                             class="form-control" name="programa" value="<?=$row_f[programa]?>"/></div>
                                                
                                            </div>
                                            

                                            <div class="form-group"><label class="col-md-3 control-label">Link Imagem:</label>

                                                <div class="col-md-9"><input type="text"
                                                                             class="form-control" name="imagem" value="<?=$row_f[imagem]?>"/></div>
                                            </div>


                                            <div class="form-group"><label class="col-md-3 control-label">Facebook:
                                                </label>

                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="facebook" value="<?=$row_f[facebook]?>"/> 
                                                </div>
                                            </div>
                                            
                                            <div class="form-group"><label class="col-md-3 control-label">Twitter:
                                                </label>

                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="twitter" value="<?=$row_f[twitter]?>"/> 
                                                </div>
                                            </div>
                                              
                                            <div class="col-md-offset-9 ">
                                                    <button type="submit" class="btn btn-primary btn-outlined" value="Alterar">Alterar
                                                    </button>
    
                                              </div>
                                        </div>
                                        <div class="img-locutor-auto" style="float:right; margin-right:15px;">
                                                    <img src="<?=$row_f[imagem]?>" width="550" height="550" style="max-height:230px; max-width:230px" />
                                                </div>
                                    </div>
                                </form>
                            </div>