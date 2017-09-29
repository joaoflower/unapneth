<?
	session_start();
?>
	<table border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td>
        <?
			if($_SESSION['sActaest_act'] == '2' or $_SESSION['sActaest_act'] == '4')
			{
		?>
			<div class="dboton"><a href="" onclick="act_getdocuhabi(); return false;" class="imodify" title="Habilitar Acta" >Habilitar</a></div>
		<?
            }
        ?>
        	<div class="dboton"><a href="" onclick="clickenableacta(); return false;" class="inew" title="Nueva Acta" >Nueva Acta</a></div>
		</td>
	  </tr>
	</table>