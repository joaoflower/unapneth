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
    <a href="" onclick="clicksilabo();  return false;" class="imatriculas" title="Silabo de Docente" >Silabo</a> 
    <a href="" onclick="clickhorario();  return false;" class="ihorario" title="Horario de Docente" >Horarios</a>
	<a href="../close.php" class="iexit" title="Salir del Sistema" >Salir</a> </div>
