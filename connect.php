<?php

//$connect = pg_connect("hostaddr=127.0.0.1 port=5432 dbname=OnlineChat user=postgres password=admin");

$serverName = "DESKTOP-NFN7KES\SQLEXPRESS";
$connectionInfo = array("Database"=>"Tortugas_Izrancev_Leksikov_4ISP97");
$conn = sqlsrv_connect( $serverName, $connectionInfo);