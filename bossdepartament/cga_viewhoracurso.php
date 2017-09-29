<?
	session_start();
	include "../include/funcget.php";
	include "../include/funcsql.php";
	include "../include/funcstyle.php";
	include "../include/funcoption.php";
	if(fsafetylogin())
	{
		$bDatos = FALSE;
		if(!empty($_POST['rCod_cur']))
		{
			$_SESSION["sHoracod_cur"] = $_POST['rCod_cur'];
			$bDatos = TRUE;
			
			$vQuery = "select hrs_teo, hrs_pra, crd_cur from curso where cod_car = '{$_SESSION['sHoracod_car']}' and ";
			$vQuery .= "pln_est = '{$_SESSION['sHorapln_est']}' and cod_cur = '{$_SESSION['sHoracod_cur']}'";
			$cResult = fQuery($vQuery);
			if($aResult = mysql_fetch_array($cResult))
			{
				$_SESSION["sHorahrs_teo"] = $aResult['hrs_teo'];
				$_SESSION["sHorahrs_pra"] = $aResult['hrs_pra'];
				$_SESSION["sHoracrd_cur"] = $aResult['crd_cur'];
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
		<table border="0" cellpadding="0" cellspacing="1" bordercolor="#FF0000" class="tviewdata">
		  <tr>
		    <td width="100">Horas : </td>
		    <th width="120">HT=<?=$_SESSION["sHorahrs_teo"]?>, HP=<?=$_SESSION["sHorahrs_pra"]?>, TH=<?=$_SESSION["sHorahrs_teo"]+$_SESSION["sHorahrs_pra"]?></th>
		    <td width="100">Cr&eacute;ditos : </td>
		    <th width="120"><?=$_SESSION["sHoracrd_cur"]?></th>
	      </tr>
		</table>
		<div id="dsave"> 
		<table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td id="dsavecurso"><div class="dboton"><a href="" onclick="cga_savecarga(document.fData); return false;" class="isave" title="Guardar" >Guardar</a></div>
                </td>
          </tr>
        </table>
		</div>
		
<?	
	}
?>