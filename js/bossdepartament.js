//--------------------------------------------------
function clickpasswd()
{
	var vlink = "psw_getpasswd.php";
	var vlayer = "dsubcontent";
	openpageget(vlink, vlayer, true, "");
}
function clickcarga()
{
	var vlink = "cga_viewcargadoce.php";
	var vlayer = "dsubcontent";
	openpageget(vlink, vlayer, true, "");
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
function cga_viewcargacurso(pcod_prf)
{
	var vlink = "cga_viewcargacurso.php";
	var vparam = "rCod_prf=" + pcod_prf;
	var vlayer = "dsubcontent";

	openpagepost(vlink, vparam, vlayer, true, "");
}
function cga_delcargacursopre(pcod_prf, pcod_car, ppln_est, pcod_cur, psec_gru, pmod_mat)
{
	var vlink = "cga_delcargacursopre.php";
	var vparam = "rCod_prf=" + pcod_prf + "&rCod_car=" + pcod_car + "&rPln_est=" + ppln_est + "&rCod_cur=" + pcod_cur + "&rSec_gru=" + psec_gru + "&rMod_mat=" + pmod_mat;
	var vlayer = "dsubcontent";

	openpagepost(vlink, vparam, vlayer, true, "");
}
function cga_delcargacurso(pcod_prf, pcod_car, ppln_est, pcod_cur, psec_gru, pmod_mat)
{
	var vlink = "cga_delcargacurso.php";
	var vparam = "rCod_prf=" + pcod_prf + "&rCod_car=" + pcod_car + "&rPln_est=" + ppln_est + "&rCod_cur=" + pcod_cur + "&rSec_gru=" + psec_gru + "&rMod_mat=" + pmod_mat;
	var vlayer = "dsubcontent";

	openpagepost(vlink, vparam, vlayer, true, "");
}
function cga_newcarga()
{
	var vlink = "cga_getdoce.php";
	var vlayer = "dsubcontent";
	openpageget(vlink, vlayer, true, "");
}
function cga_searchdoc(pform)
{
	var vPaterno = pform.rPaterno.value;
	var vMaterno = pform.rMaterno.value;
	var vNombres = pform.rNombres.value;
	
	var vlink = "cga_viewdoce.php";
	var vparam = "rPaterno=" + vPaterno + "&rMaterno=" + vMaterno + "&rNombres=" + vNombres;
	var vlayer = "dresultado";
	
	clearlayer("dcarga");
	
	openpagepost(vlink, vparam, vlayer, false, "");
}
function cga_getcarrera(pcod_prf)
{
	var vlink = "cga_getcarrera.php";
	var vparam = "rIns_upd=i&rCod_prf=" + pcod_prf;
	var vlayer = "dcarga";

	openpagepost(vlink, vparam, vlayer, false, "");
}

function cga_viewcarreradata(pcod_car)
{
	var vlink = "cga_viewcarreradata.php";
	var vparam = "rCod_car=" + pcod_car;
	var vlayer = "dplan";

	openpagepost(vlink, vparam, vlayer, false, "");
}
function cga_viewplandata(ppln_est)
{
	var vlink = "cga_viewplandata.php";
	var vparam = "rPln_est=" + ppln_est;
	var vlayer = "despsemcur";

	openpagepost(vlink, vparam, vlayer, false, "");
}
function cga_viewespcurso(pcod_esp)
{
	var vlink = "cga_viewespcurso.php";
	var vparam = "rCod_esp=" + pcod_esp;
	var vlayer = "dcurso";
	
	clearlayer("dsave");
	openpagepost(vlink, vparam, vlayer, false, "");
}
function cga_viewsemcurso(psem_anu)
{
	var vlink = "cga_viewsemcurso.php";
	var vparam = "rSem_anu=" + psem_anu;
	var vlayer = "dcurso";

	clearlayer("dsave");
	openpagepost(vlink, vparam, vlayer, false, "");
}
function cga_viewhoracurso(pcod_cur)
{
	var vlink = "cga_viewhoracurso.php";
	var vparam = "rCod_cur=" + pcod_cur;
	var vlayer = "dhrscrd";

	openpagepost(vlink, vparam, vlayer, false, "");
}
function cga_viewhoragrupo(psec_gru)
{
	var vlink = "cga_viewhoragrupo.php";
	var vparam = "rSec_gru=" + psec_gru;
	var vlayer = "dsave";

	openpagepost(vlink, vparam, vlayer, false, "");
}
function cga_viewhoramod(pmod_mat)
{
	var vlink = "cga_viewhoramod.php";
	var vparam = "rMod_mat=" + pmod_mat;
	var vlayer = "dsave";

	openpagepost(vlink, vparam, vlayer, false, "");
}
function cga_savecarga(pform)
{
	var vlink = "cga_savecarga.php";
	var vparam = "rDatas=1234";
	var vlayer = "dsave";

	openpagepost(vlink, vparam, vlayer, false, "");
}
//---------------------------------------------------------
//	
//---------------------------------------------------------