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
	<link rel="stylesheet" href="./css/list.css">
	<?
		include "../lib/dbconn.php";

		if($mode=="search") {
			if(!$search) {
				echo("
					<script>
						window.alert('검색할 단어를 입력해 주세요!');
						history.go(-1);
					</script>
				");
				exit;
			}
	
			$sql = "select * from greet where $find like '%$search%' order by num desc";
	
		} else {
			$sql = "select * from greet order by num desc";
		}
	
		$result = mysql_query($sql, $connect);
	
		$total_record = mysql_num_rows($result);
	
		// The number of postings on each page
		if(!$scale) {
			$scale = 10;
		}
	
		// The number of pages
		if($total_record % $scale == 0) {
			$total_page = floor($total_record/$scale);
		} else {
			$total_page = floor($total_record/$scale) + 1;
		}
	
		if(!$page) {
			$page = 1;
		}
	
		// Start number on $total_record
		$start = ($page - 1) * $scale;
	
		// Number on the board
		$number = $total_record - $start;
	?>
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
			<p>롯데정밀화학의 잠재력은 무한합니다</p>
		</div>
		<!-- content_area -->
		<div class="content_area">
			<!-- list_search -->
			<form name="board_form" method="post" action="list.php?mode=search">
				<div class="list_search">
					<ul>
						<li>
							<select name="find">
								<option value='subject'>제목</option>
								<option value='content'>내용</option>
								<option value='nick'>작성자</option>
							</select>
						</li>
						<li>
							<input type="text" name="search">
						</li>
						<li>
							<button>검색</button>
						</li>
					</ul>
				</div>
			</form>
			<!-- list_view -->
			<div class="list_view">
				<div>Total <?= $total_record ?> (Page <?= $page ?> of <?= $total_page ?>)</div>
				<div class="list_view_sort">
					<select name="scale" onchange="location.href='list.php?scale='+this.value">
						<option value=''>보기</option>
						<option value='5'>5개씩</option>
						<option value='10'>10개씩</option>
						<option value='15'>15개씩</option>
						<option value='20'>20개씩</option>
					</select>
				</div>
			</div>
			<!-- list_header -->
			<div class="list_header">
				<ul>
					<li id="list_header1">No.</li>
					<li id="list_header2">제목</li>
					<li id="list_header3">작성자</li>
					<li id="list_header4">작성일</li>
					<li id="list_header5">조회</li>
				</ul>		
			</div>
			<!-- list_content -->
			<div class="list_content">
				<?
					for($i = $start; $i < $start + $scale && $i < $total_record; $i++) {
						mysql_data_seek($result, $i);
						$row = mysql_fetch_array($result);
						
						$item_num = $row[num];
						$item_id = $row[id];
						$item_name = $row[name];
						$item_nick = $row[nick];
						$item_hit = $row[hit];
						
						$item_date = $row[regist_day];
						$item_date = substr($item_date, 0, 10);

						$replace_search = array(" ", "[신입]", "[경력]");
						$replace_target = array("&nbsp;", "<span class='junior'>신입</span>", "<span class='senior'>경력</span>");
						$item_subject = str_replace($replace_search, $replace_target, $row[subject]);
				?>
						<ul>
							<li id="list_item1"><?= $number ?></li>
							<li id="list_item2">
								<a href="view.php?num=<?=$item_num?>&page=<?=$page?>">
									<?= $item_subject ?>
								</a>
							</li>
							<li id="list_item3"><?= $item_nick ?></li>
							<li id="list_item4"><?= $item_date ?></li>
							<li id="list_item5"><?= $item_hit ?></li>
						</ul>
				<?
						$number--;
					}
				?>
			</div>
			<!-- list_footer -->
			<div class="list_footer">
				<div id="page_num">
					<span><i class="fas fa-angle-left"></i></span>
					<?
						for($i = 1; $i <= $total_page; $i++) {
							if($page == $i) {
								echo "<b>$i</b>";
							} else {
								if($mode=="search") {
									echo "<a href='list.php?page=$i&scale=$scale&mode=search&find=$find&search=$search'>$i</a>";
								} else {
									echo "<a href='list.php?page=$i&scale=$scale'>$i</a>";
								}
							}
						}
					?>
					<span><i class="fas fa-angle-right"></i></span>
				</div>
				<div id="page_buttons">
					<a href="list.php?page=<?=$page?>">목록</a>
					<? 
						if($userid) {
					?>
							<a href="write_form.php" class="write_btn">글쓰기</a>
					<?
						}
					?>
				</div>
			</div>
		</div>
	</article>

	<? include '../common/sub_footer.html' ?>
</body>
</html>
