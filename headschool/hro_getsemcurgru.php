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
		
//		if($_SESSION['sSilaend_ing'] == 'F')
//		{
			$bDatos = TRUE;
//		}
		
		$tCarga = "cargaint".$_SESSION['sFrameano_aca'];
		$tIngnota = "ingnota".$_SESSION['sFrameano_aca'];		
		
	}
	else
	{
		header("Location:../index.php");
	}
	
	if($bDatos == TRUE)
	{
//		$_SESSION["sSilacod_car"] = $_SESSION['sUsercod_car'];

		$_SESSION["sHorapln_est"] = '00';
		$_SESSION["sHoracod_esp"] = '00';
		
		
		$vQuery = "select pln_est from plan where cod_car = '{$_SESSION['sUsercod_car']}' and con_pln = '1' ";
		$cResult = fQuery($vQuery);
		if($aResult = mysql_fetch_array($cResult))
		{
			$_SESSION["sHorapln_est"] = $aResult['pln_est'];
			
			$vQuery = "select cod_esp from especial where cod_car = '{$_SESSION['sUsercod_car']}' and pln_est = '{$_SESSION['sHorapln_est']}' ";
			$cResult = fQuery($vQuery);
			if($aResult = mysql_fetch_array($cResult))
			{
				$_SESSION["sHoracod_esp"] = $aResult['cod_esp'];
			}
		}
			
		$_SESSION["sHoracod_cur"] = "999";
		$_SESSION["sHorasec_gru"] = "01";
		$_SESSION["sHoramod_mat"] = "01";
		$_SESSION["sHorasem_anu"] = "01";
		$_SESSION["sHoratur_est"] = "1";
		$_SESSION["sHoracaiu"] = $_POST['rIns_upd'];
?>
<center>
	<form action="#" method="post" enctype="multipart/form-data" name="fData" id="fData">
	<table border="0" cellpadding="0" cellspacing="0" class="tventana">
	  <tr>
		<td><img src="../images/ven_topleft.jpg" width="16" height="25" border="0" alt="" /></td>
		<th background="../images/ven_topcenter.jpg">Nuevo horario </th>
		<td><img src="../images/ven_topright.jpg" width="16" height="25" border="0" alt="" /></td>
	  </tr>
	  <tr>
		<td background="../images/ven_mediumleft.jpg"></td>
		<td align="center">
		<span class="wordi">SELECCIONE EL PLAN DE ESTUDIOS, SEMESTRE, CURSO Y GRUPO. </span>
		<table border="0" cellpadding="0" cellspacing="1" bordercolor="#FF0000" class="tviewdata">
		  <tr>
			<td width="100">Plan de Est. </td>
			<th width="350"><select name="rPln_est" id="rPln_est" onchange="hro_viewsemcurgru(this.value); return false;">
			  <?=fviewhoplan($_SESSION['sUsercod_car'], $_SESSION["sHorapln_est"])?>
			</select></th>
		  </tr>
		</table>
		<div id="dsemcurgru"> 
			<? include "hro_getsemcurgrudata.php"; ?>
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
	
  </form>	
</center>
<?
	}
?>
