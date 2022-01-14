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
<?php 
if($action == 'deleta')
{
	// ------->> loop nos registros selecionados na lista <<-------|
	$del_item = $_POST["del_item"];
	$i=0;
	while($cada_um = each($del_item))
	{
		$sql = "DELETE FROM primous_pedidos WHERE id= '".$cada_um[1]."'";
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
}
?>
<form name="lista" method="post" action="?cp=<?=$cp?>&c=<?=$c?>" onsubmit="return confirma_delete()">

    <input type="Hidden" value="deleta" name="action">

    <input type="hidden" value="<?=$c?>" name="c" />
    <input type="hidden" value="<?=$cp?>" name="cp" />
<table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
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
                                        <th width="10%">Estado</th>
                                        <th width="36%">Pedido</th>
                                        <th width="7%">Data</th>
                                      </tr>
                                    </thead>
                                    <tbody>
<?
    $sql ="SELECT * FROM primous_pedidos ORDER BY data";
    $res = mysql_query($sql) or die(mysql_error());
    $i=1;
    $total = mysql_num_rows($res);
    while($pedidosver=mysql_fetch_array($res)){
?>
                                    <tr>
                                    <td>
                                        	<center>
                                        	  <input type="Checkbox" name="del_item[]" value="<?=$row[tp_usr_id]?>">
                                        	</center>
                                        </td>
                                        <td>
                                        <center>
                                          <?=$pedidosver[id]?>
                                        </center>
                                        </td>
                                        <td><center>
                                        <?=$pedidosver[nome]?>
                                        </center></td>
                                        <td><?=$pedidosver[estado]?></td>
                                        <td>
                                        <div class="col-md-12">
                                         <?=$pedidosver[pedido]?>
                                        </div>
                                        </td>
                                        <td>
                                        <div class="col-md-12">
                                        <?php echo date('d/m/Y', $pedidosver['data']); ?>
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
