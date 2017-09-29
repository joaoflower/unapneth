<STYLE type=text/css>
@import url( ../css/main.css );
@import url( ../css/frame.css );
@import url( ../css/framelogin.css );
@import url( ../css/style.css );
</STYLE>

<?
	if(fsafetylogin())
	{
?>
		<table border="0" cellpadding="0" cellspacing="1" bordercolor="#FF0000" class="tviewdata">
		  <tr>
            <td>Menci&oacute;n :</td>
		    <th><select name="rCod_esp" id="rCod_esp" onchange="hro_viewespcurso(this.value); return false;">
                <?=fviewhoespecial($_SESSION['sUsercod_car'], $_SESSION["sHorapln_est"], $_SESSION["sHoracod_esp"])?>
                        </select></th>
	      </tr>
		  <tr>
			<td width="100">Semestre :</td>
			<th width="350"><select name="rSem_anu" id="rSem_anu" onchange="hro_viewsemcurso(this.value); return false;">
			  <?=fviewhosemestre($_SESSION['sUsercod_car'], $_SESSION["sHorapln_est"], $_SESSION["sHorasem_anu"])?>
			</select></th>
		  </tr>
		  <tr >
			<td >Curso : </td>
			<th id="dcurso"><select name="rCod_cur" id="rCod_cur" onchange="hro_viewhoracurso(this.value); return false;">
			  <?=fviewhocurso($_SESSION['sUsercod_car'], $_SESSION["sHorapln_est"], $_SESSION["sHoracod_esp"], $_SESSION["sHorasem_anu"], $_SESSION["sHoracod_cur"])?>
			</select></th>
		  </tr>
		  <tr>
            <td>Grupo : </td>
		    <th><select name="rSec_gru" id="rSec_gru" onchange="hro_viewhoragrupo(this.value); return false;">
                <?=fviewhogrupo($_SESSION["sHorasec_gru"])?>
            </select></th>
	      </tr>
		  <tr>
			<td>Turno : </td>
			<th><select name="rTur_est" id="rTur_est" onchange="hro_viewhoraturno(this.value); return false;">
			  <?=fviewhoturno($_SESSION["sHoratur_est"])?>
			</select></th>
		  </tr>
		</table>
<?	
	}
?>