<?php

session_start();

if(isset($_REQUEST['sair'])){	
	session_destroy();
	unset($_SESSION['usuario_epura']);
	unset($_SESSION['senha_epura']);	
	unset($_SESSION['nivelAcesso']);
	unset($_SESSION['nome']);
	header("Location: index.php");	
}
?>