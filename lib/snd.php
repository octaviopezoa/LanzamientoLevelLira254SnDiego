    <?php
    if(isset($_POST['proyecto'])) {       
        
        if ($_POST['proyecto']=='Lira') {     
            $email_to = "byl.lira@gmail.com,".$_POST['correo']; 

        } 
        
        if ($_POST['proyecto']=='Portugal') {
            $email_to = "byl.portugal@gmail.com,".$_POST['correo']; 
        }
        

        //Para y asunto del mensaje a enviar
        $email_subject = "Solicitud Level Euro ".$_POST['proyecto'];
         
         
        function died($error) {          
            echo "Lo sentimos mucho, pero hubo un error(es) encontrado en el formulario que se quizo cotizar. ";
            echo "Estos son los errores:<br /><br />";
            echo $error."<br /><br />";
            echo "Retroceda y arregle el error.<br /><br />";
            die();
        }
         
        // validation expected data exists
        
        if(!isset($_POST['nombre']) ||
            !isset($_POST['proyecto']) ||
            !isset($_POST['rut']) ||
            !isset($_POST['correo']) ||
            !isset($_POST['telefono']) ||
            !isset($_POST['correo']) ||
            !isset($_POST['pais']) ||
            !isset($_POST['fecha'])||
            !isset($_FILES['liq01']['name'])||
            !isset($_FILES['liq02']['name'])||
            !isset($_FILES['liq03']['name'])||
            !isset($_FILES['certificado']['name'])||
            !isset($_FILES['contrato']['name']) ){
            died('Lo sentimos, pero hubo un error(es) encontrado en el formulario que se quizo cotizar.');       
        }
         
        //*******************************/
        //variables para los campos
        //*******************************/
        $proyecto=$_POST['proyecto'];
        $nombre = $_POST['nombre']; // required
        $rut=$_POST['rut']; // required
        $email_from = $_POST['correo']; // required
        $email = $_POST['correo']; // bbdd
        $telefono = $_POST['telefono']; // required
        $nacionalidad = $_POST['pais']; // required
        $fecha = $_POST['fecha']; // required
             
        
        //ADJUNTO 01 =========================
        //variables para los datos del archivo 
        $liq1 = $_FILES['liq01']['name'];
        $archivo1 = $_FILES['liq01']['tmp_name'];

        // Leemos el archivo a adjuntar        
        $archivo1 = file_get_contents($archivo1);
        $archivo1 = chunk_split(base64_encode($archivo1));


        //ADJUNTO 02 =========================
        //variables para los datos del archivo 
        $liq2 = $_FILES['liq02']['name'];
        $archivo2 = $_FILES['liq02']['tmp_name'];

        // Leemos el archivo a adjuntar        
        $archivo2 = file_get_contents($archivo2);
        $archivo2 = chunk_split(base64_encode($archivo2));
         

        //ADJUNTO 03 =========================
        //variables para los datos del archivo 
        $liq3 = $_FILES['liq03']['name'];
        $archivo3 = $_FILES['liq03']['tmp_name'];

        // Leemos el archivo a adjuntar        
        $archivo3 = file_get_contents($archivo3);
        $archivo3 = chunk_split(base64_encode($archivo3));


        //ADJUNTO 04 =========================
        //variables para los datos del archivo 
        $certificado = $_FILES['certificado']['name'];
        $archivo4 = $_FILES['certificado']['tmp_name'];

        // Leemos el archivo a adjuntar        
        $archivo4 = file_get_contents($archivo4);
        $archivo4 = chunk_split(base64_encode($archivo4));


        //ADJUNTO 05 =========================
        //variables para los datos del archivo 
        $contrato = $_FILES['contrato']['name'];
        $archivo5 = $_FILES['contrato']['tmp_name'];

        // Leemos el archivo a adjuntar        
        $archivo5 = file_get_contents($archivo5);
        $archivo5 = chunk_split(base64_encode($archivo5));
         
    // create email headers
          /*$headers = "MIME-Version: 1.0\r\n";
          $headers .= "Content-type: multipart/mixed;";
          $headers .= "boundary=\"=A=G=R=O=\"\r\n";
          $headers .= "From : ".$email_from."\r\n"; */
         
          function clean_string($string) {
          $bad = array("content-type","bcc:","to:","cc:","href");
          return str_replace($bad,"",$string);
        }
        
        
         // Cuerpo del Email
        $CuerpoMensaje .= "Pronto nos pondremos en contacto con Ud.:\r\n\r\n";
        $CuerpoMensaje .= "Proyecto: ".clean_string($proyecto)."\r\n";
        $CuerpoMensaje .= "Nombre: ".clean_string($nombre)."\r\n";
        $CuerpoMensaje .= "Rut: ".clean_string($rut)."\r\n";
        $CuerpoMensaje .= "Email: ".clean_string($email_from)."\r\n";    
        $CuerpoMensaje .= "Telefono: ".clean_string($telefono)."\r\n";
        $CuerpoMensaje .= "Pais: ".clean_string($nacionalidad)."\r\n";
        $CuerpoMensaje .= "Fecha estimada de arriendo: ".clean_string($fecha)."\r\n";        
        //$CuerpoMensaje .= "<b>Mensaje:</b> ".clean_string($mensaje)."\r\n";
          
        
         //cabecera del email (forma correcta de codificarla)
        $headers = "From: Level Euro <" . $email_from . ">\r\n";
        //$header .= "Reply-To: " . $replyto . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary=\"=A=G=R=O=\"\r\n\r\n";
        
        
        //armando mensaje del email
        $email_message = "--=A=G=R=O=\r\n";
        $email_message .= "Content-type:text/plain; charset=utf-8\r\n";
        $email_message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $email_message .= $CuerpoMensaje . "\r\n\r\n";
        
        //archivo 01 adjunto  para email  
        $email_message .= "--=A=G=R=O=\r\n";
        $email_message .= "Content-Type: application/octet-stream; name=\"" . $liq1 . "\"\r\n";
        $email_message .= "Content-Transfer-Encoding: base64\r\n";
        $email_message .= "Content-Disposition: attachment; filename=\"" . $liq1 . "\"\r\n\r\n";
        $email_message .= $archivo1 . "\r\n\r\n";
        
        //archivo 02 adjunto  para email 
        $email_message .= "--=A=G=R=O=\r\n";
        $email_message .= "Content-Type: application/octet-stream; name=\"" . $liq2 . "\"\r\n";
        $email_message .= "Content-Transfer-Encoding: base64\r\n";
        $email_message .= "Content-Disposition: attachment; filename=\"" . $liq2 . "\"\r\n\r\n";
        $email_message .= $archivo2 . "\r\n\r\n";
        
        //archivo 03 adjunto  para email 
        $email_message .= "--=A=G=R=O=\r\n";
        $email_message .= "Content-Type: application/octet-stream; name=\"" . $liq3 . "\"\r\n";
        $email_message .= "Content-Transfer-Encoding: base64\r\n";
        $email_message .= "Content-Disposition: attachment; filename=\"" . $liq3 . "\"\r\n\r\n";
        $email_message .= $archivo3 . "\r\n\r\n";

        //archivo 04 adjunto  para email 
        $email_message .= "--=A=G=R=O=\r\n";
        $email_message .= "Content-Type: application/octet-stream; name=\"" . $certificado . "\"\r\n";
        $email_message .= "Content-Transfer-Encoding: base64\r\n";
        $email_message .= "Content-Disposition: attachment; filename=\"" . $certificado . "\"\r\n\r\n";
        $email_message .= $archivo4 . "\r\n\r\n";

        //archivo 05 adjunto  para email 
        $email_message .= "--=A=G=R=O=\r\n";
        $email_message .= "Content-Type: application/octet-stream; name=\"" . $contrato . "\"\r\n";
        $email_message .= "Content-Transfer-Encoding: base64\r\n";
        $email_message .= "Content-Disposition: attachment; filename=\"" . $contrato . "\"\r\n\r\n";
        $email_message .= $archivo5 . "\r\n\r\n";
        $email_message .= "--=A=G=R=O=--";
        
        
        
        //enviamos el email
        mail($email_to, $email_subject, $email_message, $headers);


        //=================================
        //Insercion en base de datos
        //=================================

        include 'cnx.php';

        $querySQL="insert into datos (proyecto,nombre,rut,email,telefono,nacionalidad,fecha) values ('$proyecto','$nombre','$rut','$email','$telefono','$nacionalidad','$fecha');";


        //Se agregó este if, porque al momento de insertar un registro,

        if ($proyecto!="" && $nombre!="" && $rut!="" && $telefono!="" && $email!="") {
            # code...
            if ($conexion->query($querySQL)=== TRUE) {
                
                die($conexion);
            }
        } 

        $conexion->close();
        
        //Confirmación asincrona
        header("Location: www.leveleuro.cl/lanzamiento/exito.php");
        
    }
          
?>