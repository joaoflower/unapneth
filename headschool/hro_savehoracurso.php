<?
	session_start();
	include "../include/funcget.php";
	include "../include/funcsql.php";
	include "../include/funcstyle.php";
	include "../include/funcoption.php";
	if(fsafetylogin())
	{
		$bDatos = FALSE;
		$tHora = "hora".$_SESSION['sUsercod_car'].$_SESSION['sFrameano_aca'];
		
		if(!empty($_POST['rDat_snt']))
		{
			$vQuery = "delete from hr using codhora ch, $tHora hr ";
			$vQuery .= "where ch.cod_hor = hr.cod_hor and hr.pln_est = '{$_SESSION['sHorapln_est']}' and ";
			$vQuery .= "hr.cod_cur = '{$_SESSION['sHoracod_cur']}' and hr.sec_gru = '{$_SESSION['sHorasec_gru']}' and ";
			$vQuery .= "hr.per_aca = '{$_SESSION['sFrameper_aca']}' and hr.cod_car = '{$_SESSION['sUsercod_car']}' and ";
			$vQuery .= "ch.tur_est = '{$_SESSION['sHoratur_est']}' ";
			
			$cResult = fInupde($vQuery);
		
			$vCan_dat = strlen($_POST['rDat_snt']) / 3;
			if($vCan_dat > 0)
			{
				for($ii = 0; $ii < $vCan_dat; $ii++)
				{
					$vCod_dia = substr($_POST['rDat_snt'], (3 * $ii), 1);
					$vCod_hor = substr($_POST['rDat_snt'], (3 * $ii) + 1, 2);
					
					$vQuery = "insert into $tHora (pln_est, cod_cur, sec_gru, cod_dia, cod_hor, per_aca, cod_car) values ";
					$vQuery .= "('{$_SESSION['sHorapln_est']}', '{$_SESSION['sHoracod_cur']}', '{$_SESSION['sHorasec_gru']}', ";
					$vQuery .= "'$vCod_dia', '$vCod_hor', '{$_SESSION['sFrameper_aca']}', '{$_SESSION['sUsercod_car']}') ";
					
					$cResult = fInupde($vQuery);

				}
				if($cResult)
				{
					$bDatos = TRUE;
				}

			}
		}
	}
	else
	{
		header("Location:../index.php");
	}
	
	if($bDatos == TRUE)
	{
?>
		<span class="wordi">LOS DATOS FUERON GUARDADOS CORRECTAMENTE. </span>
<?	
	}
	else
	{
?>
		<span class="wordi">ERROR, LOS DATOS NO SE GRABARON. </span>
<?	
	}	
?>