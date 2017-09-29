<?
	session_start();
	include "../include/funcget.php";
	include "../include/funcsql.php";
	include "../include/funcstyle.php";
	include "../include/funcoption.php";
	if(fsafetylogin())
	{
		$bDatos = FALSE;
		if(!empty($_POST['rMod_mat']))
		{
			$_SESSION["sHoramod_mat"] = $_POST['rMod_mat'];
			$bDatos = TRUE;
		}
	}
	else
	{
		header("Location:../index.php");
	}
	
	if($bDatos == TRUE and $_SESSION["sHoracod_cur"] != "999")
	{
?>
		<table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td id="dsavecurso"><div class="dboton"><a href="" onclick="cga_savecarga(document.fData); return false;" class="isave" title="Guardar" >Guardar</a></div>
                </td>
          </tr>
        </table>
<?	
	}
?>