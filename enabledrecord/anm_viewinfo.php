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
		if(!empty($_POST['rNum_mat']) and !empty($_POST['rCod_car']))
		{
			$_SESSION['sHabinum_mat'] = $_POST['rNum_mat'];
			$_SESSION['sHabicod_car'] = $_POST['rCod_car'];
			
			$vQuery = "Select es.paterno, es.materno, es.nombres, ca.car_des, es.ult_mat, es.ult_per, ta.can_pag ";
			$vQuery .= "from estudiante es left join carrera ca on es.cod_car = ca.cod_car ";
			$vQuery .= "left join tarifanmis ta on es.ult_mat = ta.ult_mat and es.ult_per = ta.ult_per ";
			$vQuery .= "where es.num_mat = '{$_POST['rNum_mat']}' and es.cod_car = '{$_POST['rCod_car']}' and ";
			$vQuery .= "es.con_est = 'A'  ";
			//and (es.ult_per = '01' or es.ult_per = '02')
			
			$cResult = fQuery($vQuery);
			if($aResult = mysql_fetch_array($cResult))
			{
				$vNombre = $aResult['paterno']." ".$aResult['materno'].", ".$aResult['nombres'];
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
	<table border="0" cellpadding="0" cellspacing="0" class="tventana">
	  <tr>
		<td><img src="../images/ven_topleft.jpg" width="16" height="25" border="0" alt="" /></td>
		<th background="../images/ven_topcenter.jpg">Habilitaci&oacute;n de Estudiante Anmistiado </th>
		<td><img src="../images/ven_topright.jpg" width="16" height="25" border="0" alt="" /></td>
	  </tr>
	  <tr>
		<td background="../images/ven_mediumleft.jpg"></td>
		<td align="center">
			<table border="0" cellpadding="0" cellspacing="1" bordercolor="#FF0000" class="tviewdata">
			  
			  <tr>
			    <td>Estudiante: </td>
			    <th><?=$vNombre?></th>
		      </tr>
			  <tr>
			    <td>Escuela Prof.: </td>
			    <th><?=$aResult['car_des']?></th>
		      </tr>
			  <tr>
			    <td>&Uacute;ltima Mat.: </td>
			    <th><?=$aResult['ult_mat']?>-<?=$aResult['ult_per']?> </th>
		      </tr>
			  <tr>
			    <td width="75">Pago Adic.  :</td>
			    <th width="375">S/. <?=($aResult['can_pag']*30.0)?> nuevos soles con 00/100 </th>
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

	<table border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td>
			<div class="dboton"><a href="" onClick="anm_saveanmistia(); return false;" class="isave" title="Guardar y Habilitar" >Guardar</a></div>
        	<div class="dboton"><a href="" onClick="cancelanmistia(); return false;" class="icancel" title="Cancelar" >Cancelar</a></div>
		</td>
	  </tr>
	</table>
</center>
    
<?
	}
?>