<?php 

    function insertHashedPasswordIntoDatabase($connection, $id, $wachtwoord) {
        $sql = "UPDATE tblgebruikers SET wachtwoord = '".convertPasswordToHash($wachtwoord)."' WHERE gebruikersid = '".$id."'";
        return($connection->query($sql));
    };

    function convertPasswordToHash($wachtwoord) {
        $hashedPassword = password_hash($wachtwoord, PASSWORD_DEFAULT);
        return $hashedPassword;
    };

?>