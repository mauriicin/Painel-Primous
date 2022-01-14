<script>
function troca_todos(tf)
{
	if(tf.checked)
		ToggleAll(lista, true);
	else
		ToggleAll(lista, false);
}
function ToggleAll(formname, checked_flag)
{
	len = formname.elements.length;
    var i = 0;
    for(i = 0; i < len; i++)
	{
        formname.elements[i].checked = checked_flag;
    }
}
function confirma_delete()
{
	if(confirm('Tem certeza que você deseja apagar este(s) registro(s)?'))
		return true;
	else
		return false;
}
</script>
<div class="portlet-header">
                                <div class="caption">Cargos da Equipe</div>
                                <div class="tools"><div class="caption">Pedidos: <span style="color: #ed5565">OFF</span></div></div>
                            </div>
                            <div class="portlet-body">
<?
$action=$_GET["action"];
if($action == ""){
	$action=$_POST["action"];
}
?>   
<div class="portlet-body"> 
      <a href="?pg=<?=$cp?>&amp;p=<?=$c?>&amp;action=inserir"> <button type="button" class="btn btn-grey">Criar Cargo</button></a> 
</div>         
<?
if($action == 'deleta')
{
	// ------->> loop nos registros selecionados na lista <<-------|
	$del_item = $_POST["del_item"];
	$i=0;
	while($cada_um = each($del_item))
	{
		$sql = "DELETE FROM primous_cargos WHERE tp_usr_id = '".$cada_um[1]."'";
		$res = mysql_query($sql) or die(mysql_error());
		if($res){
			$i++;
		}
	}
	if($i>0){
	echo "<div class='alert alert-success'><strong>Sucesso!</strong> Editado Com Sucesso.</div>";
	}else{
	echo "<div class='alert alert-error'><strong>Error!</strong> Ocorreu um Erro.</div>";
	}
	$action = "";
}elseif($action == "editar" || $action == "inserir"){
	$id = $_GET["id"];
	if($id){
		$sql_f = "SELECT * FROM primous_cargos WHERE tp_usr_id='".$id."' LIMIT 1";
		$res_f = mysql_query($sql_f) or die(mysql_error());
		$row_f = mysql_fetch_array($res_f);
		$action = "F_editar";
	}else{
		$action = "F_inserir";
	}
?>          
	<form method="post" action="?cp=<?=$cp?>&c=<?=$c?>">
    <input type="hidden" name="action" value="<?=$action?>" />
    <input type="hidden" name="id" value="<?=$id?>" />      
 <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group"><label style="margin-bottom: 15px;" class="col-md-3 control-label">Nome:</label>

                                                <div class="col-md-9"><input style="margin-bottom: 15px;" type="text" name="tp_usr_nome" value="<?=$row_f[tp_usr_nome]?>" class="form-control"/></div>
                                            </div>
                                            <div class="form-group"><label  style="margin-bottom: 15px;" class="col-md-3 control-label">Descri&ccedil;&atilde;o:
                                                </label>

                                                <div class="col-md-9">
                                                <textarea style="margin-bottom: 15px;" type="text" name="descricao" rows="5" cols="50" class="form-control"><?=$row_f[tp_usr_comentario]?></textarea> </div>
                                                
                                            </div>
                                            

                                            <div class="form-group"><label style="margin-bottom: 15px;" class="col-md-3 control-label">Status</label>

                                                <div class="col-md-9"><select name="status" style="margin-bottom: 10px;" class="form-control">
                                                  <option style="margin-bottom: 15px;" value="Ativo" <? if($row_f[status]=='Ativo')echo 'selected="selected"';?>>Ativo</option>
                    	<option value="Inativo" <? if($row_f[status]=='Inativo')echo 'selected="selected"';?>>Inativo</option>
                                            </select></div>
                                            </div>    
                                              
                                            <div class="col-md-offset-9 ">
                                                    <button type="submit" class="btn btn-primary btn-outlined">Salvar Alterações
                                                    </button>
                                          </div>
                                        </div>
      </div>
                                </form>
<?
}elseif($action == "F_editar"){
	$id = $_POST["id"];
	if($id){
		$tp_usr_nome = $_POST["tp_usr_nome"];
		$descricao = $_POST["descricao"];
	    $status = $_POST["status"];
		$sql = "UPDATE primous_cargos SET tp_usr_nome='$tp_usr_nome', tp_usr_comentario='$descricao', status='$status' WHERE tp_usr_id=$id";
		$res = mysql_query($sql) or die(mysql_error());
		if($res){
		echo "<div class='alert alert-success'><strong>Sucesso!</strong> Editado Com Sucesso.</div>";
		}else{
		echo "<div class='alert alert-error'><strong>Error!</strong> Ocorreu um Erro.</div>";
		}
	}
	$action = "";
}elseif($action == "F_inserir"){
	$tp_usr_nome = $_POST["tp_usr_nome"];
	$descricao = $_POST["descricao"];
	$status = $_POST["status"];
	$sql = "INSERT INTO primous_cargos (tp_usr_nome, tp_usr_comentario, status) VALUES('$tp_usr_nome','$descricao','$status')";
	$res = mysql_query($sql) or die(mysql_error());
	if($res){
	echo "<div class='alert alert-success'><strong>Sucesso!</strong> Editado Com Sucesso.</div>";
	}else{
	echo "<div class='alert alert-error'><strong>Error!</strong> Ocorreu um Erro.</div>";
	}
	$action = "";
}
if($action == ""){
?>
<form name="lista" method="post" action="?cp=<?=$cp?>&c=<?=$c?>" onsubmit="return confirma_delete()">

    <input type="Hidden" value="deleta" name="action">

    <input type="hidden" value="<?=$cp?>" name="cp" />
    <input type="hidden" value="<?=$c?>" name="c" />
<table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th width="2%">
                                       <center>
                                       <input type="Checkbox" onclick="troca_todos(this);"  alt="Marca ou desmarca todos da lista"></center>
                                       </th>
                                        <th width="2%">
                                      		<center>
                                            <input type="Image" src="images/deletar.png" width="16" alt="Apagar registros selecionados" align="absmiddle">
                                            </center>
                                        </th>
                                        <th width="5%">
                                        <center>
                                          ID
                                        </center>
                                        </th>
                                        <th width="10%"><strong>Nome</strong></th>
                                        <th width="34%">Resumo do cargo</th>
                                        <th width="10%">Status</th>
                                      </tr>
                                    </thead>
                                    <tbody>
<?
    $sql ="SELECT * FROM primous_cargos ORDER BY tp_usr_id";
    $res = mysql_query($sql) or die(mysql_error());
    $i=1;
    $total = mysql_num_rows($res);
    while($row=mysql_fetch_array($res)){
?>
                                    <tr>
                                    <td>
                                        	<center>
                                        	  <input type="Checkbox" name="del_item[]" value="<?=$row[tp_usr_id]?>">
                                        	</center>
                                        </td>
                                        <td>
                                        	<center>
                                        	  <a href="?cp=<?=$cp?>&c=<?=$c?>&action=editar&id=<?=$row[tp_usr_id]?>"><img src="images/edit.png" alt="Clique para editar este registro" width="8" style="width:16px; height:16px;" align="absmiddle"></a>
                                        	</center>
                                        </td>
                                        <td>
                                        <center>
                                          <?=$row[tp_usr_id]?>
                                        </center>
                                        </td>
                                        <td><center>
                                        <?=$row[tp_usr_nome]?>
                                        </center></td>
                                        <td><?=$row[tp_usr_comentario]?></td>
                                        <td>
                                        <div class="col-md-12">
                                         <?=$row[status]?>
                                        </div>
                                        </td>
                                      </tr>
<?
$i++;
}
?>
                                    </tbody>
                                </table>
             </form>
                            </div>
<?
}
?>