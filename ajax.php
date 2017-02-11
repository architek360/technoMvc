<?php 

if ($_POST) {

	require('core/core.php');

	switch (isset($_GET['mode']) ? $_GET['mode'] : null) {
		case 'login':
			require('core/bin/ajax/goLogin.php');
			break;		
		case 'reg':
			require('core/bin/ajax/goReg.php');
			break;	
		case 'lostpass':
			require('core/bin/ajax/goLostpass.php');
			break;	
		case 'addpro':
			require('core/bin/ajax/goAddpro.php');
			break;	
		case 'edipro':
			require('core/bin/ajax/goEdipro.php');
			break;	
		case 'ediperfil':
			require('core/bin/ajax/ediPerfil.php');
			break;
		case 'editpass':
			require('core/bin/ajax/editPass.php');
			break;	
		default:
			header('location: home/');
			break;
	}
} else {
	header('location: contacto/');
}

?>