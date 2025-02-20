<?php

require 'index.php';


session_destroy();
header('Location: connect.php');
exit();
?>
