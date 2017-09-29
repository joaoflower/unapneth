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
	include "../include/funcoption.php";
	if(fsafetylogin())
	{
		$bDatos = FALSE;
		if(!empty($_POST['rPln_est']))
		{
			$_SESSION["sHorapln_est"] = $_POST['rPln_est'];
			$_SESSION["sHoracod_cur"] = "999";
			$_SESSION["sHorasec_gru"] = "01";
			$_SESSION["sHoramod_mat"] = "01";
			$_SESSION["sHorasem_anu"] = "01";
			$_SESSION["sHoratur_est"] = "1";
			$bDatos = TRUE;
		}
	}
	else
	{
		header("Location:../index.php");
	}
	
	if($bDatos == TRUE)
	{
		include "hro_getcarreradata.php";
	}
?>