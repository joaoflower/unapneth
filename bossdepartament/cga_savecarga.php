<?
	session_start();
	include "../include/funcget.php";
	include "../include/funcsql.php";
	include "../include/funcstyle.php";
	include "../include/funcoption.php";
	if(fsafetylogin())
	{
		$bDatos = FALSE;
		$tCarga = "carga".$_SESSION['sFrameano_aca'];
		
		if(!empty($_POST['rDatas']))
		{
			$vQuery = "insert into $tCarga (pln_est, cod_cur, sec_gru, mod_mat, cod_prf, cod_car, ano_aca, per_aca) values ";
			$vQuery .= "('{$_SESSION['sHorapln_est']}', '{$_SESSION['sHoracod_cur']}', '{$_SESSION['sHorasec_gru']}', ";
			$vQuery .= "'{$_SESSION['sHoramod_mat']}', '{$_SESSION['sHoracod_prf']}', '{$_SESSION['sHoracod_car']}', ";
			$vQuery .= "'{$_SESSION['sFrameano_aca']}', '{$_SESSION['sFrameper_aca']}') ";
					
			$cResult = fInupde($vQuery);
			
			if($cResult)
				$bDatos = TRUE;
		}
	}
	else
	{
		header("Location:../index.php");
	}
	
	if($bDatos == TRUE)
	{
?>
		<span class="wordi">LOS DATOS GUARDADOS CORRECTAMENTE</span>
<?	
	}
	else
	{
?>
		<span class="wordi">DATOS NO GUARDADOS CORRECTAMENTE</span>
<?	
	}

?>