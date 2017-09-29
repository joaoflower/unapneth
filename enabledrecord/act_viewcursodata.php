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
		$vCont = 1;
		
		$_SESSION['sActacod_car'] = $_POST['rCod_car'];
		$_SESSION['sActapln_est'] = $_POST['rPln_est'];
		$_SESSION['sActacod_cur'] = $_POST['rCod_cur'];
		$_SESSION['sActasec_gru'] = $_POST['rSec_gru'];
		$_SESSION['sActamod_mat'] = $_POST['rMod_mat'];
		$_SESSION['sActamod_mat'] = $_POST['rMod_mat'];
		$_SESSION['sActaest_act'] = "1";
		$_SESSION['sActacan_cap'] = 0;
		$_SESSION['sActacan_act'] = 0;
				
		$vCod_act = "SIN CODIGO";
		$vDesEstado = "ACTA SIN NOTAS";
		
		$tCarga = "cargaint".$_SESSION['sFrameano_aca'];
		
		$vQuery = "select car.*, esp.esp_nom, sem.sem_des ";
		$vQuery .= "from ( ";
		$vQuery .= "select ca.cod_car, ca.pln_est, cu.nom_cur, cu.sem_anu, cu.cod_esp, gr.sec_des, ";
		$vQuery .= "mm.mod_des, cr.car_des, cu.crd_cur ";
		$vQuery .= "from $tCarga ca left join curso cu on ca.cod_car = cu.cod_car and ";
		$vQuery .= "ca.pln_est = cu.pln_est and ca.cod_cur = cu.cod_cur ";
		$vQuery .= "left join grupo gr on ca.sec_gru = gr.sec_gru ";
		$vQuery .= "left join modmat mm on ca.mod_mat = mm.mod_act ";
		$vQuery .= "left join carrera cr on ca.cod_car = cr.cod_car ";
		$vQuery .= "where ca.per_aca = '{$_SESSION['sFrameper_aca']}' and ca.cod_car = '{$_POST['rCod_car']}' and ";
		$vQuery .= "ca.pln_est = '{$_POST['rPln_est']}' and ca.cod_cur = '{$_POST['rCod_cur']}' and ";
		$vQuery .= "ca.sec_gru = '{$_POST['rSec_gru']}' and mm.mod_act = '{$_POST['rMod_mat']}' ";
		$vQuery .= ") car ";
		$vQuery .= "left join especial esp on car.cod_car = esp.cod_car and car.pln_est = esp.pln_est and ";
		$vQuery .= "car.cod_esp = esp.cod_esp ";
		$vQuery .= "left join semestre sem on car.sem_anu = sem.sem_anu";
		
		$_SESSION['sPrnSql1'] = $vQuery;
		
		$cResult = fQuery($vQuery);
		if($aResult = mysql_fetch_array($cResult))
		{
			$bDatos = TRUE;
		}
	}
	else
	{
		header("Location:../index.php");
	}
	
	if($bDatos == TRUE)
	{
		//-------------------------------------------------------------------------
		$tActa = "acta".$_SESSION['sFrameano_aca'];

		$vQuery = "select cod_act from $tActa ";
		$vQuery .= "where pln_est = '{$_POST['rPln_est']}' and cod_cur = '{$_POST['rCod_cur']}' and ";
		$vQuery .= "sec_gru = '{$_POST['rSec_gru']}' and mod_mat = '{$_POST['rMod_mat']}' and ";
		$vQuery .= "cod_car = '{$_POST['rCod_car']}' and per_aca = '{$_SESSION['sFrameper_aca']}' ";
		
		$cResultc = fQuery($vQuery);
		if($aResultc = mysql_fetch_array($cResultc))
		{
			$vCod_act = $aResultc['cod_act'];
			$_SESSION['sActaest_act'] = "2";
			$vDesEstado = "ACTA IMPRESA";
		}
	
		//-----------------------------------------------------------------------------
		$tIngnota = "ingnota".$_SESSION['sFrameano_aca'];

		$vQuery = "select can_cap, can_act, ingresado from $tIngnota ";
		$vQuery .= "where pln_est = '{$_POST['rPln_est']}' and cod_cur = '{$_POST['rCod_cur']}' and ";
		$vQuery .= "sec_gru = '{$_POST['rSec_gru']}' and mod_mat = '{$_POST['rMod_mat']}' and ";
		$vQuery .= "cod_car = '{$_POST['rCod_car']}' and per_aca = '{$_SESSION['sFrameper_aca']}' ";
		
		$cResulte = fQuery($vQuery);
		if($aResulte = mysql_fetch_array($cResulte))
		{
			$_SESSION['sActacan_cap'] = $aResulte['can_cap'];
			$_SESSION['sActacan_act'] = $aResulte['can_act'];

			if($_SESSION['sActaest_act'] != "2")
			{
				if($aResulte['ingresado'] === 'F')
				{
					$_SESSION['sActaest_act'] = "3";
					$vDesEstado = "ACTA SIN GUARDAR";
				}
				else
				{
					$_SESSION['sActaest_act'] = "4";
					$vDesEstado = "ACTA GUARDADA";
				}
			}
		}

?>
<center>
<form action="#" method="post" enctype="multipart/form-data" name="fData" id="fData">
	<table border="0" cellpadding="0" cellspacing="0" class="tventana">
	  <tr>
		<td><img src="../images/ven_topleft.jpg" width="16" height="25" border="0" alt="" /></td>
		<th background="../images/ven_topcenter.jpg">Acta de: <?=$_SESSION['sUsernom_prf']?></th>
		<td><img src="../images/ven_topright.jpg" width="16" height="25" border="0" alt="" /></td>
	  </tr>
	  <tr>
		<td background="../images/ven_mediumleft.jpg"></td>
		<td align="center">
			<table border="0" cellpadding="0" cellspacing="1" bordercolor="#FF0000" class="tviewdata">
			  
			  <tr>
			    <td>Escuela Prof. :</td>
			    <th colspan="3"><?=$aResult['car_des']?></th>
	          </tr>
			  <tr>
			    <td>Curso :</td>
			    <th colspan="3"><?=$aResult['nom_cur']?></th>
		      </tr>
			  <tr>
			    <td>Menci&oacute;n : </td>
			    <th colspan="3"><?=$aResult['esp_nom']?></th>
		      </tr>
			  <tr>
			    <td width="75">Semestre :</td>
			    <th width="150"><?=$aResult['sem_des']?></th>
			    <td width="75">Modalidad :</td>
			    <th width="150"><?=$aResult['mod_des']?></th>
		      </tr>
			  <tr>
			    <td>Grupo :</td>
			    <th><?=$aResult['sec_des']?></th>
		        <td>Creditos :</td>
		        <th><?=$aResult['crd_cur']?></th>
			  </tr>
			  <tr>
			    <td>Estado: </td>
			    <th><?=$vDesEstado?></th>
			    <td>Cod. Acta :</td>
			    <th><?=$vCod_act?></th>
		      </tr>
			</table>
		
		</td>
		<td background="../images/ven_mediumright.jpg"></td>
	  </tr>
	  <tr>
		<td><img src="../images/ven_bottomleft.jpg" width="16" height="16" border="0" alt="" /></td>
		<td background="../images/ven_bottomcenter.jpg"></td>
		<td><img src="../images/ven_bottomright.jpg" width="16" height="16" border="0" alt="" /></td>
	  </tr>
	</table>

	<div id="dhabilita"> 
		<?	include "act_botonhabi.php";	?>
    </div>
	
</form>	
</center>
    
<?
	}
?>