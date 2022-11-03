<?php
   
    include 'connect.php';


    
    $pedido=$_POST["pedido"];
    $sql = "select P.CODIGO, P.DESCRIPCIO, P.DIVISION, M.CAPACIDAD, M.NENVASES, O.[CONTROL], C.NOMBRE as CLIENTE, V._DTOR_COM, V.NOMBRE_DC, V.NOMBRE AS NOMBRE_VENDEDOR  
    from DATMO01 M INNER JOIN DATOP01 O ON O.NUMERO=M.NUMERO INNER JOIN DATEN01 C ON O.NIF = C.NIF INNER JOIN DATIN01 P ON M.CODART=P.CODIGO INNER JOIN DATVD01 V ON V.CODIGO=O.[CONTROL]
    WHERE O.NUMERO_DOC='$pedido'";
    // $params = array();
    // $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $stmt = sqlsrv_query( $conn, $sql);
    
        echo "<link rel=stylesheet href=css/style.css>";
        if ( $stmt == false)
        echo "Error al obtener datos.";


        echo "<form action='send.php' method='post'>";
        //echo $row_count;
        
        echo "<input name='pedido' type='hidden' value='$pedido'>";
        echo "<table border=1>";
        echo "<tr>";
        echo "<th>PRODUCTO</th>";
        echo "<th>ENVASE</th>";
        echo "</tr>";  
        while( $row = sqlsrv_fetch_array( $stmt) ) {
              echo '<tr>';
              echo '<td><input type="checkbox" name="PRODUCTO[]" value="'.$row['CODIGO']." - ".$row['DESCRIPCIO']." - ".$row['DIVISION'].'">'.$row['CODIGO'].$row['DESCRIPCIO'].'</td>';
              echo '<td>'.$row['NENVASES'].'x'.round($row['CAPACIDAD']).'</td>';
              echo '</tr>';
              echo '<input type="hidden" name="vendedor" value="'.$row['CONTROL'].'">';
              echo '<input type="hidden" name="cliente" value="'.$row['CLIENTE'].'">';
              echo '<input type="hidden" name="dtorcom" value="'.$row['_DTOR_COM'].'">';
              echo '<input type="hidden" name="nombredc" value="'.$row['NOMBRE_DC'].'">';
              echo '<input type="hidden" name="nombrevendedor" value="'.$row['NOMBRE_VENDEDOR'].'">';
        }
        echo "</table>";
        echo "<input type='submit' value='ENVIAR' name='send'>";
        echo "</form>";


?>