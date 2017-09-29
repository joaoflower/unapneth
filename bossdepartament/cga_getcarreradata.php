<STYLE type=text/css>
@import url( ../css/main.css );
@import url( ../css/frame.css );
@import url( ../css/framelogin.css );
@import url( ../css/style.css );
</STYLE>

<?
	if(fsafetylogin())
	{
		$vQuery = "select pln_est from plan where cod_car = '{$_SESSION['sHoracod_car']}' and con_pln = '1' ";
		$cResult = fQuery($vQuery);
		if($aResult = mysql_fetch_array($cResult))
		{
			$_SESSION["sHorapln_est"] = $aResult['pln_est'];
			
			$vQuery = "select cod_esp from especial where cod_car = '{$_SESSION['sHoracod_car']}' and pln_est = '{$_SESSION['sHorapln_est']}' ";
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
		$_SESSION["sHoramod_mat"] = "01";
		$_SESSION["sHorahrs_teo"] = 0;
		$_SESSION["sHorahrs_pra"] = 0;
		$_SESSION["sHoracrd_cur"] = 0.00;
			
?>
		<table border="0" cellpadding="0" cellspacing="1" bordercolor="#FF0000" class="tviewdata">
		  <tr>
            <td width="100">Plan de Est. </td>
		    <th width="350"><select name="rPln_est" id="rPln_est" onchange="cga_viewplandata(this.value); return false;">
                <?=fviewhoplan($_SESSION['sHoracod_car'], $_SESSION["sHorapln_est"])?>
            </select></th>
	      </tr>
		</table>
		<div id="despsemcur"> 
			<? include "cga_getplandata.php"; ?>
		</div>
		
		
<?	
	}
?>