<script>
function troca_flag(flag, id_reg, campo_flag)
{
	this.location = 'index.php?cp=<?=$cp?>&c=<?=$c?>&action=muda_status&flag='+flag+'&id_reg='+id_reg+'&campo='+campo_flag;
}

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
<script language='JavaScript'> 
function SomenteNumero(e){
    var tecla=(window.event)?event.keyCode:e.which;
    if((tecla > 47 && tecla < 58)) return true;
    else{
    if (tecla != 8) return false;
    else return true;
    }
}
</script> 
<div class="portlet-header">
                                <div class="caption">Membros da Equipe</div>
                                <div class="tools"><div class="caption">Pedidos: <span style="color: #ed5565">OFF</span></div></div>
                            </div>
                            <?
$action=$_GET["action"];
if($action == ""){
	$action=$_POST["action"];
}
?>
<div class="portlet-body">   
 <a href="?pg=<?=$cp?>&amp;p=<?=$c?>&amp;action=inserir"> <button type="button" class="btn btn-grey">Novo Membro</button></a> 
 <a href="?pg=<?=$cp?>&amp;p=<?=$c?>"> <button type="button" class="btn btn-grey">Todos os Membros</button></a> 
                                
                            </div>
                            
                            
                           
                      <?
if($action=="muda_status"){
	$flag=$_GET["flag"];
	$id_reg = $_GET["id_reg"];
	$campo = $_GET["campo"];
	$sql = "UPDATE primous_usuarios SET $campo='".$flag."' WHERE id='".$id_reg."'";
	$res = mysql_query($sql) or die(mysql_error());
	$action = "";
}elseif($action == 'deleta'){
	// ------->> loop nos registros selecionados na lista <<-------|
	$del_item = $_POST["del_item"];
	$i=0;
	while($cada_um = each($del_item))
	{
		$sql = "DELETE FROM primous_usuarios WHERE id = '".$cada_um[1]."'";
		$res = mysql_query($sql) or die(mysql_error());
		$sql = "DELETE FROM primous_usuario_rel WHERE usr_id = '".$cada_um[1]."'";
		$res = mysql_query($sql) or die(mysql_error());
		if(!$res){
			$i++;
		}
	}
	if($i==0){
	echo "<div class='alert alert-success' style='margin-top: 15px;'><strong>Sucesso!</strong> Editado Com Sucesso.</div>";
	}else{
	echo "<div class='alert alert-error' style='margin-top: 15px;'><strong>Error!</strong> Ocorreu um Erro.</div>";
	}
	$action = "";
}elseif($action == "editar" || $action == "inserir"){
	$id = $_GET["id"];
	if($id){
		$sql_f = "SELECT * FROM primous_usuarios u WHERE u.id='".$id."' LIMIT 1";
		$res_f = mysql_query($sql_f) or die(mysql_error());
		$row_f = mysql_fetch_array($res_f);
		$sql_r = "SELECT * FROM primous_cargos t, primous_usuario_rel r WHERE t.tp_usr_id=r.tp_usr_id AND r.usr_id='".$id."'";
		$res_r=mysql_query($sql_r) or die(mysql_error());
		$nivel = "";
		while($row_r = mysql_fetch_array($res_r)){
			$nivel .=$row_r[tp_usr_nome].",";
		}
		$action = "F_editar";
	  }else{
		$action = "F_inserir";
	}
?> 
	<form method="post" action="?cp=<?=$cp?>&c=<?=$c?>">

    <input type="hidden" name="action" value="<?=$action?>" />

    <input type="hidden" name="id" value="<?=$id?>" />
 <?
				$id = ($id)?$id:0;
				$sql_pai = "SELECT * FROM primous_cargos ORDER BY tp_usr_nome";
				$res_pai = mysql_query($sql_pai) or die(mysql_error());
				?> <div class="portlet-body">
                <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group"><label style="margin-bottom: 15px;" class="col-md-3 control-label">Nome</label>

                                                <div class="col-md-9"><input style="margin-bottom: 15px;" type="text" name="nome" value="<?=$row_f[usuario]?>" class="form-control"/></div>
                                            </div>
                                            <div class="form-group"><label style="margin-bottom: 15px;" class="col-md-3 control-label">Email
                                                </label>

                                                <div class="col-md-9">
                                                    <input style="margin-bottom: 15px;" type="email" name="email" value="<?=$row_f[email]?>" class="form-control"/>
                                                    
                                                </div>
                                            </div> 
                                            

                                            <div class="form-group"><label style="margin-bottom: 15px;" style="margin-bottom: 15px;" class="col-md-3 control-label">Senha</label>

                                                <div class="col-md-9"><input style="margin-bottom: 15px;" style="margin-bottom: 15px;" type="Password" name="senha" value="<?=$row_f[senha]?>" class="form-control"/></div>
                                            </div>


                                            <div class="form-group"><label style="margin-bottom: 15px;" class="col-md-3 control-label">Link Imagem
                                                </label>

                                                <div class="col-md-9">
                                                    <input style="margin-bottom: 15px;" type="text" name="imagem" value="<?=$row_f[imagem]?>" class="form-control"/> 
                                                </div>
                                            </div>
                                            <div class="form-group"><label style="margin-bottom: 15px;"
                                                    class="col-md-3 control-label">Status</label>

                                                <div class="col-md-9"><select style="margin-bottom: 15px;" name="status" class="form-control">
                                        <option value="sim" <? if($row_f[ativo]=='sim')echo 'selected="selected"';?>>Ativo</option>
                                        <option value="nao" <? if($row_f[ativo]=='nao')echo 'selected="selected"';?>>Inativo</option>
                                                </select></div>
                                            </div>
                                            <div class="form-group"><label style="margin-bottom: 15px;" class="col-md-3 control-label">Nome do Programa</label>

                                                <div class="col-md-9">
                                                    <input style="margin-bottom: 15px;" type="text" name="programa" value="<?=$row_f[programa]?>" class="form-control"/>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
<label class="col-md-3 control-label">Cargo</label>

<div class="col-md-9" style="margin-left: 130px; float: left;">
<div class="checkbox-list">
<? while($row_pai=mysql_fetch_array($res_pai)){ ?>
<label>
<input type="checkbox" name="nivel[]" value="<?=$row_pai[tp_usr_id]?>" <? if(strstr($nivel, $row_pai[tp_usr_nome])) echo 'checked="checked"'; ?> />&nbsp; <?=$row_pai[tp_usr_nome]?><br />
</label>
<? }?>
</div>
</div>

</div>
                                            
                                            
                                            <div class="col-md-offset-9 ">
                                                    <button type="submit" class="btn btn-primary btn-outlined">Inserir Membro
                                              </button>
                                                </div>
                                        </div>
                                    </div></div>
                            
                            </form>  

                           <?
}elseif($action == "F_editar"){
	$id = $_POST["id"];
	if($id){
		$nome = $_POST["nome"];		
		$email = $_POST["email"];
		$senha = $_POST["senha"];
		$imagem = $_POST["imagem"];
		$ativo = $_POST["status"];
		$nivel = $_POST["nivel"];
		$sql = "UPDATE primous_usuarios SET usuario='$nome', imagem='$imagem', senha='$senha', ativo='$ativo', email='$email' WHERE id=$id";
		$res = mysql_query($sql) or die(mysql_error());
		$consulta = "";
		while($cada = @each($nivel)){
			$sql = "SELECT * FROM primous_usuario_rel WHERE tp_usr_id='".$cada[1]."' AND usr_id = '".$id."'";
			$res_v = mysql_query($sql) or die(mysql_error());
			if(mysql_num_rows($res_v) <= 0){
				$sql2="INSERT INTO primous_usuario_rel(tp_usr_id, usr_id) VALUES('".$cada[1]."','".$id."')";
				$res2=mysql_query($sql2) or die(mysql_error());
			}
			$consulta .= " AND tp_usr_id<>'".$cada[1]."' ";
		}
		$sql_del = "DELETE FROM primous_usuario_rel WHERE usr_id='".$id."' ".$consulta;
		$res_del = mysql_query($sql_del) or die(mysql_error());
		if($res){
		echo "<div class='alert alert-success'><strong>Sucesso!</strong> Editado Com Sucesso.</div>";
	}else{
	echo "<div class='alert alert-error'><strong>Error!</strong> Ocorreu um Erro.</div>";
		}
	}
	$action = "";
}elseif($action == "F_inserir"){
	$nome = $_POST["nome"];		
	$email = $_POST["email"];
	$senha = $_POST["senha"];
	$imagem = $_POST["imagem"];
	$ativo = $_POST["status"];
	$nivel = $_POST["nivel"];
	$sql = "INSERT INTO primous_usuarios(usuario, imagem, senha, ativo, email) VALUES('$nome', '$imagem', '$senha', '$ativo', '$email')";
	$res = mysql_query($sql) or die(mysql_error());
	$sql_o="SELECT * FROM primous_usuarios ORDER BY id DESC LIMIT 1";
	$row_o=mysql_fetch_array(mysql_query($sql_o));
	$usr_id = $row_o[id];
	while($cada = each($nivel)){
		$sql2="INSERT INTO primous_usuario_rel(tp_usr_id, usr_id) VALUES('".$cada[1]."','".$usr_id."')";
		$res2=mysql_query($sql2) or die(mysql_error());
	}
	if($res){
	echo "<div class='alert alert-success'><strong>Sucesso!</strong> Editado Com Sucesso.</div>";
	}else{
	echo "<div class='alert alert-error'><strong>Error!</strong> Ocorreu um Erro.</div>";
	}
	$action = "";
}
if($action == ""){
?>
                            <div class="portlet-body">
<form name="lista" method="post" action="?cp=<?=$cp?>&c=<?=$c?>" onSubmit="return confirma_delete()">
    <input type="Hidden" value="deleta" name="action">
    <input type="hidden" value="<?=$c?>" name="c" />
    <input type="hidden" value="<?=$cp?>" name="cp" />                          
                               <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th width="2%">
                                      		<center>
                                           <input type="Checkbox" onClick="troca_todos(this);"  alt="Marca ou desmarca todos da lista">
                                            </center>
                                        </th>
                                        <th width="2%">
                                        <center><input style="width:16px; height:16px;" type="image" src="images/deletar.png" alt="Apagar registros selecionados"  align="absmiddle"></center>
                                        </th>
                                        <th width="10%"><strong>Imagem</strong></th>
                                        <th width="23%">Nome</th>
                                        <th width="18%">Cargo</th>
                                        <th width="20%">Status</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?
    $sql ="SELECT * FROM primous_usuarios ORDER BY usuario";
    $res = mysql_query($sql) or die(mysql_error());
    $i=1;
    $total = mysql_num_rows($res);
    while($row=mysql_fetch_array($res)){
    ?>
                                    <tr>
                                        <td>
                                        <center>
                                            <input type="Checkbox" name="del_item[]" value="<?=$row[id]?>">
                                            </center>
                                        </td>
                                        <td>
                                        <center><a href="?cp=<?=$cp?>&c=<?=$c?>&action=editar&id=<?=$row[id]?>"><img style="width:16px; height:16px;" src="images/edit.png" alt="Clique para editar este registro" align="absmiddle"></a></center>
                                        </td>
                                        <td><center><img src="<?=$row[imagem]?>" style="width: 85px;height: 85px; max-height:85px; max-width:85px;"></center></td>
                                        <td><?=$row[usuario]?></td>
                                        <td><? 
										$sql_n="SELECT * FROM primous_usuario_rel r, primous_cargos t WHERE r.tp_usr_id=t.tp_usr_id AND r.usr_id='".$row[id]."' ORDER BY t.tp_usr_ordem";
										$res_n=mysql_query($sql_n) or die(mysql_error());
										while($row_n=mysql_fetch_array($res_n)){
									    echo $row_n[tp_usr_nome]."<br>";
										}
										?></td>
                                        <td><div class="col-md-12"> 
                                        <select class="form-control" name="status" onChange="troca_flag(this.value, '<?=$row[id]?>', 'ativo')">
                                        	    <option value="sim" <? if($row[ativo]=='sim')echo 'selected="selected"';?>>Ativo</option>
                                                <option value="nao" <? if($row[ativo]=='nao')echo 'selected="selected"';?>>Inativo</option>
                                        </select>
                                        </div></td>
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