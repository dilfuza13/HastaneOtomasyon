<?PHP
	require_once("inc_config.php");

	if(isset($_SESSION['user']) && isset($_SESSION['user']['id']) && isset($_SESSION['user']['login'])){$_SESSION['alert'] = ['primary' => 'Giriş yapılmış...']; header("Location:index.php"); exit;}
?>
<!doctype html>
<html lang="tr">
	<head>
		<meta charset="utf-8">
		<title><?=_SiteName;?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="author" content="Volkan Sezer" />
		<link rel="shortcut icon" href="login-logo.png" />
		<link href="login.css" rel="stylesheet" />
	</head>
	<body>
		<div id="loading"><div class="loader"></div></div>

		<form action="logincheck.php" method="post" class="form-signin text-center">
			<img class="mb-4" src="login-logo.png" alt="" width="250" height="250">
			<h1 class="h3 mb-3 font-weight-normal"><?=_SiteName;?></h1>
			<div>
				<?PHP if(isset($_SESSION['alert'])){?>
				<div class="alert alert-danger" role="alert"><?=$_SESSION['alert']['warning'];?></div>
				<?PHP unset($_SESSION['alert']); }?>
			</div>

			<label for="username" class="sr-only">Kullanıcı adı</label>
			<input type="text" id="username" name="username" class="form-control" placeholder="Kullanıcı adı..." autocomplete="off" autofocus>

			<label for="password" class="sr-only">Parola</label>
			<input type="password" id="password" name="password" class="form-control" placeholder="Parola...">
			
			
			<button class="btn btn-lg btn-primary btn-block" type="submit">GİRİŞ</button>

			<p class="mt-5 mb-3 text-muted">&copy; <?=_CopyRight;?></p>

			<input type="hidden" name="action" value="giriskontrol" />
			<input type="hidden" name="recaptchaToken" id="recaptchaToken">
		</form>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
		<script src="https://code.jquery.com/jquery-1.12.4.js" type="text/javascript"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" type="text/javascript"></script>
	</body>
</html>
<!-- © Volkan Sezer -->