<?php 
require 'commands.php';

$command = new Command();

$fid = $_GET['fid'];

$command->deleteFlow($fid);

header("Location: viewflow.php");
die();
?>