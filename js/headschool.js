//--------------------------------------------------
function clickpasswd()
{
	var vlink = "psw_getpasswd.php";
	var vlayer = "dsubcontent";
	openpageget(vlink, vlayer, true, "");
}
function clicksilabo()
{
	var vlink = "sil_viewdoce.php";
	var vlayer = "dsubcontent";
	openpageget(vlink, vlayer, true, "");
}
function clickhorario()
{
	var vlink = "hro_viewhora.php";
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
function sil_viewcurso(pcod_prf)
{
	var vlink = "sil_viewcurso.php";
	var vparam = "rCod_prf=" + pcod_prf;
	var vlayer = "dsubcontent";

	openpagepost(vlink, vparam, vlayer, true, "");
}
//---------------------------------------------------------
//	
//---------------------------------------------------------
function hro_viewhorasge(pclave)
{
	var vlink = "hro_viewhorasge.php";
	var vparam = "rClave=" + pclave;
	var vlayer = "dhorario";

	openpagepost(vlink, vparam, vlayer, true, "");		
}
function hro_newhora()
{
	var vlink = "hro_getsemcurgru.php";
	var vparam = "rIns_upd=i";
	var vlayer = "dsubcontent";

	openpagepost(vlink, vparam, vlayer, true, "");
}
function hro_viewsemcurgru(ppln_est)
{
	var vlink = "hro_viewsemcurgru.php";
	var vparam = "rPln_est=" + ppln_est;
	var vlayer = "dsemcurgru";

	clearlayer("dcheckhora");
	openpagepost(vlink, vparam, vlayer, false, "");
}
function hro_viewsemcurso(psem_anu)
{
	var vlink = "hro_viewsemcurso.php";
	var vparam = "rSem_anu=" + psem_anu;
	var vlayer = "dcurso";

	clearlayer("dcheckhora");
	openpagepost(vlink, vparam, vlayer, false, "");
}
function hro_viewespcurso(pcod_esp)
{
	var vlink = "hro_viewespcurso.php";
	var vparam = "rCod_esp=" + pcod_esp;
	var vlayer = "dcurso";

	clearlayer("dcheckhora");
	openpagepost(vlink, vparam, vlayer, false, "");
}
function hro_viewhoracurso(pcod_cur)
{
	var vlink = "hro_viewhoracurso.php";
	var vparam = "rCod_cur=" + pcod_cur;
	var vlayer = "dcheckhora";

	openpagepost(vlink, vparam, vlayer, false, "");
}
function hro_viewhoragrupo(psec_gru)
{
	var vlink = "hro_viewhoragrupo.php";
	var vparam = "rSec_gru=" + psec_gru;
	var vlayer = "dcheckhora";

	openpagepost(vlink, vparam, vlayer, false, "");
}
function hro_viewhoraturno(ptur_est)
{
	var vlink = "hro_viewhoraturno.php";
	var vparam = "rTur_est=" + ptur_est;
	var vlayer = "dcheckhora";

	openpagepost(vlink, vparam, vlayer, false, "");
}
function hro_savehoracurso(pform)
{
	var i = 0;
	var vDat_snt = "";

	for (i = 0; i < pform.elements.length; i++) 
	{
		if(pform.elements[i].type == "checkbox") 
		{
			if(pform.elements[i].checked == true)
			{
				vDat_snt = vDat_snt + pform.elements[i].value;
			}
		}
	}
	
	if(vDat_snt != "")
	{
		var vlink = "hro_savehoracurso.php";
		var vparam = "rDat_snt=" + vDat_snt;
		var vlayer = "dsavecurso";

		openpagepost(vlink, vparam, vlayer, true, "");
	}
	else
	{
		alert("No selecciono dato alguno");
	}
}
function hro_cancelhoracurso()
{
	var vlink = "hro_cancelhoracurso.php";
	var vlayer = "dcheckhora";
	openpageget(vlink, vlayer, false, "");
}
function hro_delcurso(pcod_cur)
{
	var vlink = "hro_delcurso.php";
	var vparam = "rCod_cur=" + pcod_cur;
	var vlayer = "dhorario";

	openpagepost(vlink, vparam, vlayer, false, "");
}
//---------------------------------------------------------
//	
//---------------------------------------------------------