//--------------------------------------------------
function clickpasswd()
{
	var vlink = "psw_getpasswd.php";
	var vlayer = "dsubcontent";
	openpageget(vlink, vlayer, true, "");
}
function clickenableacta()
{
	var vlink = "act_getdoce.php";
	var vparam = "rTip_ena=acta";
	var vlayer = "dsubcontent";
	openpagepost(vlink, vparam, vlayer, true, "");
}
function clickenableacdoce()
{
	var vlink = "act_getdoce.php";
	var vparam = "rTip_ena=doce";
	var vlayer = "dsubcontent";
	openpagepost(vlink, vparam, vlayer, true, "");
}
function clickanmistia()
{
	var vlink = "anm_getestu.php";
	var vparam = "rTip_ena=estu";
	var vlayer = "dsubcontent";
	openpagepost(vlink, vparam, vlayer, true, "");
}

function clickviewnota()
{
	var vlink = "not_getestu.php";
	var vparam = "rTip_ena=estu";
	var vlayer = "dsubcontent";
	openpagepost(vlink, vparam, vlayer, true, "");
}


//---------------------------------------------------------
//	
//---------------------------------------------------------
function psw_savepasswd(pform)
{
	var vOldpasswd = pform.rOldpasswd.value;
	var vNewpasswd = pform.rNewpasswd.value;
	var vReppasswd = pform.rReppasswd.value;	
	
	if(pform.rOldpasswd.value.length < 4 || pform.rNewpasswd.value.length < 4 || pform.rReppasswd.value.length < 4)
	{
		alert("La Contraseña debe de tener al menos 4 caracters ... !");
		pform.rOldpasswd.focus();
	}
	else
	{
		var vlink = "psw_savepasswd.php";
		var vparam = "rOldpasswd=" + vOldpasswd + "&rNewpasswd=" + vNewpasswd + "&rReppasswd=" + vReppasswd;
		var vlayer = "dsubcontent";

		openpagepost(vlink, vparam, vlayer, true, "");
	}
}
//---------------------------------------------------------
//	
//---------------------------------------------------------
function act_searchdoc(pform)
{
	var vCod_prf = pform.rCod_prf.value;
	var vPaterno = pform.rPaterno.value;
	var vMaterno = pform.rMaterno.value;
	var vNombres = pform.rNombres.value;
	
	var vlink = "act_viewdoce.php";
	var vparam = "rCod_prf=" + vCod_prf + "&rPaterno=" + vPaterno + "&rMaterno=" + vMaterno + "&rNombres=" + vNombres;
	var vlayer = "dresultado";
	
	clearlayer("dcursos");
	
	openpagepost(vlink, vparam, vlayer, false, "");
}
function act_viewcurso(pcod_prf)
{
	var vlink = "act_viewcurso.php";
	var vparam = "rCod_prf=" + pcod_prf;
	var vlayer = "dcursos";

	openpagepost(vlink, vparam, vlayer, true, "");
}
function act_viewcursodata(pcod_car, ppln_est, pcod_cur, psec_gru, pmod_mat)
{
	var vlink = "act_viewcursodata.php";
	var vparam = "rCod_car=" + pcod_car + "&rPln_est=" + ppln_est + "&rCod_cur=" + pcod_cur + "&rSec_gru=" + psec_gru + "&rMod_mat=" + pmod_mat;
	var vlayer = "dsubcontent";

	openpagepost(vlink, vparam, vlayer, true, "");
}
function act_getdocuhabi()
{
	var vlink = "act_getdocuhabi.php";
	var vlayer = "dhabilita";
	openpageget(vlink, vlayer, true, "");
}
function act_cancelhabi()
{
	var vlink = "act_botonhabi.php";
	var vlayer = "dhabilita";
	openpageget(vlink, vlayer, true, "");
}

function act_savedocuhabi(pform)
{
	var vDoc_hab = pform.rDoc_hab.value;
	
	var vlink = "act_savedocuhabi.php";
	var vparam = "rDoc_hab=" + vDoc_hab;
	var vlayer = "dhabilita";
	
	openpagepost(vlink, vparam, vlayer, false, "");
}

//---------------------------------------------------------
//	
//---------------------------------------------------------
function doc_getdocuhabi(pcod_prf)
{
	var vlink = "doc_getdocuhabi.php";
	var vparam = "rCod_prf=" + pcod_prf;
	var vlayer = "dcursos";

	openpagepost(vlink, vparam, vlayer, true, "");
}
function cancel()
{
	var vlink = "empty.php";
	var vlayer = "dcursos";
	openpageget(vlink, vlayer, true, "");
}
function doc_savedocuhabi(pform)
{
	var vDoc_hab = pform.rDoc_hab.value;
	
	var vlink = "doc_savedocuhabi.php";
	var vparam = "rDoc_hab=" + vDoc_hab;
	var vlayer = "dcursos";
	
	openpagepost(vlink, vparam, vlayer, false, "");
}

//------------------------------------------------------------------------------------------
function not_searchestu(pform)
{
	var vNum_mat = pform.rNum_mat.value;
	
	var vlink = "not_viewestu.php";
	var vparam = "rNum_mat=" + vNum_mat;
	var vlayer = "dresultado";
	
	clearlayer("dnotas");
	
	openpagepost(vlink, vparam, vlayer, false, "");
}

function not_viewnota(pnum_mat)
{
	var vlink = "not_viewnota.php";
	var vparam = "rNum_mat=" + pnum_mat;
	var vlayer = "dnotas";

	openpagepost(vlink, vparam, vlayer, true, "");
}
//------------------------------------------------------------------------------------------

function anm_searchestu(pform)
{
	var vNum_mat = pform.rNum_mat.value;
	
	var vlink = "anm_viewestu.php";
	var vparam = "rNum_mat=" + vNum_mat;
	var vlayer = "dresultado";
	
	clearlayer("danmistia");
	
	openpagepost(vlink, vparam, vlayer, false, "");
}
function anm_viewinfo(pnum_mat, pcod_car)
{
	var vlink = "anm_viewinfo.php";
	var vparam = "rNum_mat=" + pnum_mat + "&rCod_car=" + pcod_car;
	var vlayer = "danmistia";

	openpagepost(vlink, vparam, vlayer, true, "");
}
function anm_saveanmistia()
{
	var vlink = "anm_saveanmistia.php";
	var vlayer = "danmistia";
	openpageget(vlink, vlayer, true, "");
}
function cancelanmistia()
{
	var vlink = "empty.php";
	var vlayer = "danmistia";
	openpageget(vlink, vlayer, true, "");
}