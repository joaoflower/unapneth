<?
	if(fsafetylogin())
	{
	}
	else
	{
		$_SESSION['sIni'] = "";
		header("Location:../index.php");
	}
?>
<STYLE type=text/css>
@import url( ../css/main.css );
@import url( ../css/frame.css );
</STYLE>
<div id="dmenu"> 
	<a href="" onclick="clickpasswd();  return false;" class="ipasswd" title="cambiar contraseña" >Contrase&ntilde;a</a> 
	<a href="" onclick="clickenableacta(); return false;" class="ihorario" title="Habilitar Acta de un Docente" >Hab. Acta</a> 
    <a href="" onclick="clickenableacdoce(); return false;" class="imydata" title="Habilitar Docente para ingreso de Notas" >Hab. Docente</a> 
    <a href="" onclick="clickanmistia(); return false;" class="imydata" title="Anmistia" >Anmistia</a> 
    <a href="" onclick="clickviewnota();  return false;" class="iplan" title="Horario de Docente" >Nota Estu</a> 
	<a href="../close.php" class="iexit" title="Salir del Sistema" >Salir</a> </div>
