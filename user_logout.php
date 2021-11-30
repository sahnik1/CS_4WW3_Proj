<?php 
// First we start the session as normal
session_start();

// Now we want to discard the previous session, we can do so by first unsetting all the values
session_unset();

// Now we destroy the session, invalidating the user's cookies for this login
session_destroy();

header("location: user_login.php");
exit;
?>