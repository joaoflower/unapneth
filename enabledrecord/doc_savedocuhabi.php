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
		
		if(!empty($_POST['rDoc_hab']))
		{
			$vQuery = "insert into habidoce (ano_aca, per_aca, cod_car, cod_prf, fch_hab, est_hab, doc_hab ) values ";
			$vQuery .= "('{$_SESSION['sFrameano_aca']}', '{$_SESSION['sFrameper_aca']}', '{$_SESSION['sHabicod_car']}', ";
			$vQuery .= "'{$_SESSION['sHabicod_prf']}', now(), '1', '{$_POST['rDoc_hab']}') ";
				
			$cResult = fInupde($vQuery);
			if($cResult)
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

?>
<center>
	<span class="wordi">LOS DATOS FUERON GRABADOS CORRECTAMENTE  ...! </span>
</center>
    
<?
	}
	else
	{
?>
<center>
	<span class="wordi">LOS DATOS NO FUERON GRABADOS CORRECTAMENTE  ...! </span>
</center>
<?
	}
?>
