<?PHP

	header('Content-Type: text/html; charset=utf-8');
	@ob_start(); @session_start(); error_reporting(E_ALL); ini_set('display_errors', 'On');

	session_destroy();

	header("Location:index.php");

?>