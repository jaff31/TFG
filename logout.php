<?php
session_start();      
session_unset();      
session_destroy();    

// Redirigir al login o a la página pública
header("Location: ../index.php"); 
exit();
?>
