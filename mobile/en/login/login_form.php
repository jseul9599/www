<?
	session_start();

    @extract($_GET);
    @extract($_POST);
    @extract($_SESSION);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sign In</title>
	<link rel="stylesheet" href="../css/common.css">
	<link rel="stylesheet" href="./css/login_form.css">
</head>
<body>
	<header>
		<h1><a href="../index.html">LOTTE FINE CHEMICAL</a></h1>
	</header>

	<article id="content">
		<h2>Sign In</h2>
		<form  name="member_form" method="post" action="login.php">
			<ul id="id_pw_input">
				<li>
					<label for="id" class="hidden">ID</label>
					<input type="text" name="id" id="id" class="login_input" placeholder="Type in your ID">
				</li>
				<li>
					<label for="pass" class="hidden">Password</label>
					<input type="password" name="pass" id="pass" class="login_input" placeholder="Type in your Password">
				</li>
				<li>
					<button>Sign In</button>
				</li>
			</ul>						
		</form>
		<ul class="find_account">
			<li><a href="./find_id.php">Find ID</a></li>
			<li><a href="./find_pw.php">Find Password</a></li>
		</ul>
		<div class="make_account">
			<p>New to Lotte Fine Chemical?</p>
			<a href="../member/member_check.html">Join</a>
		</div>
	</article>
</body>
</html>
