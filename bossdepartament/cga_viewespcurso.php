<?
	session_start();
	include "../include/funcget.php";
	include "../include/funcsql.php";
	include "../include/funcstyle.php";
	include "../include/funcoption.php";
	if(fsafetylogin())
	{
		$bDatos = FALSE;
		if(!empty($_POST['rCod_esp']))
		{
			$_SESSION["sHoracod_esp"] = $_POST['rCod_esp'];
			$_SESSION["sHoracod_cur"] = "999";
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
				<select name="rCod_cur" id="rCod_cur" onchange="cga_viewhoracurso(this.value); return false;">
					<?=fviewhocurso($_SESSION['sHoracod_car'], $_SESSION["sHorapln_est"], $_SESSION["sHoracod_esp"], $_SESSION["sHorasem_anu"], $_SESSION["sHoracod_cur"])?>
			      </select>
<?	
	}
?>