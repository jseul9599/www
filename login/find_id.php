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
    <title>아이디 찾기</title>
    <link rel="stylesheet" href="../common/css/common.css">
	<link rel="stylesheet" href="./css/find_account.css">

    <script src="../common/js/jquery-1.12.4.min.js"></script>
    <script src="../common/js/jquery-migrate-1.4.1.min.js"></script>
    <script src="./js/find.js"></script>
</head>
<body>
    <header>
		<h1><a class="logo" href="../index.html">롯데정밀화학</a></h1>
	</header>

    <article id="content">
        <h2>아이디 찾기</h2>
        <form name="find" method="post" action="find1.php">
            <ul>
                <li>
                    <label for="name">이름</label>
                    <input type="text" name="name" id="name" required> 
                </li>
                <li>
                    <p>휴대폰</p>
                    <label class="hidden" for="hp1">전화번호앞3자리</label>
                    <select class="hp" name="hp1" id="hp1"> 
                        <option value='010'>010</option>
                        <option value='011'>011</option>
                    </select>
                    <span class="space">-</span>
                    <label class="hidden" for="hp2">전화번호중간4자리</label>
                    <input type="text" class="hp" name="hp2" id="hp2" maxlength="4" placeholder="(ex. 1111)" required>
                    <span class="space">-</span>
                    <label class="hidden" for="hp3">전화번호끝4자리</label>
                    <input type="text" class="hp" name="hp3" id="hp3" maxlength="4" placeholder="(ex. 2222)" required>
                </li>
                <li>
                    <button type="button" class="find">아이디 찾기</button>
                </li>
            </ul>
	    </form>

        <div id="loadtext"></div>

        <div class="find_account">
            <p>비밀번호를 잊으셨나요?</p>
            <a href="./find_pw.php">비밀번호 찾기</a>
        </div>
    </article>
</body>
</html>