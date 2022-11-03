<?php
   
    $serverName = "NAME_SERVER\MSSQLSERVER , 1433"; //serverName\instanceName
    $connectionInfo = array( "Database"=>"DATABASE_NAME", "UID"=>"user", "PWD"=>"password");

    $conn = sqlsrv_connect( $serverName, $connectionInfo);
    
    

    if( !$conn ) {
         echo "ERROR (revise su configuración o credenciales de acceso)."; 
    die( print_r(sqlsrv_errors(), true)); 
    }
    

?>

