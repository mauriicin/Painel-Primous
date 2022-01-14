<script>
function muda_ordem(direcao, ordem, controle)
{
	this.location = 'index.php?cp=<?=$cp?>&c=<?=$c?>&action=muda_ordem&direcao='+direcao+'&ordem='+ordem+'&controle='+controle;
}
function troca_flag(flag, id_reg, campo_flag)
{
	this.location = 'index.php?cp=<?=$cp?>&c=<?=$c?>&action=muda_status&flag='+flag+'&id_reg='+id_reg;
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
	if(confirm('Tem certeza que voce deseja apagar este(s) registro(s)?'))
		return true;
	else
		return false;
}

</script>
<div class="portlet-header">
                                <div class="caption">Canas Adm</div>
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
                                
                               <a href="?cp=<?=$cp?>&c=<?=$c?>&action=inserir"> <button type="button" class="btn btn-grey">Inserir Canal</button></a> 
                                
                               <a href="?cp=<?=$cp?>&c=<?=$c?>"> <button type="button" class="btn btn-grey">Listar Registros</button></a> 
                                
                            </div>

<?
if($action=="muda_ordem"){
	$controle = $_GET["controle"];
	$ordem = $_GET["ordem"];
	$sql = "SELECT aca_ordem FROM primous_canais ORDER BY aca_ordem DESC LIMIT 1";
	$limite_qr = mysql_query($sql) or die(mysql_error());
	$limite_reg = mysql_fetch_array($limite_qr);
	$limite = $limite_reg[aca_ordem]+1;
	// ------->> Passo 1: pega o controle e coloca no limite <<-------|
	$sql = "UPDATE primous_canais SET aca_ordem = '".$limite."'	WHERE aca_ordem = '".$controle."'";
		//echo $sql . "<br>";
	$db = mysql_query($sql) or die(mysql_error());
	
	// ------->> Passo 2: pega o item e coloca no lugar do controle <<-------|
	$sql = "UPDATE primous_canais SET aca_ordem = '".$controle."' WHERE aca_ordem = '".$ordem."'";
		//echo $sql . "<br>";
	$db = mysql_query($sql) or die(mysql_error());
	
	// ------->> Passo 3: pega o registro que est¨¢ no limite e coloca no lugar do que foi mudado <<-------|
	$sql = "UPDATE primous_canais SET aca_ordem = '".$ordem."' WHERE aca_ordem = '".$limite."'";
	$db = mysql_query($sql) or die(mysql_error());
	$action = "";
}elseif($action=="muda_status"){
	$flag=$_GET["flag"];
	$id_reg = $_GET["id_reg"];
	$sql = "UPDATE primous_canais SET aca_status='".$flag."' WHERE aca_id='".$id_reg."'";
	$res = mysql_query($sql) or die(mysql_error());
	$action = "";
}elseif($action == 'deleta')
{

	// ------->> loop nos registros selecionados na lista <<-------|
	$del_item = $_POST["del_item"];
	$i=0;
	while($cada_um = each($del_item))
	{
		$sql = "DELETE FROM primous_canais WHERE aca_id = '".$cada_um[1]."'";
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
		$sql_f = "SELECT * FROM primous_canais WHERE aca_id='".$id."' LIMIT 1";
		$res_f = mysql_query($sql_f) or die(mysql_error());
		$row_f = mysql_fetch_array($res_f);
		$action = "F_editar";
		$button = "Editar";
	}else{
		$action = "F_inserir";
		$button = "Inserir";
	}
?>
<br />
<form method="post" action="?cp=<?=$cp?>&c=<?=$c?>">
    <input type="hidden" name="action" value="<?=$action?>" />
    <input type="hidden" name="id" value="<?=$id?>" />
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group"><label style="margin-bottom: 15px;" class="col-md-3 control-label">Nome:</label>

                                                <div class="col-md-9"><input style="margin-bottom: 15px;" type="text" name="nome" value="<?=$row_f[aca_nome]?>" class="form-control"/></div>
                                            </div>
                                            <div class="form-group"><label  style="margin-bottom: 15px;" class="col-md-3 control-label">Diretório:
                                                </label>

                                                <div class="col-md-9"><input style="margin-bottom: 15px;" type="text" name="diretorio" value="<?=$row_f[aca_diretorio]?>" class="form-control"/></div>
                                                
                                            </div>
                                            

                                            <div class="form-group"><label style="margin-bottom: 15px;" class="col-md-3 control-label">Status</label>

                                                <div class="col-md-9"><select name="status" style="margin-bottom: 10px;" class="form-control">
                                                    <option style="margin-bottom: 15px;" value="Ativo" <? if($row_f[aca_status]=='Ativo')echo 'selected="selected"';?>>Ativo</option>
                    	<option value="Inativo" <? if($row_f[aca_status]=='Inativo')echo 'selected="selected"';?>>Inativo</option>
                                            </select></div>
                                            </div></br></br></br></br>



                                            <div class="form-group"><label class="col-md-3 control-label">Canal Pai
                                                </label>

                                                <div class="col-md-9">
                                                    <?
				$id = ($id)?$id:0;
				$sql_pai = "SELECT * FROM primous_canais WHERE aca_id <> $id AND (aca_pai IS NULL OR aca_pai=0)";
				$res_pai = mysql_query($sql_pai) or die(mysql_error());
				?>
                <select  name="pai" class="form-control" style="margin-bottom: 10px;"><option value="0"> --- </option>
                    <? while($row_pai=mysql_fetch_array($res_pai)){ ?>
                    	<option value="<?=$row_pai[aca_id]?>" <? if($row_f[aca_pai]==$row_pai[aca_id])echo 'selected="selected"';?>><?=$row_pai[aca_nome]?></option>
                	<? }?></select>
                                                </div>
                                            </div>
       
                                            
                                              
                                            <div class="col-md-offset-9 ">
                                                    <button type="submit" class="btn btn-primary btn-outlined">Alterar
                                                    </button>
                                                </div>
                                        </div>
                                    </div>
                                </form>

							<?
}elseif($action == "F_editar"){
	$id = $_POST["id"];
	if($id){
		$nome = $_POST["nome"];
		$diretorio = $_POST["diretorio"];
		$status = $_POST["status"];
		$pai = $_POST["pai"];
		$sql = "UPDATE primous_canais SET aca_nome='$nome', aca_diretorio='$diretorio', aca_status='$status', aca_pai='$pai' WHERE aca_id='$id'";
		$res = mysql_query($sql) or die(mysql_error());
		if($res){
			echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>X</button><strong>Sucesso!</strong> Editado Com Sucesso.</div>";
		}else{
			echo "<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>X</button><strong>Sucesso!</strong> Ocorreu um Erro.</div>";
		}
	}
	$action = "";
}elseif($action == "F_inserir"){
	$nome = $_POST["nome"];
	$diretorio = $_POST["diretorio"];
	$status = $_POST["status"];
	$pai = $_POST["pai"];
	$sql_o="SELECT * FROM primous_canais ORDER BY aca_ordem DESC LIMIT 1";
	$row_o=mysql_fetch_array(mysql_query($sql_o));
	$ordem = $row_o[aca_ordem]+1;
	$sql = "INSERT INTO primous_canais (aca_nome, aca_diretorio, aca_status, aca_pai, aca_ordem) VALUES('$nome','$diretorio','$status','$pai','$ordem')";
	$res = mysql_query($sql) or die(mysql_error());
	if($res){
		echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>X</button><strong>Sucesso!</strong> Editado Com Sucesso.</div>";
	}else{
		echo "<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>X</button><strong>Sucesso!</strong> Ocorreu um Erro.</div>";
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
                                        <th width="3%">
                                      		<center>
                                            <input type="Checkbox" onclick="troca_todos(this);" alt="Marca ou desmarca todos da lista">
                                            </center>
                                        </th>
                                        <th width="3%">
                                        <center><input style="width:16px; height:16px;" type="image" src="images/deletar.png" alt="Apagar registros selecionados"></center>
                                        </th>
                                        <th width="23%"><strong>Nome</strong></th>
                                        <th width="30%">Diretório</th>
                                        <th width="24%">Canal Central</th>
                                        <th width="24%">Status</th>
                                        <th width="24%">Ordem</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?
    $sql ="SELECT * FROM primous_canais ORDER BY aca_ordem";
    $res = mysql_query($sql) or die(mysql_error());
    $i=1;
    $total = mysql_num_rows($res);
    while($row=mysql_fetch_array($res)){
        $bg = (($i+1)%2==0)?"bg":"";
        $sql_pai="SELECT * FROM primous_canais WHERE aca_id='".$row[aca_pai]."' LIMIT 1";
        $row_pai = mysql_fetch_array(mysql_query($sql_pai));
    ?>
                                    <tr>
                                        <td>
                                        <center>
                                           <input style="width:45px;" type="Checkbox" name="del_item[]" value="<?=$row[aca_id]?>" alt="Marca ou desmarca todos da lista">
                                        </center>
                                        </td>
                                        <td><center>
                                        <a href="?cp=<?=$cp?>&c=<?=$c?>&action=editar&id=<?=$row[aca_id]?>"><img style="width:16px; height:16px;" src="images/edit.png" alt="Clique para editar este registro" align="absmiddle" /></a></center>
                                        </td>
                                        <td><?=$row[aca_nome]?></td>
                                        <td><?=$row[aca_diretorio]?></td>
                                        <td><?=$row_pai[aca_nome]?></td>
                                        <td>
                                        <div class="col-md-12">
                                        <select name="status" class="form-control" onchange="troca_flag(this.value, '<?=$row[aca_id]?>')">
                    <option value="Ativo" <? if($row[aca_status]=='Ativo')echo 'selected="selected"';?>>Ativo</option>
                    <option value="Inativo" <? if($row[aca_status]=='Inativo')echo 'selected="selected"';?>>Inativo</option>
                </select> 
                                        </div>
                                        </td>
                                        <td><center>
                                        <? if($i!=1){ ?>
                <a href="javascript:muda_ordem('sobe','<?=$row[aca_ordem]?>', document.lista['ordem_pos[<?=$i-1?>]'].value);"  target='_self'><img border=0 src='images/sobe.png' alt='Clique para subir este item na lista'></a>
                <? }
                if($total!=$i){?>
                <a href="javascript:muda_ordem('desce','<?=$row[aca_ordem]?>', document.lista['ordem_pos[<?=$i+1?>]'].value);" target='_self'><img border=0 src='images/desce.png' alt='Clique para descer este item na lista'></a>
                <? }?>
                                        </center>
                                        </td>
                                      </tr>
                                      <?
        $i++;
    }
    ?>
                                    </tbody>
                                </table></form>
                            </div>  
<?
}
?>