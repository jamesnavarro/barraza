<?php
$con = new mysqli('localhost', 'softmed1_idb', 'jnavarro0318', 'softmed1_barraza');
if(!$con){
		echo 'No se puede conectar a la base de datos';
	}
