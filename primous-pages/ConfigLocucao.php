<div class="portlet-header">
                                <div class="caption">Configuração locução</div>
                                <div class="tools"><div class="caption">Pedidos: <span style="color: #ed5565">OFF</span></div></div>
                            </div>
                            <div class="portlet-body">
<?php
if($action == "F_editar"){
$sql = "UPDATE primous_locucao SET ip='$ipradio', porta='$porta', senha='$senha', quality='$quality', format='$format' WHERE id='1'";
$res = mysql_query($sql) or die(mysql_error());
if($res){
	echo "<div class='alert alert-success'><strong>Sucesso!</strong> Editado Com Sucesso.</div>";
	}else{
	echo "<div class='alert alert-error'><strong>Error!</strong> Ocorreu um Erro.</div>";
 }
}
$sql_f = "SELECT * FROM primous_locucao WHERE id='1' LIMIT 1";
$res_f = mysql_query($sql_f) or die(mysql_error());
$row_f = mysql_fetch_array($res_f);
$action = "F_editar";
?>                                
                             <form method="post" action="?cp=<?=$cp?>&c=<?=$c?>" class="form-horizontal">
   								 <input type="hidden" name="action" value="<?=$action?>" />
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group"><label class="col-md-3 control-label">IP</label>

                                                <div class="col-md-9"><input type="text" name="ipradio" value="<?=$row_f[ip]?>" class="form-control"/></div>
                                            </div>
                                            <div class="form-group"><label class="col-md-3 control-label">Porta
                                                </label>

                                                <div class="col-md-9"><input type="text" name="porta" value="<?=$row_f[porta]?>" class="form-control"/></div>
                                                
                                            </div>
                                            

                                            <div class="form-group"><label class="col-md-3 control-label">Senha</label>

                                                <div class="col-md-9"><input type="text" name="senha" value="<?=$row_f[senha]?>" class="form-control" placeholder="/usuario"/></div>
                                            </div>


                                            <div class="form-group"><label class="col-md-3 control-label">Quality
                                                </label>

                                                <div class="col-md-9">
                                                    <input type="text" name="quality" value="<?=$row_f[quality]?>" class="form-control"/> 
                                                </div>
                                            </div>
                                            
                                            <div class="form-group"><label class="col-md-3 control-label">Format
                                                </label>

                                                <div class="col-md-9">
                                                    <input type="text" name="format" value="<?=$row_f[format]?>" class="form-control"/> 
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