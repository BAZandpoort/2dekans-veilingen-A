<?php
    function convertPasswordToHash($wachtwoord) {
        $hashedpassword = password_hash($wachtwoord, PASSWORD_DEFAULT);
        return $hashedpassword;
    };
?>