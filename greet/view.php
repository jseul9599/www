<? 
	session_start();

    @extract($_GET);
    @extract($_POST);
    @extract($_SESSION);

	include "../lib/dbconn.php";

	$sql = "select * from greet where num=$num";
	$result = mysql_query($sql, $connect);

    $row = mysql_fetch_array($result);

	$item_num = $row[num];
	$item_id = $row[id];
	$item_name = $row[name];
  	$item_nick = $row[nick];
	$item_hit = $row[hit];

    $item_date = $row[regist_day];

	$replace_search = array(" ", "[신입]", "[경력]");
	$replace_target = array("&nbsp;", "<span class='junior'>신입</span>", "<span class='senior'>경력</span>");
	$item_subject = str_replace($replace_search, $replace_target, $row[subject]);

	$item_content = $row[content];

	$is_html = $row[is_html];
	if($is_html!="y") {
		$item_content = str_replace(" ", "&nbsp;", $item_content); // Change space into entity
		$item_content = str_replace("\n", "<br>", $item_content); // Change enter into <br> tag
	}

	// Increase view
	$new_hit = $item_hit + 1;
	$sql = "update greet set hit=$new_hit where num=$num";
	mysql_query($sql, $connect);
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
	<link rel="stylesheet" href="./css/view.css">
	<script>
		function del(href){
			if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n정말 삭제하시겠습니까?")){
				document.location.href = href;
			};
		};
	</script>
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
			<!-- view_title -->
			<div class="view_title">
				<div id="view_title1"><?= $item_subject ?></div>
				<div id="view_title2">
					<ul>
						<li><?= $item_nick ?> | <?= $item_date ?>
						<li><i class="fas fa-eye"></i> <?= $item_hit ?></li>
					</ul>
				</div>	
			</div>
			<!-- view_content -->
			<div class="view_content">
				<?= $item_content ?>
			</div>
			<!-- view_buttons -->
			<div class="view_buttons">
				<a href="list.php?page=<?=$page?>">목록</a>
				<? 
					if($userid==$item_id || $userlevel==1 || $userid=="admin") { // If user is admin
				?>
						<a href="modify_form.php?num=<?=$num?>&page=<?=$page?>">수정</a>
						<a href="javascript:del('delete.php?num=<?=$num?>')">삭제</a>
				<?
					}

					if($userid) { // If user is logged in
				?>
						<a href="write_form.php" class="write_btn">글쓰기</a>
				<?
					}
				?>
			</div>
		</div>
	</article>

	<? include '../common/sub_footer.html' ?>
</body>
</html>