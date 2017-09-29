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
		
		$tHabiacta = "habiacta".$_SESSION['sFrameano_aca'];
		$tIngnota = "ingnota".$_SESSION['sFrameano_aca'];
		$tNotaca = "notaca".$_SESSION['sActacod_car'].$_SESSION['sFrameano_aca'];
		$tNotabk = "notabk".$_SESSION['sActacod_car'].$_SESSION['sFrameano_aca'];			
		$tNota = "nota".$_SESSION['sActacod_car'];
		$tCurmat = "curmat".$_SESSION["sActacod_car"].$_SESSION['sFrameano_aca'];
		
		if(!empty($_POST['rDoc_hab']))
		{
			$vQuery = "insert into $tHabiacta (pln_est, cod_cur, sec_gru, mod_mat, cod_car, ano_aca, per_aca, can_cap, can_act, ";
			$vQuery .= "cod_prf, fch_ing, est_act, doc_hab ) values ";
			$vQuery .= "('{$_SESSION['sActapln_est']}', '{$_SESSION['sActacod_cur']}', '{$_SESSION['sActasec_gru']}', ";
			$vQuery .= "'{$_SESSION['sActamod_mat']}', '{$_SESSION['sActacod_car']}', '{$_SESSION['sFrameano_aca']}', ";
			$vQuery .= "'{$_SESSION['sFrameper_aca']}', '{$_SESSION['sActacan_cap']}', '{$_SESSION['sActacan_act']}', ";
			$vQuery .= "'{$_SESSION['sActacod_prf']}', now(), '{$_SESSION['sActaest_act']}', '{$_POST['rDoc_hab']}') ";
				
			$cResult = fInupde($vQuery);
			if($cResult)
			{
				$vQuery = "insert into $tNotabk (num_mat, pln_est, cod_cur, per_aca, ano_aca, mod_not, cod_car, ";
				$vQuery .= "tip_not, ord_not, not_cur) ";
				$vQuery .= "Select no.* from $tNotaca no ";
				$vQuery .= "left join modnot mn on no.mod_not = mn.mod_not ";
				$vQuery .= "where no.ano_aca = '{$_SESSION['sFrameano_aca']}' and no.per_aca = '{$_SESSION['sFrameper_aca']}' and ";
				$vQuery .= "no.cod_car = '{$_SESSION['sActacod_car']}' and no.pln_est = '{$_SESSION['sActapln_est']}' and ";
				$vQuery .= "no.cod_cur = '{$_SESSION['sActacod_cur']}' and ";
				$vQuery .= "mn.mod_act = '{$_SESSION['sActamod_mat']}' and num_mat in ";
				$vQuery .= "(Select num_mat from $tCurmat where per_aca = '{$_SESSION['sFrameper_aca']}' and ";
				$vQuery .= "pln_est = '{$_SESSION['sActapln_est']}' and cod_cur = '{$_SESSION['sActacod_cur']}' and ";
				$vQuery .= "sec_gru = '{$_SESSION['sActasec_gru']}') ";
				
				$cResult = fInupde($vQuery);
				if($cResult)
				{
					$bDatos = TRUE;
					$_SESSION['sActaest_act'] = "3";
					
					$vQuery = "Select distinct no.num_mat, no.mod_not from $tNotaca no ";
					$vQuery .= "left join modnot mn on no.mod_not = mn.mod_not ";
					$vQuery .= "where no.ano_aca = '{$_SESSION['sFrameano_aca']}' and no.per_aca = '{$_SESSION['sFrameper_aca']}' and ";
					$vQuery .= "no.cod_car = '{$_SESSION['sActacod_car']}' and no.pln_est = '{$_SESSION['sActapln_est']}' and ";
					$vQuery .= "no.cod_cur = '{$_SESSION['sActacod_cur']}' and no.tip_not = 'C' and ";
					$vQuery .= "mn.mod_act = '{$_SESSION['sActamod_mat']}' and num_mat in ";
					$vQuery .= "(Select num_mat from $tCurmat where per_aca = '{$_SESSION['sFrameper_aca']}' and ";
					$vQuery .= "pln_est = '{$_SESSION['sActapln_est']}' and cod_cur = '{$_SESSION['sActacod_cur']}' and ";
					$vQuery .= "sec_gru = '{$_SESSION['sActasec_gru']}') ";
					
					$cResultn = fQuery($vQuery);
					while($aResultn = mysql_fetch_array($cResultn))
					{
						$vQuery2 = "delete from $tNota where num_mat = '{$aResultn['num_mat']}' and cod_car = '{$_SESSION['sActacod_car']}' and ";
						$vQuery2 .= "pln_est = '{$_SESSION['sActapln_est']}' and cod_cur = '{$_SESSION['sActacod_cur']}' and ";
						$vQuery2 .= "mod_not = '{$aResultn['mod_not']}' and ano_aca = '{$_SESSION['sFrameano_aca']}' and ";
						$vQuery2 .= "per_aca = '{$_SESSION['sFrameper_aca']}' and mod_ing = '02' ";
						
						$cResdel = fInupde($vQuery2);
						if(!$cResdel)
							$bDatos = FALSE;
					}
				}
			}
		}		
	}
	else
	{
		header("Location:../index.php");
	}
	
	if($bDatos == TRUE)
	{
		$vQuery = "update $tIngnota set ingresado = 'F' ";
		$vQuery .= "where pln_est = '{$_SESSION['sActapln_est']}' and cod_cur = '{$_SESSION['sActacod_cur']}' and ";
		$vQuery .= "sec_gru = '{$_SESSION['sActasec_gru']}' and mod_mat = '{$_SESSION['sActamod_mat']}' and ";
		$vQuery .= "cod_car = '{$_SESSION['sActacod_car']}' and ano_aca = '{$_SESSION['sFrameano_aca']}' and ";
		$vQuery .= "per_aca = '{$_SESSION['sFrameper_aca']}' ";
		
		$cResult = fInupde($vQuery);		
?>
<center>
	<span class="wordi">LOS DATOS FUERON GRABADOS CORRECTAMENTE  ...! </span>
</center>
    
<?
	}
	else
	{
?>
<center>
	<span class="wordi">LOS DATOS NO FUERON GRABADOS CORRECTAMENTE  ...! </span>
</center>
<?
	}
	include "act_botonhabi.php";	
?>
