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
		if(!empty($_POST['rCod_prf']))
		{
			$_SESSION['sHabicod_prf'] = $_POST['rCod_prf'];
			$_SESSION['sHabicod_car'] = "";
			
			$vQuery = "Select cod_car, paterno, materno, nombres from docente where cod_prf = '{$_POST['rCod_prf']}' ";
			
			$cResult = fQuery($vQuery);
			if($aResult = mysql_fetch_array($cResult))
			{
				$_SESSION['sHabicod_car'] = $aResult['cod_car'];
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
		<th background="../images/ven_topcenter.jpg">Habilitaci&oacute;n de Docente</th>
		<td><img src="../images/ven_topright.jpg" width="16" height="25" border="0" alt="" /></td>
	  </tr>
	  <tr>
		<td background="../images/ven_mediumleft.jpg"></td>
		<td align="center">
			<table border="0" cellpadding="0" cellspacing="1" bordercolor="#FF0000" class="tviewdata">
			  
			  <tr>
			    <td>Docente: </td>
			    <th><?=$vNombre?></th>
		      </tr>
			  <tr>
			    <td width="75">Documento :</td>
			    <th width="375"><label>
			      <textarea name="rDoc_hab" id="rDoc_hab" cols="65" rows="2"></textarea>
			    </label></th>
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
			<div class="dboton"><a href="" onClick="doc_savedocuhabi(document.fData); return false;" class="isave" title="Guardar y Habilitar" >Guardar</a></div>
        	<div class="dboton"><a href="" onClick="cancel(); return false;" class="icancel" title="Cancelar" >Cancelar</a></div>
		</td>
	  </tr>
	</table>
</center>
    
<?
	}
?>