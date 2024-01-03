<?php
$dev = 1; // 0 = production, 1 = development
if($dev == 1){
   ini_set( 'display_errors', 'On' );
   error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE);
}
?>