<?
function anti_injecao($palavra)
{
	
	$palavra = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|\\\\)/"),"",$palavra);
	
	$palavra = trim($palavra);
	$palavra = strip_tags($palavra);
	$palavra = addslashes($palavra);
	return $palavra;
}
function upload_arquivo($diretorio, $name) {
	$nome_original = $_FILES["$name"]["name"];
	$nome_temporario = $_FILES["$name"]["tmp_name"];
	$ext = strtolower((substr($nome_original, -3)));
	if($nome_original != ""){
			if(!file_exists($diretorio.$nome_original)){
				if(!copy ($nome_temporario,$diretorio.$nome_original)){
					echo "<script>alert('Erro ao tentar salvar o arquivo')</script>";
				}else{
					return $nome_original;
				}
			}else{
				echo "Existe um arquivo com o mesmo nome. Seu upload não pode ser executado.";
				return false;
			}
	}else{
		return true;
	}
}
function upload_imagem($diretorio, $name) {
	$nome_original = $_FILES["$name"]["name"];
	$nome_temporario = $_FILES["$name"]["tmp_name"];
	$ext = strtolower((substr($nome_original, -3)));
	if($nome_original != ""){
		if($ext == "png" || $ext == "gif" || $ext == "jpg" || $ext=="bmp"){
			if(!file_exists($diretorio.$nome_original)){
				if(!copy ($nome_temporario,$diretorio.$nome_original)){
					echo "<script>alert('Erro ao tentar salvar o arquivo')</script>";
				}else{
					return $nome_original;
				}
			}else{
				echo "Existe um arquivo com o mesmo nome. Seu upload não pode ser executado.";
				return false;
			}
		}else{
			echo "<script>alert('Não é um arquivo de imagem válido')</script>";
			return false;
		}
	}else{
		return true;
	}
}
function rename_dir($dir,$dirnew,$op=0) {
		 if(is_dir($dir)){
			 if ($op!=1) mkdir($nDir="temp".($rand=rand(0,100000)));
			 else{
				 $nDir=$dirnew;
				 if(!is_dir($nDir)){ 
					mkdir($nDir, 0777);
					chmod($nDir, 0777);
				}
			 }
			 $abre = opendir($dir);
			 while (false != ($arq=readdir($abre))) {
					if ($arq=="." || $arq=="..") continue;
					if (is_dir($arqC=($dir."/".$arq))) rename_dir($arqC,$nDir."/".$arq,1);
					else { copy($arqC,$nDir."/".$arq);
					unlink ($arqC); }
			 }
			 closedir($abre);
			 rmdir($dir);
			 if ($op!=1) rename_dir($nDir,$dirnew,1);
		 }
}
function busca_post(){
	$var = "";
	foreach( $_POST as $chave => $valor ){
		if(is_array($_POST[$chave])){
			$var .=$chave."=(";
			foreach($_POST[$chave] as $subchave => $subvalor){
				$var .=$subvalor.";";
			}
			$var.=");";
		}else{
			$var .=$chave."=".$valor.";";
		}
	}
	return $var;
}
function busca_get(){
	$var = "";
	foreach( $_GET as $chave => $valor ){
		if(is_array($_GET[$chave])){
			$var .=$chave."=(";
			foreach($_GET[$chave] as $subchave => $subvalor){
				$var .=$subvalor.";";
			}
			$var.=");";
		}else{
			$var .=$chave."=".$valor.";";
		}
	}
	return $var;
}
?>