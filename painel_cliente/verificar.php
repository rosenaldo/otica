<?php 
@session_start();
if (@$_SESSION['id'] == ""){
	echo '<script>window.location="../acesso"</script>';
	exit();
}

if (@$_SESSION['4841544fd5sf4ds'] != "8454fds5f4ds5f"){
	echo '<script>window.location="../acesso"</script>';
	exit();
}

 ?>
