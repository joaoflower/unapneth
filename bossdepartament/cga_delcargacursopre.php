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
		if(!empty($_POST['rCod_prf']) and !empty($_POST['rCod_car']) and !empty($_POST['rPln_est']) and !empty($_POST['rCod_cur']) and !empty($_POST['rSec_gru']) and !empty($_POST['rMod_mat']))
		{
			$vQuery = "select paterno, materno, nombres from docente ";
			$vQuery .= "where cod_prf  = '{$_POST['rCod_prf']}' ";
				
			$cResult = fQuery($vQuery);
			$vNum_rows = fCountq($cResult);
			if($aResult = mysql_fetch_array($cResult))
			{
				$bData = TRUE;
				$vNombres = "{$aResult['paterno']} {$aResult['materno']}, {$aResult['nombres']}";
			}
			
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

	<center>
	<table border="0" cellpadding="0" cellspacing="0" class="tventana">
      <tr>
        <td><img src="../images/ven_topleft.jpg" width="16" height="25" border="0" alt="" /></td>
        <th background="../images/ven_topcenter.jpg">Eliminar Carga Asignada </th>
        <td><img src="../images/ven_topright.jpg" width="16" height="25" border="0" alt="" /></td>
      </tr>
      <tr>
        <td background="../images/ven_mediumleft.jpg"></td>
        <td align="center"><div id="devaluatipo">
          	<span class="wordi"><strong>¿ ESTAS SEGURO QUE DESEAS ELIMINAR LA CARGA <br />
			DEL DOCENTE <?=$vNombres?>?</strong></span>
			<table border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td>
							<div class="dboton"><a href="" onClick = "cga_delcargacurso('<?=$_POST['rCod_prf']?>', '<?=$_POST['rCod_car']?>', '<?=$_POST['rPln_est']?>', '<?=$_POST['rCod_cur']?>', '<?=$_POST['rSec_gru']?>', '<?=$_POST['rMod_mat']?>'); return false;" class="iok" title="Aceptar">Aceptar</a></div>
							<div class="dboton"><a href="" onClick="cga_viewcargacurso('<?=$_POST['rCod_prf']?>');  return false;" class="icancel" title="Cancelar">Cancelar</a></div>
						</td>
					  </tr>
			</table>
        </div></td>
        <td background="../images/ven_mediumright.jpg"></td>
      </tr>
      <tr>
        <td><img src="../images/ven_bottomleft.jpg" width="16" height="16" border="0" alt="" /></td>
        <td background="../images/ven_bottomcenter.jpg"></td>
        <td><img src="../images/ven_bottomright.jpg" width="16" height="16" border="0" alt="" /></td>
      </tr>
    </table>
	</center>
	
<?
	}
?>