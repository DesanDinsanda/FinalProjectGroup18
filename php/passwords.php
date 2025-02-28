<?php

$eventManagerPwd = "Ransilu123";

echo "Admin Password"; 
echo "<br>";
echo password_hash($eventManagerPwd, PASSWORD_BCRYPT);
echo "<br>";

$adminPwd = "Denura123";

echo "Event manager Password"; 
echo "<br>";
echo password_hash($adminPwd, PASSWORD_BCRYPT);


?>