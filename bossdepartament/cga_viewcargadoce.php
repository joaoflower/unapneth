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
		$vCont = 1;
	}
	else
	{
		header("Location:../index.php");
	}
	
?>
<center>
	<table border="0" cellpadding="0" cellspacing="0" class="tventana">
	  <tr>
		<td><img src="../images/ven_topleft.jpg" width="16" height="25" border="0" alt="" /></td>
		<th background="../images/ven_topcenter.jpg">Docentes con Carga Acad&eacute;mica  </th>
		<td><img src="../images/ven_topright.jpg" width="16" height="25" border="0" alt="" /></td>
	  </tr>
	  <tr>
		<td background="../images/ven_mediumleft.jpg"></td>
		<td align="center">
			<table border="0" cellpadding="0" cellspacing="0" bordercolor="#FF0000" class="tlistsearch">
				<tr>
				  <th width="10">&nbsp;</th>
				  <th width="100">Paterno</th>
				  <th width="100">Materno</th>
				  <th width="100">Nombres</th>
				  <th width="50">Cant.</th>
				  <th width="16">&nbsp;</th>
				</tr>
			<?
			$tCarga = "carga".$_SESSION['sFrameano_aca'];
			
			$vQuery = "select ca.cod_prf, do.paterno, do.materno, do.nombres, count(*) as canti ";
			$vQuery .= "from $tCarga ca left join docente do on ca.cod_prf = do.cod_prf ";
			$vQuery .= "where ca.per_aca = '{$_SESSION['sFrameper_aca']}' and do.cod_car = '{$_SESSION['sUsercod_car']}' ";
			$vQuery .= "group by ca.cod_prf ";
			$vQuery .= "order by do.paterno, do.materno, do.nombres ";
			
			$cResult = fQuery($vQuery);
			$vNum_rows = fCountq($cResult);
			while($aResult = mysql_fetch_array($cResult))
			{
			?>
				<tr <?=ftrstyle($vCont)?>  onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
				  <td <?=ftdstyle($vNum_rows, $vCont)?>><?=$vCont?></td>
				  <td <?=ftdstyle($vNum_rows, $vCont)?>><?=ucwords(strtolower($aResult['paterno']))?></td>
				  <td <?=ftdstyle($vNum_rows, $vCont)?>><?=ucwords(strtolower($aResult['materno']))?></td>
				  <td <?=ftdstyle($vNum_rows, $vCont)?>><?=ucwords(strtolower($aResult['nombres']))?></td>
				  <td <?=ftdstyle($vNum_rows, $vCont)?>><?=$aResult['canti']?></td>
				  <td <?=ftdstyle($vNum_rows, $vCont)?>><a href="" onClick="cga_viewcargacurso('<?=$aResult['cod_prf']?>'); return false;" class="enlaceb"><img src="../images/browse.png" alt="Ver Cursos " width="16" height="16" /></a></td>
				</tr>
			<? 
				$vCont++; 	
			} 
			?>
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
		<td><div class="dboton"><a href="" onclick = "cga_newcarga(); return false;" class="inew" title="Nueva Carga">Nueva Car.</a></div>
		</td>
	  </tr>
	</table>
			
</center>
