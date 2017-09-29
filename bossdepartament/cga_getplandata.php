<STYLE type=text/css>
@import url( ../css/main.css );
@import url( ../css/frame.css );
@import url( ../css/framelogin.css );
@import url( ../css/style.css );
</STYLE>

<?
	if(fsafetylogin())
	{
		$vQuery = "select cod_esp from especial where cod_car = '{$_SESSION['sHoracod_car']}' and pln_est = '{$_SESSION['sHorapln_est']}' ";
		$cResult = fQuery($vQuery);
		if($aResult = mysql_fetch_array($cResult))
		{
			$_SESSION["sHoracod_esp"] = $aResult['cod_esp'];
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
            <td width="100">Menci&oacute;n :</td>
		    <th width="350" colspan="3"><select name="rCod_esp" id="rCod_esp" onchange="cga_viewespcurso(this.value); return false;">
                <?=fviewhoespecial($_SESSION['sHoracod_car'], $_SESSION["sHorapln_est"], $_SESSION["sHoracod_esp"])?>
                        </select></th>
	      </tr>
		  <tr>
			<td>Semestre :</td>
			<th colspan="3"><select name="rSem_anu" id="rSem_anu" onchange="cga_viewsemcurso(this.value); return false;">
			  <?=fviewhosemestre($_SESSION['sHoracod_car'], $_SESSION["sHorapln_est"], $_SESSION["sHorasem_anu"])?>
			</select></th>
		  </tr>
		  <tr >
			<td >Curso : </td>
			<th colspan="3" id="dcurso"><select name="rCod_cur" id="rCod_cur" onchange="cga_viewhoracurso(this.value); return false;">
			  <?=fviewhocurso($_SESSION['sHoracod_car'], $_SESSION["sHorapln_est"], $_SESSION["sHoracod_esp"], $_SESSION["sHorasem_anu"], $_SESSION["sHoracod_cur"])?>
			</select></th>
		  </tr>
		  <tr>
            <td>Grupo : </td>
		    <th width="120"><select name="rSec_gru" id="rSec_gru" onchange="cga_viewhoragrupo(this.value); return false;">
                <?=fviewhogrupo($_SESSION["sHorasec_gru"])?>
            </select></th>
	        <td width="100">Modalidad : </td>
	        <th><select name="rMod_mat" id="rMod_mat" onchange="cga_viewhoramod(this.value); return false;">
              <?=fviewhomodmat($_SESSION["sHoramod_mat"])?>
            </select></th>
		  </tr>
		 </table>
		 <div id="dhrscrd"> 
		 <table border="0" cellpadding="0" cellspacing="1" bordercolor="#FF0000" class="tviewdata">
		  <tr>
		    <td width="100">Horas : </td>
		    <th width="120">HT=<?=$_SESSION["sHorahrs_teo"]?>, HP=<?=$_SESSION["sHorahrs_pra"]?>, TH=<?=$_SESSION["sHorahrs_teo"]+$_SESSION["sHorahrs_pra"]?></th>
		    <td width="100">Cr&eacute;ditos : </td>
		    <th width="120"><?=$_SESSION["sHoracrd_cur"]?></th>
	      </tr>
		</table>
		<div id="dsave"> </div>
		</div>
		
<?	
	}
?>