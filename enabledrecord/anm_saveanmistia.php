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
		
		if(!empty($_SESSION['sHabinum_mat']) and !empty($_SESSION['sHabicod_car']))
		{
			$vQuery = "update estudiante set con_est = '1' ";
			$vQuery .= "where num_mat = '{$_SESSION['sHabinum_mat']}' and cod_car = '{$_SESSION['sHabicod_car']}' and ";
			$vQuery .= "con_est = 'A' ";
			//and (ult_per = '01' or ult_per = '02') 
				
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
