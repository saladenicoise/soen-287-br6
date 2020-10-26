<?PHP
header_remove(); 
	session_start();
	session_destroy();
	header('Location: /index.html');
?>