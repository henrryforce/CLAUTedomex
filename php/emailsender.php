<?php
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/autoload.php';

class enviarCorreo
{
    private $to;
    private $subject;
    public function __construct($to, $subject)
    {
        $this->to = $to;
        $this->subject = $subject;
    }
    public function enviar()
    {
        $mail = new PHPMailer(true);

        try {
            //Configuración del servidor
            $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Habilitar los mensajes de depuración
            $mail->isSMTP(); //Enviar usando SMTP
            $mail->Host = 'smtp.gmail.com'; //Configurar el servidor SMTP
            $mail->SMTPAuth = true; //Habilitar autenticación SMTP
            $mail->Username = 'allstarblaster98@gmail.com'; //Nombre de usuario SMTP
            $mail->Password = 'zorabel98'; //Contraseña SMTP
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //Habilitar el cifrado TLS
            $mail->Port = 587; //Puerto TCP al que conectarse; use 587 si configuró `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Emisor
            $mail->setFrom('allstarblaster98@gmail.com', 'Ventas Pruebas PHP');

            //Destinatarios
            $mail->addAddress($this->to); //Añadir un destinatario, el nombre es opcional

            //Destinatarios opcionales
            $mail->addReplyTo('info@example.com', 'Information'); //Responder a
            //$mail->addCC('cc@example.com');                        //Copia pública
            //$mail->addBCC('bcc@example.com');                      //Copia oculta

            //Archivos adjuntos
            //$mail->addAttachment('img1.jpeg', 'Comunicado');         //Agregar archivos adjuntos, nombre opcional

            //Nombre opcional
            $mail->isHTML(true); //Establecer el formato de correo electrónico en HTMl
            $mail->Subject = $this->subject;
            $mail->AddEmbeddedImage("img1.jpeg", "my-attach", "img1.jpeg"); //path, ID a buscar cid:el ID, nombre archivo
            $mail->Body = file_get_contents('plantilla.html');
            $mail->AltBody = 'Este es el cuerpo en texto sin formato para clientes de correo que no son HTML';

            $mail->send(); //Enviar correo eletrónico
            return 'El mensaje ha sido enviado';
        } catch (Exception $e) {
            return "No se pudo enviar el mensaje. Error de correo: {$mail->ErrorInfo}";
        }
    }
    public function sendCode($code)
    {
        $mail = new PHPMailer(true);
        try {
            //Configuración del servidor
            $mail->SMTPDebug = SMTP::DEBUG_OFF; //Habilitar los mensajes de depuración
            $mail->isSMTP(); //Enviar usando SMTP
            $mail->Host = 'smtp.gmail.com'; //Configurar el servidor SMTP
            $mail->SMTPAuth = true; //Habilitar autenticación SMTP
            $mail->Username = 'allstarblaster98@gmail.com'; //Nombre de usuario SMTP
            $mail->Password = 'zorabel98'; //Contraseña SMTP
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //Habilitar el cifrado TLS
            $mail->Port = 587; //Puerto TCP al que conectarse; use 587 si configuró `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            //Emisor
            $mail->setFrom('allstarblaster98@gmail.com', 'Registro BAM 24/7');
            //Destinatarios
            $mail->addAddress($this->to); //Añadir un destinatario, el nombre es opcional
            //Nombre opcional
            $mail->isHTML(true); //Establecer el formato de correo electrónico en HTMl
            $mail->Subject = $this->subject;
            $mail->AddEmbeddedImage("logo-main.png", "my-attach", "logo-main.png"); //path, ID a buscar cid:el ID, nombre archivo
            $html = file_get_contents('CodigoEmail.html');
            $html = str_replace('{{code}}', $code, $html);
            $mail->CharSet = 'UTF-8';
            $mail->Body = $html;
            $mail->AltBody = 'Codigo de Verificacion :' . $code;
            $mail->send(); //Enviar correo eletrónico
            return 'El mensaje ha sido enviado';
        } catch (Exception $e) {
            return "No se pudo enviar el mensaje. Error de correo: {$mail->ErrorInfo}";
        }
    }
    public function correoContacto($name, $email, $phone, $subject, $message)
    {
        $mail = new PHPMailer(true);
        try {
            //Configuración del servidor
            $mail->SMTPDebug = SMTP::DEBUG_OFF; //Habilitar los mensajes de depuración
            $mail->isSMTP(); //Enviar usando SMTP
            $mail->Host = 'smtp.gmail.com'; //Configurar el servidor SMTP
            $mail->SMTPAuth = true; //Habilitar autenticación SMTP
            $mail->Username = 'allstarblaster98@gmail.com'; //Nombre de usuario SMTP
            $mail->Password = 'zorabel98'; //Contraseña SMTP
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //Habilitar el cifrado TLS
            $mail->Port = 587; //Puerto TCP al que conectarse; use 587 si configuró `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Emisor
            $mail->setFrom('allstarblaster98@gmail.com', 'Contacto BAM 24/7');

            //Destinatarios
            $mail->addAddress('allstarblaster98@gmail.com'); //Añadir un destinatario, el nombre es opcional

            //Destinatarios opcionales
            $mail->addReplyTo('admin@example.com', 'Contacto'); //Responder a
            //$mail->addCC('cc@example.com');                        //Copia pública
            //$mail->addBCC('bcc@example.com');                      //Copia oculta

            //Archivos adjuntos
            //$mail->addAttachment('img1.jpeg', 'Comunicado');         //Agregar archivos adjuntos, nombre opcional

            //Nombre opcional
            $mail->isHTML(true); //Establecer el formato de correo electrónico en HTMl
            $mail->CharSet = 'UTF-8';
            $mail->Subject = $this->subject;
            $mail->AddEmbeddedImage("logo-main.png", "my-attach", "logo-main.png"); //path, ID a buscar cid:el ID, nombre archivo
            $html = file_get_contents('Contacto.html');
            $html = str_replace('{{usuario}}', $name, $html); //string en busqueda, reemlazo , cadena en donde se busca
            $html = str_replace('{{email}}', $email, $html); //string en busqueda, reemlazo , cadena en donde se busca
            $html = str_replace('{{telefono}}', $phone, $html); //string en busqueda, reemlazo , cadena en donde se busca
            $html = str_replace('{{mensaje}}', $message, $html); //string en busqueda, reemlazo , cadena en donde se busca
            $html = str_replace('{{asunto}}', $subject, $html); //string en busqueda, reemlazo , cadena en donde se busca

            $mail->Body = $html;
            //$mail->AltBody = 'Este es el cuerpo en texto sin formato para clientes de correo que no son HTML';

            $mail->send(); //Enviar correo eletrónico
            $this->enviarCorreoF();
            return 'El mensaje ha sido enviado';
        } catch (Exception $e) {
            return "No se pudo enviar el mensaje. Error de correo: {$mail->ErrorInfo}";
        }

    }
    
   
    public function enviarCorreoF()
    {
        $mail = new PHPMailer(true);
        try {
            //Configuración del servidor
            $mail->SMTPDebug = SMTP::DEBUG_OFF; //Habilitar los mensajes de depuración
            $mail->isSMTP(); //Enviar usando SMTP
            $mail->Host = 'smtp.gmail.com'; //Configurar el servidor SMTP
            $mail->SMTPAuth = true; //Habilitar autenticación SMTP
            $mail->Username = 'allstarblaster98@gmail.com'; //Nombre de usuario SMTP
            $mail->Password = 'zorabel98'; //Contraseña SMTP
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //Habilitar el cifrado TLS
            $mail->Port = 587; //Puerto TCP al que conectarse; use 587 si configuró `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Emisor
            $mail->setFrom('allstarblaster98@gmail.com', 'Contacto BAM 24/7');

            //Destinatarios
            $mail->addAddress($this->to); //Añadir un destinatario, el nombre es opcional

            //Destinatarios opcionales
            $mail->addReplyTo('admin@example.com', 'Contacto'); //Responder a
            //$mail->addCC('cc@example.com');                        //Copia pública
            //$mail->addBCC('bcc@example.com');                      //Copia oculta

            //Archivos adjuntos
            //$mail->addAttachment('img1.jpeg', 'Comunicado');         //Agregar archivos adjuntos, nombre opcional

            //Nombre opcional
            $mail->isHTML(true); //Establecer el formato de correo electrónico en HTMl
            $mail->CharSet = 'UTF-8';
            $mail->Subject = "Recibimos tu solicitud";
            $mail->AddEmbeddedImage("logo-main.png", "my-attach", "logo-main.png"); //path, ID a buscar cid:el ID, nombre archivo
            $html = file_get_contents('ContactoU.html');

            $mail->Body = $html;
            //$mail->AltBody = 'Este es el cuerpo en texto sin formato para clientes de correo que no son HTML';

            $mail->send(); //Enviar correo eletrónico
            return 'El mensaje ha sido enviado';
        } catch (Exception $e) {
            return "No se pudo enviar el mensaje. Error de correo: {$mail->ErrorInfo}";
        }
    }
    public function mailTtoP($nameT,$nameP,$emailT,$emailP,$datosTabla,$emailCC)
    {
        $mail = new PHPMailer(true);
        try {
            //Configuración del servidor
            $mail->SMTPDebug = SMTP::DEBUG_OFF; //Habilitar los mensajes de depuración
            $mail->isSMTP(); //Enviar usando SMTP
            $mail->Host = 'smtp.gmail.com'; //Configurar el servidor SMTP
            $mail->SMTPAuth = true; //Habilitar autenticación SMTP
            $mail->Username = 'allstarblaster98@gmail.com'; //Nombre de usuario SMTP
            $mail->Password = 'zorabel98'; //Contraseña SMTP
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //Habilitar el cifrado TLS
            $mail->Port = 587; //Puerto TCP al que conectarse; use 587 si configuró `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            //Emisor
            $mail->setFrom('allstarblaster98@gmail.com', 'Contacto BAM 24/7');
            //Destinatarios
            $mail->addAddress($this -> to); //Añadir un destinatario, el nombre es opcional
            //Destinatarios opcionales
            $mail->addReplyTo('admin@example.com', 'Contacto'); //Responder a
            //$mail->addCC('cc@example.com');                        //Copia pública          
            //Archivos adjuntos
            $mail->isHTML(true); //Establecer el formato de correo electrónico en HTMl
            $mail->CharSet = 'UTF-8';
            $mail->Subject = $this->subject;
            $mail->AddEmbeddedImage("logo-main.png", "my-attach", "logo-main.png"); //path, ID a buscar cid:el ID, nombre archivo
            $html = file_get_contents('AlertaAdmin.html');
            $html = str_replace('{{usuarioT}}', $nameT, $html); //string en busqueda, reemlazo , cadena en donde se busca
            $html = str_replace('{{usuarioP}}', $nameP, $html); //string en busqueda, reemlazo , cadena en donde se busca           
            $mail->Body = $html;
            //$mail->AltBody = 'Este es el cuerpo en texto sin formato para clientes de correo que no son HTML';
            $mail->send(); //Enviar correo eletrónico
            $this -> notificarTractora($emailT,$nameP);
            $this -> notificarProveedor($emailP,$datosTabla,$nameT,$emailCC);
            return 'El mensaje ha sido enviado';
        } catch (Exception $e) {
            return "No se pudo enviar el mensaje. Error de correo: {$mail->ErrorInfo}";
        }

    }
    public function notificarTractora($email,$nameP)
    {
        $mail = new PHPMailer(true);
        try {
            //Configuración del servidor
            $mail->SMTPDebug = SMTP::DEBUG_OFF; //Habilitar los mensajes de depuración
            $mail->isSMTP(); //Enviar usando SMTP
            $mail->Host = 'smtp.gmail.com'; //Configurar el servidor SMTP
            $mail->SMTPAuth = true; //Habilitar autenticación SMTP
            $mail->Username = 'allstarblaster98@gmail.com'; //Nombre de usuario SMTP
            $mail->Password = 'zorabel98'; //Contraseña SMTP
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //Habilitar el cifrado TLS
            $mail->Port = 587; //Puerto TCP al que conectarse; use 587 si configuró `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Emisor
            $mail->setFrom('allstarblaster98@gmail.com', 'Contacto BAM 24/7');

            //Destinatarios
            $mail->addAddress($email); //Añadir un destinatario, el nombre es opcional

            //Destinatarios opcionales
            $mail->addReplyTo('admin@example.com', 'Contacto'); //Responder a
            //$mail->addCC('cc@example.com','juan');                        //Copia pública
            //$mail->addBCC('bcc@example.com');                      //Copia oculta
            //Archivos adjuntos
            //$mail->addAttachment('img1.jpeg', 'Comunicado');         //Agregar archivos adjuntos, nombre opcional
            //Nombre opcional
            $mail->isHTML(true); //Establecer el formato de correo electrónico en HTMl
            $mail->CharSet = 'UTF-8';
            $mail->Subject = 'Contacto a proveedor exitoso';
            $mail->AddEmbeddedImage("logo-main.png", "my-attach", "logo-main.png"); //path, ID a buscar cid:el ID, nombre archivo
            $html = file_get_contents('ContactoTractoraNoti.html');
            $html = str_replace('{{nombre}}', $nameP, $html); //string en busqueda, reemlazo , cadena en donde se busca
            $mail->Body = $html;
            //$mail->AltBody = 'Este es el cuerpo en texto sin formato para clientes de correo que no son HTML';
            $mail->send(); //Enviar correo eletrónico
            return 'El mensaje ha sido enviado';
        } catch (Exception $e) {
            return "No se pudo enviar el mensaje. Error de correo: {$mail->ErrorInfo}";
        }

    }
    public function notificarProveedor($email,$datosTabla,$nameT,$emailCC)
    {
        $mail = new PHPMailer(true);
        try {
            //Configuración del servidor
            $mail->SMTPDebug = SMTP::DEBUG_OFF; //Habilitar los mensajes de depuración
            $mail->isSMTP(); //Enviar usando SMTP
            $mail->Host = 'smtp.gmail.com'; //Configurar el servidor SMTP
            $mail->SMTPAuth = true; //Habilitar autenticación SMTP
            $mail->Username = 'allstarblaster98@gmail.com'; //Nombre de usuario SMTP
            $mail->Password = 'zorabel98'; //Contraseña SMTP
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //Habilitar el cifrado TLS
            $mail->Port = 587; //Puerto TCP al que conectarse; use 587 si configuró `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Emisor
            $mail->setFrom('allstarblaster98@gmail.com', 'Contacto BAM 24/7');

            //Destinatarios
            $mail->addAddress($email); //Añadir un destinatario, el nombre es opcional

            //Destinatarios opcionales
            $mail->addReplyTo('admin@example.com', 'Contacto'); //Responder a
            foreach($emailCC as $cc){
            $mail->addCC($cc[0],$cc[1]);    
            }
            //$mail->addCC('cc@example.com','juan');                        //Copia pública
            //$mail->addBCC('bcc@example.com');                      //Copia oculta
            //Archivos adjuntos
            //$mail->addAttachment('img1.jpeg', 'Comunicado');         //Agregar archivos adjuntos, nombre opcional
            //Nombre opcional
            $mail->isHTML(true); //Establecer el formato de correo electrónico en HTMl
            $mail->CharSet = 'UTF-8';
            $mail->Subject = 'IMPORTANTE una tractora esta interesada en tus productos';
            $mail->AddEmbeddedImage("logo-main.png", "my-attach", "logo-main.png"); //path, ID a buscar cid:el ID, nombre archivo
            $html = file_get_contents('ContactoProveedor.html');
            $html = str_replace('{{usuario}}', $nameT, $html); //string en busqueda, reemlazo , cadena en donde se buscar
            $html = str_replace('{{tabla}}', $datosTabla, $html); //string en busqueda, reemlazo , cadena en donde se buscar
            $mail->Body = $html;
            //$mail->AltBody = 'Este es el cuerpo en texto sin formato para clientes de correo que no son HTML';
            $mail->send(); //Enviar correo eletrónico
            return 'El mensaje ha sido enviado';
        } catch (Exception $e) {
            return "No se pudo enviar el mensaje. Error de correo: {$mail->ErrorInfo}";
        }

    }
}
