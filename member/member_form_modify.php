<?
	session_start();

    @extract($_GET);
    @extract($_POST);
    @extract($_SESSION);

    include "../lib/dbconn.php";

    $sql = "select * from member where id='$userid'";
    $result = mysql_query($sql, $connect);

    $row = mysql_fetch_array($result);

    $hp = explode("-", $row[hp]);
    $hp1 = $hp[0];
    $hp2 = $hp[1];
    $hp3 = $hp[2];

    $email = explode("@", $row[email]);
    $email1 = $email[0];
    $email2 = $email[1];

    mysql_close();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원정보수정</title>
    <link rel="stylesheet" href="../common/css/common.css">
    <link rel="stylesheet" href="./css/member_form.css">

    <script src="../common/js/jquery-1.12.4.min.js"></script>
    <script src="../common/js/jquery-migrate-1.4.1.min.js"></script>
    <script src="./js/member_form_modify.js"></script>
</head>
<body>
    <header>
        <h1><a class="logo" href="../index.html">롯데정밀화학</a></h1>
    </header>

    <article id="content">
        <div class="title_box">
            <h2>회원정보수정</h2>
            <p class="comment"><span>*</span> 는 필수 입력 항목입니다.</p>
        </div>
        <form  name="member_form" method="post" action="modify.php">
            <ul>
                <li>
                    <label for="id">아이디</label>
                    <input type="text" name="id" id="id" value="<?= $row[id] ?>" disabled>
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
                    <label for="name">이름</label>
                    <input type="text" name="name" id="name" value="<?= $row[name] ?>" disabled> 
                </li>
                <li>
                    <label for="nick"><span>*</span>닉네임<label>
                    <input type="text" name="nick" id="nick" value="<?= $row[nick] ?>" required>
                    <div id="loadtext3"></div>
                </li>
                <li>
                    <p><span>*</span>휴대폰</p>
                    <label class="hidden" for="hp1">전화번호앞3자리</label>
                    <select class="hp" name="hp1" id="hp1" value="<?= $hp1 ?>"> 
                        <option value='010'>010</option>
                        <option value='011'>011</option>
                    </select>
                    <span class="space">-</span>
                    <label class="hidden" for="hp2">전화번호중간4자리</label>
                    <input type="text" class="hp" name="hp2" id="hp2" maxlength="4" placeholder="(ex. 1111)" value="<?= $hp2 ?>" required>
                    <span class="space">-</span>
                    <label class="hidden" for="hp3">전화번호끝4자리</label>
                    <input type="text" class="hp" name="hp3" id="hp3" maxlength="4" placeholder="(ex. 2222)" value="<?= $hp3 ?>" required>
                </li>
                <li>
                    <p>이메일</p>
                    <label class="hidden" for="email1">이메일아이디</label>
                    <input type="text" id="email1" name="email1" value="<?= $email1 ?>" required>
                    <span class="space">@</span>
                    <label class="hidden" for="email2">이메일주소</label>
                    <input type="text" name="email2" id="email2" value="<?= $email2 ?>" required>
                </li>
            </ul>

            <div class="buttons">
                <button type="button" onclick="check_input()">저장하기</button>
                <button type="button" onclick="reset_form()">다시쓰기</button>
            </div>
        </form>
    </article>
</body>
</html>