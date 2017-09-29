<STYLE type=text/css>
@import url( ../css/main.css );
@import url( ../css/frame.css );
@import url( ../css/framelogin.css );
@import url( ../css/style.css );
</STYLE>

<?
	session_start();
	include "../include/funcget.php";
	include "../include/funcsql.php";
	include "../include/funcstyle.php";
	if(fsafetylogin())
	{
		$bDatos = FALSE;
		if(!empty($_POST['rCod_prf']) and !empty($_POST['rCod_car']) and !empty($_POST['rPln_est']) and !empty($_POST['rCod_cur']) and !empty($_POST['rSec_gru']) and !empty($_POST['rMod_mat']))
		{
			$tCarga = "carga".$_SESSION['sFrameano_aca'];
			
			$vQuery = "delete from $tCarga ";
			$vQuery .= "where pln_est = '{$_POST['rPln_est']}' and cod_cur = '{$_POST['rCod_cur']}' and sec_gru = '{$_POST['rSec_gru']}' and ";
			$vQuery .= "mod_mat = '{$_POST['rMod_mat']}' and cod_prf = '{$_POST['rCod_prf']}' and cod_car = '{$_POST['rCod_car']}' and ";
			$vQuery .= "ano_aca = '{$_SESSION['sFrameano_aca']}' and per_aca = '{$_SESSION['sFrameper_aca']}' ";

			if($cResult = fInupde($vQuery))
			{
				$bDatos = TRUE;
			}			
		}			
	}
	else
	{
		header("Location:../index.php");
	}
	if($bDatos == TRUE)
	{
		include "cga_viewcargacurso.php";
	}
?>