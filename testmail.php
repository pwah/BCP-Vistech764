<?php
if(file_exists("/usr/share/php/Mail/smtp.php") == 1){
        //require_once "Mail.php";
        $from = 'bcp_admin@sit764.killersoft.net';
        $to = 'gmclenna@deakin.edu.au';
        $subject = 'Password recovery for BCP';
        $body = "Your recovery password is \n\n   (*&^*&#^*&#Y*&#UHJKH";
        $headers = array(
            'From' => $from,
            'To' => $to,
            'Subject' => $subject
        );
        $smtp = Mail::factory('smtp', array(
                'host' => 'ssl://mail.internode.on.net',
                'port' => '465',
                'auth' => true,
                'username' => 'mclennan@internode.on.net',
                'password' => 'Qwaszx01'
            ));
        $mail = $smtp->send($to, $headers, $body);
        if (PEAR::isError($mail)) {
            echo('<p>' . $mail->getMessage() . '</p>');
        } else {
            echo('<p>Message successfully sent!</p>');
        }
        }
    else{
        echo "./usr/share/pear/Mail/smtp.php file not found";
        }
?>