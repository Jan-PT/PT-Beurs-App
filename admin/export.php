<?php
// The function header by sending raw excel
header("Content-type: application/vnd-ms-excel");
 
// Defines the name of the export file
header("Content-Disposition: attachment; filename=export@".date('d-m-Y|H:i:s', time()).".xls");
 
// Add data table
include 'data.php';
?>
