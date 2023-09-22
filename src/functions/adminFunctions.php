<?php 

    function insertHashedPasswordIntoDatabase($connection, $wachtwoord) {
        $sql = "INSERT INTO tblgebruikers(wachtwoord) VALUES ('".convertPasswordToHash($wachtwoord)."')";
        return($connection->query($sql));
    };

    function convertPasswordToHash($wachtwoord) {
        $hashedPassword = password_hash($wachtwoord, PASSWORD_DEFAULT);
        return $hashedPassword;
    };

?>