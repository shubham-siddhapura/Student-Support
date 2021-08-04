<?php

error_reporting(E_ALL|E_STRICT);
        ini_set('display_errors', 1);

        $email="ssiddhapura10@gmail.com";
        $subject = "Email Verification";
        $body = "Hi, Click below link for activate your account";
        $sender_email = "From:Student Support";

        if (mail($email, $subject, $body, $sender_email)) {
            echo "Email successfully sent to $email...";
        } else {
            echo "Email sending failed...";
        }

        ?>