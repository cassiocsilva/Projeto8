<?php
$DATABASE_HOST = 'fdb25.awardspace.net';
$DATABASE_USER = '3453558_projeto8';
$DATABASE_PASS = 'ZlTNmTKN1TQL5cWnv6)y';
$DATABASE_NAME = '3453558_projeto8';

$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if ( mysqli_connect_errno() ) {
	echo "<script>alert('Não foi possível conectar ao Banco de Dados.');
		window.location.href='index.html';</script>";
} 
?>