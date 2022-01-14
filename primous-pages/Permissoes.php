<script>
function seleciona_tp(tp_id)
{
	this.location = 'index.php?cp=<?=$cp?>&c=<?=$c?>&tp_id='+tp_id;
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
<div class="portlet-header">
                                <div class="caption">Configuração Rádio</div>
                                <div class="tools"><div class="caption">Pedidos: <span style="color: #ed5565">OFF</span></div></div>
                            </div>
                            
                            
                            
                            
                            <div class="portlet-body">
     
     <?
$action=$_GET["action"];
if($action == ""){
	$action=$_POST["action"];
}
$tp_id = $_GET["tp_id"];
if($tp_id == ""){
	$tp_id=$_POST["tp_id"];
}
if($tp_id){
	$sql3 = "SELECT * FROM primous_cargos WHERE tp_usr_id='$tp_id'";
	$row3 = mysql_fetch_array(mysql_query($sql3));
?>
<script>
	$("#titulo_canal span").append("&nbsp;- <?=$row3[tp_usr_nome]?>");
</script>
     
     <div class="portlet-body">
                                
                              <a href="?pg=<?=$cp?>&amp;p=<?=$c?>&amp;action=inserir"> <button type="button" class="btn btn-grey">Inserir Permissão</button></a> 
                                
                              <a href="?pg=<?=$cp?>&amp;p=<?=$c?>"> <button type="button" class="btn btn-grey">Listar Registros</button></a> 
                              
                              <a href="?cp=<?=$cp?>&c=<?=$c?>"> <button type="button" class="btn btn-grey">Tipo de Usu&aacute;rios</button></a> 
                                
                            </div>
     <?
}
if($action == 'deleta')
{
	// ------->> loop nos registros selecionados na lista <<-------|
	$del_item = $_POST["del_item"];
	$i=0;
	while($cada_um = each($del_item))
	{
		$sql = "DELETE FROM primous_permissao WHERE per_id = '".$cada_um[1]."'";
		$res = mysql_query($sql) or die(mysql_error());
		if($res){
			$i++;
		}
	}
	if($i>0){
		echo "<script>alert('Registro(s) excluido(s) com sucesso!')</script>";
	}else{
		echo "<script>alert('Um ou mais registros não puderam ser excluidos!')</script>";
	}
	$action = "";
}elseif($action == "editar" || $action == "inserir"){
	$id = $_GET["id"];
	if($id){
		$sql_f = "SELECT * FROM primous_permissao WHERE per_id='".$id."' LIMIT 1";
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
    <input type="hidden" value="<?=$tp_id?>" name="tp_id">     
     <div class="row">
                                                                                                                            

                                            <div class="form-group"><label style="margin-bottom: 15px;" class="col-md-3 control-label">Tipo Usu&aacute;rio:</label>

                                                <div class="col-md-9">
                                                <?
		$sql_usr="SELECT * FROM primous_cargos";
		$res_usr = mysql_query($sql_usr);
		$sql_can="SELECT * FROM primous_canais ORDER BY aca_nome";
		$res_can = mysql_query($sql_can) or die(mysql_error());
				?>
                                                <select name="tp_usr_id" style="margin-bottom: 10px;" class="form-control">

                    <?php while($row_usr = mysql_fetch_array($res_usr)){?>

                    	<option value="<?php echo $row_usr['tp_usr_id']?>" <?php if($row_usr['tp_usr_id']==$tp_id)echo 'selected="selected"';?>><?php echo $row_usr['tp_usr_nome']?></option>

                	<?php }?>

                	</select>
                                            
                                            	</div>



                                            <div class="form-group"><label class="col-md-3 control-label">Canal:
                                                </label>

                                                <div class="col-md-9">
                                                   
                <select class="form-control" name="aca_id" style="margin-bottom: 10px;">
                   <? while($row_can = mysql_fetch_array($res_can)){?>

                    	<option value="<?=$row_can[aca_id]?>" <? if($row_f[aca_id]==$row_can[aca_id])echo 'selected="selected"';?>><?=$row_can[aca_nome]?></option>

                	<? }?>
               </select>
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
		$tp_usr_id = $_POST["tp_usr_id"];
		$aca_id = $_POST["aca_id"];
		$sql = "UPDATE primous_permissao SET tp_usr_id='$tp_usr_id', aca_id='$aca_id' WHERE per_id=$id";
		$res = mysql_query($sql) or die(mysql_error());
		if($res){
			echo "<script>alert('Registro Editado com sucesso')</script>";
		}else{
			echo "<script>alert('Um erro inesperado aconteceu')</script>";
		}
	}
	$action = "";
}elseif($action == "F_inserir"){
	$tp_usr_id = $_POST["tp_usr_id"];
	$aca_id = $_POST["aca_id"];
	$sql = "INSERT INTO primous_permissao (tp_usr_id, aca_id) VALUES('$tp_usr_id','$aca_id')";
	$res = mysql_query($sql) or die(mysql_error());
	if($res){
		echo "<script>alert('Registro Inserido com sucesso')</script>";
	}else{
		echo "<script>alert('Um erro inesperado aconteceu')</script>";
	}
	$action = "";
}
if($tp_id && $action == ""){
?>                          
    <form name="lista" method="post" action="?cp=<?=$cp?>&c=<?=$c?>" onsubmit="return confirma_delete()">
    <input type="Hidden" value="deleta" name="action">
    <input type="hidden" value="<?=$cp?>" name="cp" />
    <input type="hidden" value="<?=$c?>" name="c" />
    <input type="hidden" value="<?=$tp_id?>" name="tp_id">             
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
                                        <th width="40%">Tipo Usuário</th>
                                        <th width="40%">Canal</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                   <?
    $sql ="SELECT * FROM primous_permissao p, primous_canais c, primous_cargos u 
			WHERE p.tp_usr_id = '$tp_id' AND p.aca_id=c.aca_id AND p.tp_usr_id=u.tp_usr_id 
			ORDER BY c.aca_ordem";
    $res = mysql_query($sql) or die(mysql_error());
    $i=1;
    $total = mysql_num_rows($res);
    while($row=mysql_fetch_array($res)){
	$bg = (($i+1)%2==0)?"bg":"";
    ?> 
                                    <tr>
                                        <td>
                                        <center>
                                           <input type="Checkbox" name="del_item[]" value="<?=$row[per_id]?>">
                                        </center>
                                        </td>
                                        <td><center>
                                        <a href="?p=<?=$c?>&action=editar&id=<?=$row[per_id]?>&tp_id=<?=$tp_id?>"><img style="width:16px; height:16px;" src="images/edit.png" alt="Clique para editar este registro" align="absmiddle" /></a></center>
                                        </td>
                                        <td><?=$row[tp_usr_nome]?></td>
                                        <td><?=$row[aca_nome]?></td>
                                      </tr>
                                    <?
                                    $i++;
							         }
								    ?>
                                    </tbody>
                                </table>   </form> 
                                                            
      <?
}elseif($action == ""){
	$sql = "SELECT * FROM primous_cargos ORDER BY tp_usr_nome";
	$res = mysql_query($sql);
?>                      
                                <form>
                                    <div class="row">
                                        <div class="col-md-6">
                                            
                                            

                                           <div class="form-group col-md-9">Selecione um tipo de usuário para dar permissão
											</div>
                                            <div class="col-md-9">
                                            <select name="tp_id" onchange="seleciona_tp(this.value)" class="form-control">

        <option value=""> -- </option>

<?php

while($row = mysql_fetch_array($res)){

?>

	<option value="<?php echo $row['tp_usr_id']?>"><?php echo $row['tp_usr_nome']?></option>

<?php

}

?>

        </select>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                
<?
}
?>                               
                                
                                
                                
                            </div>