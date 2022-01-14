<?php
if($_POST['envia']) 
{
$char = stripslashes($_POST['char']);
if(eregi("[^a-zA-Z0-9_@.?][<>[.-.] ]",$nome ) )
{
	die("<div class='alert alert-error'><strong>Error!</strong> Não use caracteres especiais no nome da foto.</div>");
}
else
{
	$config = array();
	$arquivo = isset($_FILES["foto"]) ? $_FILES["foto"] : FALSE;
	$dir = "uploads/";
	$config["tamanho"] = 1000000;
	$config["largura"] = 1024;
	$config["altura"]  = 1024;
	if($arquivo)
	{ 
        $tamanhos = getimagesize($arquivo["tmp_name"]);
    	if(!eregi("^image\/(pjpeg|jpeg|png|gif|bmp)$", $arquivo["type"]))
    	{
		echo $arquivo["type"];
			die("<div class='alert alert-error'><strong>Error!</strong>Formato inválido! A imagem deve ser jpg, jpeg, bmp, gif ou png. Envie em outro Formato</div>");
			
    	}
    	elseif($arquivo["size"] > $config["tamanho"])
        {
			die("<div class='alert alert-error'><strong>Error!</strong>Imagem muito grande! Máximo $config[tamanho] bytes. Envie outro arquivo</div>");
        }
        elseif($tamanhos[0] > $config["largura"])
        {
		   die("<div class='alert alert-error'><strong>Error!</strong>Largura da imagem não deve ultrapassar $config[largura] pixels</div>");
        }
       	elseif($tamanhos[1] > $config["altura"])
        {
			die("<div class='alert alert-error'><strong>Error!</strong>Altura da imagem não deve ultrapassar $config[altura] pixels</script>");
        }    
		else {
        	preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $arquivo["name"], $ext);
        	$imagem_nome = md5(uniqid(time())) . "." . $ext[1];
    	    $imagem_dir = $dir.$imagem_nome;
			if(move_uploaded_file($arquivo["tmp_name"], $imagem_dir))
			{
$login = $_SESSION["login_user"];
				mysql_query("UPDATE primous_usuarios SET imagem='".$imagem_nome."' WHERE login='".$login."'");

				echo "<div class='alert alert-success'><strong>Sucesso!</strong>Sua foto foi enviada com sucesso!</div>";
        	} 
			else
			{
				die("<div class='alert alert-error'><strong>Error!</strong>>Há Algo errado,Tente novamente</div>");
        	}
    	}
	}
}}?>

<div class="portlet-header">
                                <div class="caption">Meus Dados</div>
                                <div class="tools"><div class="caption">Pedidos: <span style="color: #ed5565">OFF</span></div></div>
                            </div>
                            <div class="portlet-body">
                                <form role="form" method="post" action="" class="form-horizontal" enctype="multipart/form-data">
                                <input type="hidden" name="action" value="<?=$action?>" />
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group"><label class="col-md-3 control-label">Nome:</label>

                                                <div class="col-md-9">
                                                <input name="foto" type="file" id="foto" class="form-control" />
                                                </div>
                                            </div>
                                            


                                            
                                            
       
                                              
                                            <div class="col-md-offset-9 ">
                                            <input type="submit" name="envia" id="button" class="btn btn-primary btn-outlined" value="Alterar"/>
                                                </div>
                                        </div>
                                    </div>
                                </form>
                            </div>