<?php
include '../sql/mdui.php';
function alert($con,$link){
	echo '<script> alert("'.$con.'"); window.location.href="'.$link.'" </script>';
}
function snackbar($msg){
	echo "<script> mdui.snackbar({ message: '".$msg."',position: 'top'});</script>";
}
?>