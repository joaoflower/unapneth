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
		$tCurmat = "curmat".$_SESSION["sActacod_car"].$_SESSION['sFrameano_aca'];
		$tNotaca = "notaca".$_SESSION["sActacod_car"].$_SESSION['sFrameano_aca'];
	
		$sEstu = "";
		$sCurso = "";
		$vCont = 1;
		$vQuery = "select num_mat, cod_car, paterno, materno, nombres from estudiante where num_mat = '{$_POST['rNum_mat']}' and (con_est = '1' or con_est = 'V') ";
		$cResult = fQuery($vQuery);
		$vNum_rows = fCountq($cResult);
		while($aResult = mysql_fetch_array($cResult))
		{
			$sEstu['num_mat'] = $aResult['num_mat'];
			$sEstu['car_car'] = $aResult['cod_car'];
			$sEstu['paterno'] = $aResult['paterno'];
			$sEstu['materno'] = $aResult['materno'];
			$sEstu['nombres'] = $aResult['nombres'];
			
			$tCurmat = "curmat".$sEstu['car_car'].$_SESSION['sFrameano_aca'];
			$tNotaca = "notaca".$sEstu['car_car'].$_SESSION['sFrameano_aca'];
			$tIngnota = "ingnota".$_SESSION['sFrameano_aca'];
		}
		
		

	}
	else
	{
		header("Location:../index.php");
	}
	
?>
<center>
<form action="#" method="post" enctype="multipart/form-data" name="fData" id="fData">
	<?
		$vAno_aca = '2006';
		$vPer_aca2 = '01';
		for($vAno_aca = '2006';$vAno_aca<='2008';$vAno_aca++)
		{
			$tCurmat = "curmat".$sEstu['car_car'].$vAno_aca;
			$tApla = "apla".$vAno_aca;
			$tNotaca = "notaca".$sEstu['car_car'].$vAno_aca;
			$tIngnota = "ingnota".$vAno_aca;
			
			for($vPer_aca2 = '1';$vPer_aca2<='3';$vPer_aca2++)
			{				
				$vPer_aca = '0'.$vPer_aca2;
				if($vAno_aca.$vPer_aca != '200601')
				{
				
	?>
	<table border="0" cellpadding="0" cellspacing="0" class="tventana">
	  <tr>
		<td><img src="../images/ven_topleft.jpg" width="16" height="25" border="0" alt="" /></td>
		<th background="../images/ven_topcenter.jpg">Notas <?=$vAno_aca?> - <?=$vPer_aca?></th>
		<td><img src="../images/ven_topright.jpg" width="16" height="25" border="0" alt="" /></td>
	  </tr>
	  <tr>
		<td background="../images/ven_mediumleft.jpg"></td>
		<td align="center">
		
			<table border="0" cellpadding="0" cellspacing="0" class="tlistdata">
			  <tr>
			    <th width="15">N&deg;</th>
			    <th width="30">C&oacute;digo </th>
				<th width="210">Nombre del curso </th>
		        <th width="60">Modalidad</th>
		        <th width="40">Capacidades</th>
		        <th width="18">PC</th>
		        <th width="40">Actitudes</th>
		        <th width="17">PA</th>
		        <th width="18">PF</th>
			  </tr>
			  <?
				
				$vQuery = "select cm.pln_est, cm.cod_cur, cu.nom_cur, cm.mod_mat, cm.sec_gru ";
				$vQuery .= "from $tCurmat cm left join curso cu on cm.cod_car = cu.cod_car and cm.pln_est = cu.pln_est and cm.cod_cur = cu.cod_cur ";
				$vQuery .= "where cm.num_mat = '{$_POST['rNum_mat']}' and cm.per_aca = '$vPer_aca'";
				$cCurso= fQuery($vQuery);
				$vNum_rows = fCountq($cCurso);
				while($aCurso = mysql_fetch_array($cCurso))
				{
					$sNotacap = "";
					$sNotaact = "";
					
					$vCan_cap = 0;
					$vCan_act = 0;
					
					$vCan_cap2 = 0;
					$vCan_act2 = 0;
					
					$vPro_cap = 0;
					$vPro_act = 0;
					$vPro_fin = 0;
					
					$sCurso['pln_est'] = $aCurso['pln_est'];
					$sCurso['cod_cur'] = $aCurso['cod_cur'];
					$sCurso['cur_des'] = $aCurso['cur_des'];
					$sCurso['mod_mat'] = $aCurso['mod_mat'];
					$sCurso['sec_gru'] = $aCurso['sec_gru'];
					
					//--------------------------------------------------------------
					$vQuery = "select can_cap, can_act, ingresado ";
					$vQuery .= "from $tIngnota ";
					$vQuery .= "where pln_est = '{$sCurso['pln_est']}' and cod_cur = '{$sCurso['cod_cur']}' and ";
					$vQuery .= "sec_gru = '{$sCurso['sec_gru']}' and mod_mat = '{$sCurso['mod_mat']}' and ";
					$vQuery .= "cod_car = '{$sEstu['car_car']}' and ano_aca = '$vAno_aca' and ";
					$vQuery .= "per_aca = '$vPer_aca' ";
					
					$cResult = fQuery($vQuery);
					if($aIngnota = mysql_fetch_array($cResult))
					{
						$vCan_cap = $sCurso['can_cap'] = $aIngnota['can_cap'];
						$vCan_act = $sCurso['can_act'] = $aIngnota['can_act'];
					}
					
					(empty($vCan_cap)?$vCan_cap=0:$vCan_cap=$vCan_cap);
					(empty($vCan_act)?$vCan_act=0:$vCan_act=$vCan_act);
					
					if($vCan_cap ==0)
					{
						$vQuery = "SELECT sum(if(tip_not = 'C', 1, 0)) as can_cap, sum(if(tip_not = 'A', 1, 0)) as can_act ";
						$vQuery .= "FROM $tNotaca where num_mat = '{$sEstu['num_mat']}' and pln_est = '{$sCurso['pln_est']}' ";
						$vQuery .= "and cod_cur = '{$sCurso['cod_cur']}' and mod_not != '08'";
						
						$cResult = fQuery($vQuery);
						if($aIngnota = mysql_fetch_array($cResult))
						{
							$vCan_cap = $sCurso['can_cap'] = $aIngnota['can_cap'];
							$vCan_act = $sCurso['can_act'] = $aIngnota['can_act'];
						}
						
						(empty($vCan_cap)?$vCan_cap=0:$vCan_cap=$vCan_cap);
						(empty($vCan_act)?$vCan_act=0:$vCan_act=$vCan_act);
					}
					
					//------------------------------------------------------------------
					if($sCurso['can_cap'] > 0)
					{
						$vQuery = "select no.num_mat, no.ord_not, no.not_cur  ";
						$vQuery .= "from $tNotaca no left join modmat mn on no.mod_not = mn.mod_not ";
						$vQuery .= "where no.cod_car = '{$sEstu['car_car']}' and no.pln_est = '{$sCurso['pln_est']}' and ";
						$vQuery .= "no.cod_cur = '{$sCurso['cod_cur']}' and no.ano_aca = '$vAno_aca' and ";
						$vQuery .= "no.per_aca = '$vPer_aca' and mn.mod_mat = '{$sCurso['mod_mat']}' and ";
						$vQuery .= "no.tip_not = 'C' and no.num_mat = '{$sEstu['num_mat']}' ";
/*						$vQuery .= "(Select num_mat from $tCurmat where per_aca = '01' and ";
						$vQuery .= "pln_est = '{$sCurso['pln_est']}' and cod_cur = '{$sCurso['cod_cur']}' and ";
						echo $vQuery .= "sec_gru = '{$sCurso['sec_gru']}' )";	*/
						
						$cNotacap = fQuery($vQuery);
						while($aNotacap = mysql_fetch_array($cNotacap))
						{
							$vCan_cap2++;
							$sNotacap[$aNotacap['num_mat']][$aNotacap['ord_not']] = $aNotacap['not_cur'];
						}
					}			
					if($sCurso['can_act'] > 0)
					{
						$vQuery = "select no.num_mat, no.ord_not, no.not_cur  ";
						$vQuery .= "from $tNotaca no left join modmat mn on no.mod_not = mn.mod_not ";
						$vQuery .= "where no.cod_car = '{$sEstu['car_car']}' and no.pln_est = '{$sCurso['pln_est']}' and ";
						$vQuery .= "no.cod_cur = '{$sCurso['cod_cur']}' and no.ano_aca = '$vAno_aca' and ";
						$vQuery .= "no.per_aca = '$vPer_aca' and mn.mod_mat = '{$sCurso['mod_mat']}' and ";
						$vQuery .= "no.tip_not = 'A' and no.num_mat = '{$sEstu['num_mat']}' ";
/*						$vQuery .= "(Select num_mat from $tCurmat where per_aca = '01' and ";
						$vQuery .= "pln_est = '{$sCurso['pln_est']}' and cod_cur = '{$sCurso['cod_cur']}' and ";
						$vQuery .= "sec_gru = '{$sCurso['sec_gru']}')";*/

						$cNotaact = fQuery($vQuery);
						while($aNotaact = mysql_fetch_array($cNotaact))
						{
							$vCan_act2++;
							$sNotaact[$aNotaact['num_mat']][$aNotaact['ord_not']] = $aNotaact['not_cur'];
						}
					}

			  ?>
			  <tr <?=ftrstyle($vCont)?>  onMouseOver="mouseover(this)" onMouseOut="mouseout(this)" id="rTr<?=$aResult['cod_cur']?>">
			    <td <?=ftdstyle($vNum_rows, $vCont)?>><?=$vCont?></td>
			    <td <?=ftdstyle($vNum_rows, $vCont)?>><?=$aCurso['cod_cur']?></td>
			    <td <?=ftdstyle($vNum_rows, $vCont)?>><?=ucwords(strtolower($aCurso['nom_cur']))?></td>
		        <td <?=ftdstyle($vNum_rows, $vCont)?>><?=ucwords(strtolower($aCurso['mod_mat']))?></td>
	            <td <?=ftdstyle($vNum_rows, $vCont)?>><table border="0" cellpadding="0" cellspacing="0" class="tlistdata" >
                 <tr >
					<?	for($i = 0; $i < $vCan_cap2;$i++)	{	$vPro_cap += $sNotacap[$sEstu['num_mat']][$i+1];  ?>
                   <td width="17"  <?=ftdstylenotaacta($sNotacap[$sEstu['num_mat']][$i+1])?>><?=$sNotacap[$sEstu['num_mat']][$i+1]?></td>
					<?	}	
						if($vCan_cap > 0)	
							$vPro_cap = round($vPro_cap/$vCan_cap2);						
					?>
                 </tr>
               </table></td>
	            <td bgcolor="#FFFFBF" <?=ftdstylenota($vNum_rows, $vCont, $vPro_cap)?>>
				<?	if($vCan_cap > 0)	{	echo $vPro_cap;	} ?>				</td>
	            <td <?=ftdstyle($vNum_rows, $vCont)?>><table border="0" cellpadding="0" cellspacing="0" class="tlistdata" >
                 <tr >
					<?	for($i = 0; $i < $vCan_act2;$i++)	{	$vPro_act += $sNotaact[$sEstu['num_mat']][$i+1];  ?>
                   <td width="17"  class="tdnotaapr"><?=$sNotaact[$sEstu['num_mat']][$i+1]?></td>
					<?	}	
						if($vCan_act > 0)	
							$vPro_act = round($vPro_act/$vCan_act2);						
					?>
                 </tr>
               </table></td>
	            <td bgcolor="#FFFFBF" <?=ftdstylenotaact($vNum_rows, $vCont)?>>
				<?	if($vCan_act > 0)	{	echo $vPro_act;	} ?>				</td>
				<?
					if($vCan_cap > 0 || $vCan_act > 0)	
					{	
						if($vCan_act > 0)	$vPro_fin = round(($vPro_cap * 0.9) + $vPro_act);	
						else $vPro_fin = $vPro_cap;
					}
				?>
				<td bgcolor="#B3FFB3" <?=ftdstylenota($vNum_rows, $vCont, $vPro_fin)?>>
				<?	if($vCan_cap > 0 || $vCan_act > 0)	{	echo $vPro_fin;	}	?>	            </td>
			  </tr>
			  <?
					$vCont++;
			  	}
				
				//----------------------------------------------------
				$vQuery = "select ap.pln_est, ap.cod_cur, cu.nom_cur, ap.mod_mat, ap.sec_gru ";
				$vQuery .= "from $tApla ap left join curso cu on ap.cod_car = cu.cod_car and ap.pln_est = cu.pln_est and ap.cod_cur = cu.cod_cur ";
				$vQuery .= "where ap.num_mat = '{$_POST['rNum_mat']}' and ap.cod_car = '{$sEstu['car_car']}' and ap.per_aca = '$vPer_aca' ";
				$cCurso= fQuery($vQuery);
				$vNum_rows = fCountq($cCurso);
				while($aCurso = mysql_fetch_array($cCurso))
				{
					$sNotacap = "";
					$sNotaact = "";
					
					$vCan_cap = 0;
					$vCan_act = 0;
					
					$vCan_cap2 = 0;
					$vCan_act2 = 0;
					
					$vPro_cap = 0;
					$vPro_act = 0;
					$vPro_fin = 0;
					
					$sCurso['pln_est'] = $aCurso['pln_est'];
					$sCurso['cod_cur'] = $aCurso['cod_cur'];
					$sCurso['cur_des'] = $aCurso['cur_des'];
					$sCurso['mod_mat'] = $aCurso['mod_mat'];
					$sCurso['sec_gru'] = $aCurso['sec_gru'];
					
					//--------------------------------------------------------------
					$vQuery = "select can_cap, can_act, ingresado ";
					$vQuery .= "from $tIngnota ";
					$vQuery .= "where pln_est = '{$sCurso['pln_est']}' and cod_cur = '{$sCurso['cod_cur']}' and ";
					$vQuery .= "sec_gru = '{$sCurso['sec_gru']}' and mod_mat = '{$sCurso['mod_mat']}' and ";
					$vQuery .= "cod_car = '{$sEstu['car_car']}' and ano_aca = '$vAno_aca' and ";
					$vQuery .= "per_aca = '$vPer_aca' ";
					
					$cResult = fQuery($vQuery);
					if($aIngnota = mysql_fetch_array($cResult))
					{
						$vCan_cap = $sCurso['can_cap'] = $aIngnota['can_cap'];
						$vCan_act = $sCurso['can_act'] = $aIngnota['can_act'];
					}
					
					(empty($vCan_cap)?$vCan_cap=0:$vCan_cap=$vCan_cap);
					(empty($vCan_act)?$vCan_act=0:$vCan_act=$vCan_act);
					
					if($vCan_cap == 0)
					{
						$vQuery = "SELECT sum(if(tip_not = 'C', 1, 0)) as can_cap, sum(if(tip_not = 'A', 1, 0)) as can_act ";
						$vQuery .= "FROM $tNotaca where num_mat = '{$sEstu['num_mat']}' and pln_est = '{$sCurso['pln_est']}' ";
						$vQuery .= "and cod_cur = '{$sCurso['cod_cur']}' and mod_not = '08'";
						
						$cResult = fQuery($vQuery);
						if($aIngnota = mysql_fetch_array($cResult))
						{
							$vCan_cap = $sCurso['can_cap'] = $aIngnota['can_cap'];
							$vCan_act = $sCurso['can_act'] = $aIngnota['can_act'];
						}
						
						(empty($vCan_cap)?$vCan_cap=0:$vCan_cap=$vCan_cap);
						(empty($vCan_act)?$vCan_act=0:$vCan_act=$vCan_act);
					}
					
					//------------------------------------------------------------------
					if($sCurso['can_cap'] > 0)
					{
						$vQuery = "select no.num_mat, no.ord_not, no.not_cur  ";
						$vQuery .= "from $tNotaca no ";
						$vQuery .= "where no.cod_car = '{$sEstu['car_car']}' and no.pln_est = '{$sCurso['pln_est']}' and ";
						$vQuery .= "no.cod_cur = '{$sCurso['cod_cur']}' and no.ano_aca = '$vAno_aca' and ";
						$vQuery .= "no.per_aca = '$vPer_aca' and no.mod_not = '08' and ";
						$vQuery .= "no.tip_not = 'C' and no.num_mat = '{$sEstu['num_mat']}' ";
/*						$vQuery .= "(Select num_mat from $tCurmat where per_aca = '01' and ";
						$vQuery .= "pln_est = '{$sCurso['pln_est']}' and cod_cur = '{$sCurso['cod_cur']}' and ";
						echo $vQuery .= "sec_gru = '{$sCurso['sec_gru']}' )";	*/
						
						$cNotacap = fQuery($vQuery);
						while($aNotacap = mysql_fetch_array($cNotacap))
						{
							$vCan_cap2++;
							$sNotacap[$aNotacap['num_mat']][$aNotacap['ord_not']] = $aNotacap['not_cur'];
						}
					}			

			  ?>
			  <tr <?=ftrstyle($vCont)?>  onMouseOver="mouseover(this)" onMouseOut="mouseout(this)" id="rTr<?=$aResult['cod_cur']?>">
			    <td <?=ftdstyle($vNum_rows, $vCont)?>><?=$vCont?></td>
			    <td <?=ftdstyle($vNum_rows, $vCont)?>><?=$aCurso['cod_cur']?></td>
			    <td <?=ftdstyle($vNum_rows, $vCont)?>><?=ucwords(strtolower($aCurso['nom_cur']))?></td>
		        <td <?=ftdstyle($vNum_rows, $vCont)?>><?=ucwords(strtolower($aCurso['mod_mat']))?></td>
	            <td <?=ftdstyle($vNum_rows, $vCont)?>><table border="0" cellpadding="0" cellspacing="0" class="tlistdata" >
                 <tr >
					<?	for($i = 0; $i < $vCan_cap2;$i++)	{	$vPro_cap += $sNotacap[$sEstu['num_mat']][$i+1];  ?>
                   <td width="17"  <?=ftdstylenotaacta($sNotacap[$sEstu['num_mat']][$i+1])?>><?=$sNotacap[$sEstu['num_mat']][$i+1]?></td>
					<?	}	
						if($vCan_cap > 0)	
							$vPro_cap = round($vPro_cap/$vCan_cap2);						
					?>
                 </tr>
               </table></td>
	            <td bgcolor="#FFFFBF" <?=ftdstylenota($vNum_rows, $vCont, $vPro_cap)?>>
				<?	if($vCan_cap > 0)	{	echo $vPro_cap;	} ?>				</td>
	            <td <?=ftdstyle($vNum_rows, $vCont)?>><table border="0" cellpadding="0" cellspacing="0" class="tlistdata" >
                 <tr >
					<?	for($i = 0; $i < $vCan_act2;$i++)	{	$vPro_act += $sNotaact[$sEstu['num_mat']][$i+1];  ?>
                   <td width="17"  class="tdnotaapr"><?=$sNotaact[$sEstu['num_mat']][$i+1]?></td>
					<?	}	
						if($vCan_act > 0)	
							$vPro_act = round($vPro_act/$vCan_act2);						
					?>
                 </tr>
               </table></td>
	            <td bgcolor="#FFFFBF" <?=ftdstylenotaact($vNum_rows, $vCont)?>>
				<?	if($vCan_act > 0)	{	echo $vPro_act;	} ?>				</td>
				<?
					if($vCan_cap > 0 || $vCan_act > 0)	
					{	
						if($vCan_act > 0)	$vPro_fin = round(($vPro_cap * 0.9) + $vPro_act);	
						else $vPro_fin = $vPro_cap;
					}
				?>
				<td bgcolor="#B3FFB3" <?=ftdstylenota($vNum_rows, $vCont, $vPro_fin)?>>
				<?	if($vCan_cap > 0 || $vCan_act > 0)	{	echo $vPro_fin;	}	?>	            </td>
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
		<?
				}
			}
		}
	?>

</form>	
</center>
