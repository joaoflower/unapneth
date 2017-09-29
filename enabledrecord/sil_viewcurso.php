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
		$bData = FALSE;
		$vNombres = "";
		
		$vQuery = "select paterno, materno, nombres from docente ";
		$vQuery .= "where cod_prf in (select distinct cod_prf from silabo2008 ";
		$vQuery .= "where cod_car = '{$_SESSION['sUsercod_car']}' and cod_prf = '{$_POST['rCod_prf']}') ";
		$vQuery .= "and cod_prf = '{$_POST['rCod_prf']}' ";
			
		$cResult = fQuery($vQuery);
		$vNum_rows = fCountq($cResult);
		if($aResult = mysql_fetch_array($cResult))
		{
			$bData = TRUE;
			$vNombres = "{$aResult['paterno']} {$aResult['materno']}, {$aResult['nombres']}";
		}
		
	}
	else
	{
		header("Location:../index.php");
	}
	
	if($bData == TRUE)
	{
?>
<center>
	<table border="0" cellpadding="0" cellspacing="0" class="tventana">
	  <tr>
		<td><img src="../images/ven_topleft.jpg" width="16" height="25" border="0" alt="" /></td>
		<th background="../images/ven_topcenter.jpg">Silabos de: <?=$vNombres?></th>
		<td><img src="../images/ven_topright.jpg" width="16" height="25" border="0" alt="" /></td>
	  </tr>
	  <tr>
		<td background="../images/ven_mediumleft.jpg"></td>
		<td align="center">
			<table border="0" cellpadding="0" cellspacing="0" bordercolor="#FF0000" class="tlistsearch">
				<tr>
				  <th width="10">&nbsp;</th>
				  <th width="250">Curso</th>
				  <th width="20">Sm</th>
				  <th width="20">Es</th>
				  <th width="50">Grupo</th>
				  <th width="50">Modalidad</th>
				  <th width="20">Hrs</th>
				  <th width="170">Escuela Profesional </th>
			  	  <th width="16">&nbsp;</th>
				</tr>
			<?
			$tSilabo = "silabo".$_SESSION['sFrameano_aca'];
			
			$vQuery = "select si.cod_car, si.pln_est, si.cod_cur, si.mod_mat, si.sec_gru, ";
			$vQuery .= "cu.nom_cur, cu.sem_anu, cu.cod_esp, gr.sec_des, mn.not_des, cu.hrs_tot, cr.car_des ";
			$vQuery .= "from $tSilabo si left join curso cu on si.cod_car = cu.cod_car and ";
			$vQuery .= "si.pln_est = cu.pln_est and si.cod_cur = cu.cod_cur ";
			$vQuery .= "left join grupo gr on si.sec_gru = gr.sec_gru ";
			$vQuery .= "left join modnot mn on si.mod_mat = mn.mod_not ";
			$vQuery .= "left join carrera cr on si.cod_car = cr.cod_car ";
			$vQuery .= "where si.per_aca = '{$_SESSION['sFrameper_aca']}' and si.cod_car = '{$_SESSION['sUsercod_car']}' ";
			$vQuery .= "and si.cod_prf = '{$_POST['rCod_prf']}' ";
			$vQuery .= "order by cod_car, sem_anu, cod_esp, sec_gru ";
			
			$cResult = fQuery($vQuery);
			$vNum_rows = fCountq($cResult);
			while($aResult = mysql_fetch_array($cResult))
			{
				$vNamefile = "unapnet8/teacher/silabus/{$_SESSION['sFrameano_aca']}/car{$_SESSION['sUsercod_car']}/{$_SESSION['sFrameano_aca']}{$_SESSION['sFrameper_aca']}{$_SESSION['sUsercod_car']}{$aResult['pln_est']}{$aResult['cod_cur']}{$aResult['sec_gru']}{$aResult['mod_mat']}_{$_POST['rCod_prf']}.";
                
				if(file_exists("/var/www/html/".$vNamefile."doc"))
				{
					$vNamefile .= "doc";
				}
				elseif(file_exists("/var/www/html/".$vNamefile."pdf"))
				{
					$vNamefile .= "pdf";
				}
				elseif(file_exists("/var/www/html/".$vNamefile."xls"))
				{
					$vNamefile .= "xls";
				}
				else
				{
					$vNamefile = "";
				}
				
			?>
				<tr <?=ftrstyle($vCont)?>  onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
				  <td <?=ftdstyle($vNum_rows, $vCont)?>><?=$vCont?></td>
				  <td <?=ftdstyle($vNum_rows, $vCont)?>><?=ucwords(strtolower($aResult['nom_cur']))?></td>
				  <td <?=ftdstyle($vNum_rows, $vCont)?>><?=$aResult['sem_anu']?></td>
				  <td <?=ftdstyle($vNum_rows, $vCont)?>><?=$aResult['cod_esp']?></td>
				  <td <?=ftdstyle($vNum_rows, $vCont)?>><?=ucwords(strtolower($aResult['sec_des']))?></td>
				  <td <?=ftdstyle($vNum_rows, $vCont)?>><?=ucwords(strtolower($aResult['not_des']))?></td>
				  <td <?=ftdstyle($vNum_rows, $vCont)?>><?=$aResult['hrs_tot']?></td>
				  <td <?=ftdstyle($vNum_rows, $vCont)?>><?=ucwords(strtolower($aResult['car_des']))?></td>
			  	  <td <?=ftdstyle($vNum_rows, $vCont)?>><a href="http://unapvirtual.unap.edu.pe/<?=$vNamefile?>"  class="enlaceb"><img src="../images/browse.png" alt="Ver estudiantes" width="16" height="16" /></a></td>
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
			
</center>
<?
	}
?>
