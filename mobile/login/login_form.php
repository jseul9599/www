<?
	session_start();

    @extract($_GET);
    @extract($_POST);
    @extract($_SESSION);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>로그인</title>
	<link rel="stylesheet" href="../css/common.css">
	<link rel="stylesheet" href="./css/login_form.css">
</head>
<body>
	<header>
		<h1><a href="../index.html">롯데정밀화학</a></h1>
	</header>

	<article id="content">
		<h2>로그인</h2>
		<form  name="member_form" method="post" action="login.php">
			<ul id="id_pw_input">
				<li>
					<label for="id" class="hidden">아이디</label>
					<input type="text" name="id" id="id" class="login_input" placeholder="아이디를 입력하세요">
				</li>
				<li>
					<label for="pass" class="hidden">비밀번호</label>
					<input type="password" name="pass" id="pass" class="login_input" placeholder="비밀번호를 입력하세요">
				</li>
				<li>
					<button>로그인</button>
				</li>
			</ul>						
		</form>
		<ul class="find_account">
			<li><a href="./find_id.php">아이디 찾기</a></li>
			<li><a href="./find_pw.php">비밀번호 찾기</a></li>
		</ul>
		<div class="make_account">
			<p>아직 회원이 아니신가요?</p>
			<a href="../member/member_check.html">회원가입</a>
		</div>
	</article>
</body>
</html>
