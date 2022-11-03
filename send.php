<?php
    include 'connect.php';
    echo "<link rel=stylesheet href=css/style.css>";
    $pedido = $_POST["pedido"];
    $vendedor = trim($_POST["vendedor"]);
    $dtorcom = trim($_POST["dtorcom"])."@mail.com";
    $mail = $vendedor."@mail.com";
    $cliente = trim($_POST["cliente"]);
    $nombre_dc = $_POST["nombredc"];
    $nombre_vendedor = $_POST["nombrevendedor"];
    $delimitador = " - ";
    $tco = '';
    





    if(isset($_POST["send"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        if (trim($vendedor) == '00000') {
            $mail='mail@mail.com,';
        }


        if(!empty($_POST['PRODUCTO'])){

            foreach($_POST['PRODUCTO'] as $divi){
               $array = explode($delimitador, $divi);
                switch (trim($array[2])){
                    case 'PINTURAS':
                        $tco .= ',mail@mail.com';
                        break;
                    case 'DETERGENCIA':
                        $tco .= ',mail@mail.com';
                        break;
                    case 'CEMENTOS':
                        $tco .= ',mail@mail.com';
                }
            }
       }

     
        $to = "mail@mail.com".$tco.",mail@mail.com,".$mail.",".$dtorcom;
        $subject = "PEDIDO SIN STOCK";
        $headers =  'MIME-Version: 1.0' . "\r\n"; 
        $headers .= 'From: xxx <mail@mail.com>' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n"; 
        $message = "<p>Estimado compañero,<br>";
        $message .=  "El pedido ".$pedido." para el cliente ".$cliente." queda retenido por no haber existencia de: <br>";
        if(!empty($_POST['PRODUCTO'])){
        
            foreach($_POST['PRODUCTO'] as $selected){
            $message .= $selected."<br>";
            }
        }
        $message .= "<br>Quedamos a la espera de tus instrucciones para poder atender al cliente lo antes posible.";
        $message .="<br><br>Recibe un cordial saludo</p><br>";
        

        echo "<form action='form.php'>";
        echo "<p><h4>EL MENSAJE;</h4> ".$message."<h4> HA SIDO ENVIADO A;</h4><br><br>
        <table class='confirmacion'>
            <tr>
                <td class='nombre'>".$nombre_vendedor.":</td>
                <td class='mail'>".$mail."</td>
            </tr>
            <tr>
                <td class='nombre'>".$nombre_dc.":</td>
                <td class='mail'>".$dtorcom."</td>
            </tr>
        </table>";
        echo "<input type='submit' value='VOLVER'></a></p>";
        echo "</form>";
        }
    sqlsrv_close($conn);
    mail($to, $subject, $message, $headers);
?>