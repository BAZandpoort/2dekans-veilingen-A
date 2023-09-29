<?php

if (isset($_SESSION["login"])) {
    echo '
                <li>
                     <a href="loguit.php">uitloggen</a>
                </li> 
              ';
}else{
    echo '
                
                 <li>
                  <a  href="login.php">login</a>
              </li>
              ';
}
?>