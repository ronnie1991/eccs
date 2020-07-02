<?php
session_start();
require_once('main.class.php');
$object->logout($_SESSION['sl_no']);
echo "
            <script type=\"text/javascript\">           
		   window.location='index';
            </script>
        "; 

?>