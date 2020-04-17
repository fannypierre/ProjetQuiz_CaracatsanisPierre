<?php
	session_start();
	require_once "includes/fonctions.php";
	unset($_SESSION['erreur']);
	unset($_SESSION['email']);
	header('Location: index.php');
?>