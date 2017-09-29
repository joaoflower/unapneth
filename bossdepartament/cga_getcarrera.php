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
		$vNombres = "";
		
		$vQuery = "select paterno, materno, nombres from docente ";
		$vQuery .= "where cod_car = '{$_SESSION['sUsercod_car']}' and cod_prf = '{$_POST['rCod_prf']}' ";
			
		$cResult = fQuery($vQuery);
		if($aResult = mysql_fetch_array($cResult))
		{
			$bDatos = TRUE;
			$vNombres = "{$aResult['paterno']} {$aResult['materno']}, {$aResult['nombres']}";
		}	
		
	}
	else
	{
		header("Location:../index.php");
	}
	
	if($bDatos == TRUE)
	{
		$_SESSION["sHoracod_prf"] = $_POST['rCod_prf'];
		$_SESSION["sHoracod_car"] = $_SESSION['sUsercod_car'];
		$_SESSION["sHorapln_est"] = '00';
		$_SESSION["sHoracod_esp"] = '00';		
		$_SESSION["sHoracaiu"] = $_POST['rIns_upd'];
?>
<center>
	<table border="0" cellpadding="0" cellspacing="0" class="tventana">
	  <tr>
		<td><img src="../images/ven_topleft.jpg" width="16" height="25" border="0" alt="" /></td>
		<th background="../images/ven_topcenter.jpg">Asignaci&oacute;n de Carga de <?=$vNombres?></th>
		<td><img src="../images/ven_topright.jpg" width="16" height="25" border="0" alt="" /></td>
	  </tr>
	  <tr>
		<td background="../images/ven_mediumleft.jpg"></td>
		<td align="center">
		<span class="wordi">SELECCIONE EL PLAN DE ESTUDIOS, SEMESTRE, CURSO Y GRUPO. </span>
		<table border="0" cellpadding="0" cellspacing="1" bordercolor="#FF0000" class="tviewdata">
		  <tr>
			<td width="100">Escuela Prof. </td>
			<th width="350"><select name="rCod_car" id="rCod_car" onchange="cga_viewcarreradata(this.value); return false;" >
					<?=fviewcarrera($_SESSION["sUsercod_car"])?>
		        </select></th>
		  </tr>
		</table>
		<div id="dplan"> 
			<? include "cga_getcarreradata.php"; ?>
		</div>		
		
		</td>
		<td background="../images/ven_mediumright.jpg"></td>
	  </tr>
	  <tr>
		<td><img src="../images/ven_bottomleft.jpg" width="16" height="16" border="0" alt="" /></td>
		<td background="../images/ven_bottomcenter.jpg"></td>
		<td><img src="../images/ven_bottomright.jpg" width="16" height="16" border="0" alt="" /></td>
	  </tr>
	</table>
	
	<div id="dcheckhora">
			
	</div>
		
</center>
<?
	}
	else
	{
		echo "NO ENTRO";
	}
?>

