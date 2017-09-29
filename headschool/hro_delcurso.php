<STYLE type=text/css>
@import url( ../css/main.css );
@import url( ../css/frame.css );
@import url( ../css/framelogin.css );
@import url( ../css/style.css );
</STYLE>

<?
	session_start();
	include "../include/funcget.php";
	include "../include/funcoption.php";
	include "../include/funcsql.php";
	include "../include/funcstyle.php";
	if(fsafetylogin())
	{
		$bDatos = FALSE;
		$bDelete = TRUE;
		
		if(!empty($_POST['rCod_cur']))		
		{
			$tHora = "hora".$_SESSION['sUsercod_car'].$_SESSION['sFrameano_aca'];
						
			$vQuery = "delete from $tHora ";
			$vQuery .= "where pln_est = '{$_SESSION['sHorapln_est']}' and ";
			$vQuery .= "cod_cur = '{$_POST['rCod_cur']}' and sec_gru = '{$_SESSION['sHorasec_gru']}' and ";
			$vQuery .= "per_aca = '{$_SESSION['sFrameper_aca']}' and cod_car = '{$_SESSION['sUsercod_car']}' ";
			
			$cResult = fInupde($vQuery);
			$bDatos = TRUE;
		}
	}
	else
	{
		header("Location:../index.php");
	}
	
	if($bDatos == TRUE)
	{
		include "hro_viewhorasge.php";
	}
?>