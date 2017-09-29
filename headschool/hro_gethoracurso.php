<STYLE type=text/css>
@import url( ../css/main.css );
@import url( ../css/frame.css );
@import url( ../css/framelogin.css );
@import url( ../css/style.css );
</STYLE>

<?
	if(fsafetylogin())
	{
		$tHora = "hora".$_SESSION['sUsercod_car'].$_SESSION['sFrameano_aca'];
		$sHora = "";
?>
		<table border="0" cellpadding="0" cellspacing="0" class="tventana">
          <tr>
            <td><img src="../images/ven_topleft.jpg" width="16" height="25" border="0" alt="" /></td>
            <th background="../images/ven_topcenter.jpg">Horario</th>
            <td><img src="../images/ven_topright.jpg" width="16" height="25" border="0" alt="" /></td>
          </tr>
          <tr>
            <td background="../images/ven_mediumleft.jpg"></td>
            <td align="center"><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
              <tr>
                <th width="50" >Hora</th>
                <th width="40" >Lunes</th>
                <th width="40" >Mart.</th>
                <th width="40" >Mierc.</th>
                <th width="40" >Juev.</th>
                <th width="40" >Vien.</th>
                <th width="40" >Sab</th>
                <th width="40" >Dom</th>
              </tr>
              <? 	$vCont = 1;	 
	  		
				$vQuery = "Select cod_dia, cod_hor from $tHora where pln_est = '{$_SESSION['sHorapln_est']}' and ";
				$vQuery .= "cod_cur = '{$_SESSION['sHoracod_cur']}' and sec_gru = '{$_SESSION['sHorasec_gru']}' and ";
				$vQuery .= "per_aca = '{$_SESSION['sFrameper_aca']}'";
				$cResult = fQuery($vQuery);
				while($aResult = mysql_fetch_array($cResult))
				{
					$sHora[$aResult['cod_dia'].$aResult['cod_hor']] = TRUE;
				}
				
				
				
				$vQuery = "Select cod_hor, hrs_ini, hrs_fin from codhora where cod_hor <> '' and tur_est = '{$_SESSION['sHoratur_est']}' order by hrs_ini ";
				$cResult = fQuery($vQuery);
				while($aResult = mysql_fetch_array($cResult)) 
				{
	  ?>
              <tr <?=ftrstyle($vCont)?>  onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
                <td class="wordcen"><?=$aResult['hrs_ini']?> - <?=$aResult['hrs_fin']?></td>
                <td <?=ftdstyle($vNum_rows, $vCont)?> class="wordcen"><input name="rDia_hor[]" type="checkbox" class="check" id="rDia_hor[]" value="1<?=$aResult['cod_hor']?>" <? if($sHora["1{$aResult['cod_hor']}"]) echo "checked" ?> /></td>
                <td <?=ftdstyle($vNum_rows, $vCont)?> class="wordcen"><input name="rDia_hor[]" type="checkbox" class="check" id="rDia_hor[]" value="2<?=$aResult['cod_hor']?>" <? if($sHora["2{$aResult['cod_hor']}"]) echo "checked" ?> /></td>
                <td <?=ftdstyle($vNum_rows, $vCont)?> class="wordcen"><input name="rDia_hor[]" type="checkbox" class="check" id="rDia_hor[]" value="3<?=$aResult['cod_hor']?>" <? if($sHora["3{$aResult['cod_hor']}"]) echo "checked" ?> /></td>
                <td <?=ftdstyle($vNum_rows, $vCont)?> class="wordcen"><input name="rDia_hor[]" type="checkbox" class="check" id="rDia_hor[]" value="4<?=$aResult['cod_hor']?>" <? if($sHora["4{$aResult['cod_hor']}"]) echo "checked" ?> /></td>
                <td <?=ftdstyle($vNum_rows, $vCont)?> class="wordcen"><input name="rDia_hor[]" type="checkbox" class="check" id="rDia_hor[]" value="5<?=$aResult['cod_hor']?>" <? if($sHora["5{$aResult['cod_hor']}"]) echo "checked" ?> /></td>
                <td <?=ftdstyle($vNum_rows, $vCont)?> class="wordcen"><input name="rDia_hor[]" type="checkbox" class="check" id="rDia_hor[]" value="6<?=$aResult['cod_hor']?>" <? if($sHora["6{$aResult['cod_hor']}"]) echo "checked" ?> /></td>
                <td <?=ftdstyle($vNum_rows, $vCont)?> class="wordcen"><input name="rDia_hor[>]" type="checkbox" class="check" id="rDia_hor[]" value="7<?=$aResult['cod_hor']?>" <? if($sHora["7{$aResult['cod_hor']}"]) echo "checked" ?> /></td>
              </tr>
              <?	
			  		$vCont++;
				} 		
			 ?>
            </table></td>
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
            <td id="dsavecurso"><div class="dboton"><a href="" onclick="hro_savehoracurso(document.fData); return false;" class="isave" title="Guardar Horario" >Guardar</a></div>
                <div class="dboton"><a href="" onclick="hro_cancelhoracurso(); return false;" class="icancel" title="Nueva Acta" >Cancelar</a></div></td>
          </tr>
        </table>
		<?	
	}
?>