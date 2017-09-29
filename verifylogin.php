<?php
	session_start();
	include "include/funcget.php";
	include "include/funcsql.php";	

	$_SESSION['sUserlogin'] = $_POST['rLogin'];
	
	if(!(empty($_SESSION['sUserlogin']) or empty($_POST['rPasswd'])))
	{
		$bUser = FALSE;
		$bPasswd = FALSE;

		$vQuery = "Select us.login, us.passwd, us.cod_usu, us.paterno, us.materno, us.nombres, ";
		$vQuery .= "us.niv_usu, nu.niv_des, aa.cod_car ";
		$vQuery .= "from usuadmin us left join nivusu nu on us.niv_usu = nu.niv_usu ";	
		$vQuery .= " left join accesoadmin aa on us.cod_usu = aa.cod_usu ";	
		$vQuery .= "where us.login = '{$_SESSION['sUserlogin']}' ";
		$cUser = fQuery($vQuery);
		if($aUser = mysql_fetch_array($cUser))
		{
			$bUser = TRUE;
			if($aUser['passwd'] === fgetpassword($_POST['rPasswd']))
				$bPasswd = TRUE;
			
			if($bPasswd)
			{					
				$_SESSION['sUsercod_usu'] = $aUser['cod_usu'];
				$_SESSION['sUsertip_usu'] = $aUser['niv_usu'];				
				$_SESSION['sUserpaterno'] = $aUser['paterno'];
				$_SESSION['sUsermaterno'] = $aUser['materno'];
				$_SESSION['sUsernombres'] = $aUser['nombres'];
				$_SESSION['sUserniv_des'] = $aUser['niv_des'];
				$_SESSION['sUsercod_car'] = $aUser['cod_car'];
				$_SESSION['sUserip'] = $_SERVER['REMOTE_ADDR'];
			}
		}
		if($bPasswd)
		{
		
			// ---------
			$_SESSION['sFrameano_aca'] = '2009';
			$_SESSION['sFrameper_aca'] = '01';
			
			if($_SESSION['sUsertip_usu'] === '07') // Director de Estudios
			{
				$_SESSION['sFrameano_aca'] = '2009';
				$_SESSION['sFrameper_aca'] = '01';
			
				$_SESSION['sSafetylogin'] = '*E64C43A32CDCA595E9F49426B88646EEAA618E0D';
				header("Location:headschool/");
			}
			elseif($_SESSION['sUsertip_usu'] === '08') // Jefe de Departamento
			{
				$_SESSION['sFrameano_aca'] = '2009';
				$_SESSION['sFrameper_aca'] = '01';
				$_SESSION['sSafetylogin'] = '*4D3135D9A09A85FE3E45C245957210F8818F880A';
				header("Location:bossdepartament/");
			}	
			elseif($_SESSION['sUsertip_usu'] === '09') // Habilitador de Actas
			{
				$_SESSION['sFrameano_aca'] = '2008';
				$_SESSION['sFrameper_aca'] = '02';
				$_SESSION['sSafetylogin'] = '*180AC15CF9EEFC85480E3BB6C2654A6DE579402A';
				header("Location:enabledrecord/");
			}			
			else
			{
				$_SESSION["sLoginError"] = TRUE;
				$_SESSION["sLoginMessage"] = 'ERROR, El Usuario o la Contraseña es Incorrecta !!!';
				header("Location:index.php");
			}		
		}
		else
		{
			$_SESSION["sLoginError"] = TRUE;
			$_SESSION["sLoginMessage"] = 'ERROR, El Usuario o la Contraseña es Incorrecta !!!';
			header("Location:index.php");				
		}		
	}
	else
	{
		$_SESSION['sIni'] = "";
		header("Location:index.php");		
	}
?>