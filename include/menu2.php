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
    <a href="" onclick="clickcarga();  return false;" class="imatriculas" title="Carga Acad&eacute;mica" >Carga Acad&eacute;mica</a> 
	<a href="../close.php" class="iexit" title="Salir del Sistema" >Salir</a> </div>
