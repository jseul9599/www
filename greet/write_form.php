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
	<title>인재채용 - 채용공고</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
	<link rel="stylesheet" href="../common/css/common.css">
	<link rel="stylesheet" href="../sub5/common/css/sub5common.css">
	<link rel="stylesheet" href="./css/write_form.css">
</head>
<body>
	<? include '../common/sub_header.html' ?>

	<div class="visual">
		<p>
			<span>C</span>
			<span>A</span>
			<span>R</span>
			<span>E</span>
			<span>E</span>
			<span>R</span>
			<span>S</span>
		</p>
		<h3>인재채용</h3>
	</div>

	<div class="sub_menu">
		<ul>
		<li><a href="../sub5/sub5_1.html">인재상</a></li>
			<li><a href="../sub5/sub5_2.html">직무소개</a></li>
			<li class="current"><a href="./list.php">채용공고</a></li>
		</ul>
	</div>

	<article id="content">
		<div class="title_area">
			<div class="line_map">
				<i class="fas fa-home"></i>
				<span>인재채용</span>
				<strong>채용공고</strong>
			</div>
			<h2>채용공고</h2>
			<p>실패를 두려워하지 않고 끊임없이 노력하며 협력과 상생을 아는 젊은이를 찾습니다</p>
		</div>
		<!-- content-area -->
		<div class="content_area">
			<!-- write_title -->
			<div class="write_title">글쓰기</div>
			<!-- write_content -->
			<div class="write_content">
				<form  name="board_form" method="post" action="insert.php">
					<!-- write_form -->
					<div class="write_form">
						<ul id="write_row1">
							<li>작성자</li>
							<li><?=$usernick?></li>
							<li><input type="checkbox" name="html_ok" value="y"> HTML 쓰기</li>
						</ul>
						<ul id="write_row2">
							<li>제목</li>
							<li><input type="text" name="subject"></li>
						</ul>
						<ul id="write_row3">
							<li>내용</li>
							<li><textarea rows="15" name="content"></textarea></li>
						</ul>
					</div>
					<!-- write_buttons -->
					<div class="write_buttons">
						<button>완료</button>
						<a href="list.php?page=<?=$page?>">목록</a>
					</div>
				</form>
			</div>
		</div>
	</article>

	<? include '../common/sub_footer.html' ?>
</body>
</html>