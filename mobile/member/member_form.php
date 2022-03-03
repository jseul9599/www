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
	<title>회원가입</title>
	<link rel="stylesheet" href="../css/common.css">
	<link rel="stylesheet" href="./css/member_form.css">
	
	<script src="../js/jquery-1.12.4.min.js"></script>
    <script src="../js/jquery-migrate-1.4.1.min.js"></script>
    <script src="./js/member_form_redundancy.js"></script>
    <script src="./js/member_form.js"></script>
</head>
<body>
    <header>
        <h1><a class="logo" href="../index.html">롯데정밀화학</a></h1>
    </header>
	 
	<article id="content">
        <div class="title_box">
            <h2>회원가입</h2>
            <p class="comment"><span>*</span> 는 필수 입력 항목입니다.</p>
        </div>
        <form  name="member_form" method="post" action="insert.php">
            <ul>
                <li>
                    <label for="id"><span>*</span>아이디</label>
                    <input type="text" name="id" id="id" placeholder="영문 / 숫자만 사용가능" required>
                    <div id="loadtext1"></div>
                </li>
                <li>
                    <label for="pass"><span>*</span>비밀번호</label>
                    <input type="password" name="pass" id="pass" required>
                </li>
                <li>
                    <label for="pass_confirm"><span>*</span>비밀번호 확인</label>
                    <input type="password" name="pass_confirm" id="pass_confirm" required>
                    <div id="loadtext2"></div>
                </li>
                <li>
                    <label for="name"><span>*</span>이름</label>
                    <input type="text" name="name" id="name" required> 
                </li>
                <li>
                    <label for="nick"><span>*</span>닉네임<label>
                    <input type="text" name="nick" id="nick" required>
                    <div id="loadtext3"></div>
                </li>
                <li>
                    <p><span>*</span>휴대폰</p>
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
                    <p>이메일</p>
                    <label class="hidden" for="email1">이메일아이디</label>
                    <input type="text" id="email1" name="email1" required>
                    <span class="space">@</span>
                    <label class="hidden" for="email2">이메일주소</label>
                    <input type="text" name="email2" id="email2" required>
                </li>
            </ul>

            <div class="buttons">
                <button type="button" onclick="check_input()">가입하기</button>
                <button type="button" onclick="reset_form()">다시쓰기</button>
            </div>
        </form>
	</article>
</body>
</html>
