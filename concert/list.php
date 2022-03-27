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
	<title>홍보센터 - 회사소식</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
	<link rel="stylesheet" href="../common/css/common.css">
	<link rel="stylesheet" href="../sub4/common/css/sub4common.css">
	<link rel="stylesheet" href="./css/list.css">
	<?
		$table = "concert";
		$ripple = "free_ripple";

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
	
			$sql = "select * from $table where $find like '%$search%' order by num desc";
		
		} else {
			$sql = "select * from $table order by num desc";
		}
	
		$result = mysql_query($sql, $connect);
	
		$total_record = mysql_num_rows($result);
	
		// The number of postings on each page
		if(!$scale) {
			$scale = 6;
		}
	
		// The number of pages
		if ($total_record % $scale == 0) {
			$total_page = floor($total_record/$scale);
		} else {
			$total_page = floor($total_record/$scale) + 1;
		}
	
		if (!$page) {
			$page = 1;
		}
	
		// Start number on $total_record
		$start = ($page - 1) * $scale;
	
		// Number on the board  
		$number = $total_record - $start;
	
		if(!$viewtype) {
			$viewtype = "listview";
		}
	?>
</head>
<body>
	<? include '../common/sub_header.html' ?>

	<div class="visual">
		<p>
			<span>P</span>
			<span>R</span>
			<span>C</span>
			<span>E</span>
			<span>N</span>
			<span>T</span>
			<span>E</span>
			<span>R</span>
		</p>
		<h3>홍보센터</h3>
	</div>

	<div class="sub_menu">
		<ul>
			<li class="current"><a href="./list.php">회사소식</a></li>
			<li><a href="../sub4/sub4_2.html">PR자료실</a></li>
			<li><a href="../sub4/sub4_3.html">온라인 신문고</a></li>
			<li><a href="../sub4/sub4_4.html">담당자 안내</a></li>
		</ul>
	</div>

	<article id="content">
		<div class="title_area">
			<div class="line_map">
				<i class="fas fa-home"></i>
				<span>홍보센터</span>
				<strong>회사소식</strong>
			</div>
			<h2>회사소식</h2>
			<p>롯데정밀화학이 화학으로 이로워지는 세상을 만들어갑니다</p>
		</div>
		<!-- content_area -->
		<div class="content_area">
			<!-- list_search -->
			<form name="board_form" method="post" action="list.php?table=<?=$table?>&mode=search&viewtype=<?=$viewtype?>"> 
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
					<?
						if($viewtype=='listview') {
					?>
							<a href="./list.php?viewtype=listview" class="listview active"><i class="fas fa-list"></i></a>
							<a href="./list.php?viewtype=gridview" class="gridview"><i class="fas fa-th"></i></a>
					<?
						} else if($viewtype=='gridview') {
					?>
							<a href="./list.php?viewtype=listview" class="listview"><i class="fas fa-list"></i></a>
							<a href="./list.php?viewtype=gridview" class="gridview active"><i class="fas fa-th"></i></a>
					<?
						}
					?>
					<select name="scale" onchange="location.href='list.php?scale='+this.value+'&viewtype=<?=$viewtype?>'">
						<option value=''>보기</option>
						<option value='6'>6개씩</option>
						<option value='9'>9개씩</option>
						<option value='12'>12개씩</option>
						<option value='15'>15개씩</option>
					</select>
				</div>
			</div>

			<div class="list_content">
				<?
					if($viewtype=='listview') {
				?>
						<ul class="listview_ul">
				<?
					} else if($viewtype=='gridview') {
				?>
						<ul class="gridview_ul">
				<?
					}
				?>
					<?		
						for($i = $start; $i < $start + $scale && $i < $total_record; $i++) {
							mysql_data_seek($result, $i);
							$row = mysql_fetch_array($result);
							
							$item_num = $row[num];
							$item_id = $row[id];
							$item_name = $row[name];
							$item_nick = $row[nick];
							$item_hit = $row[hit];

							$item_date    = $row[regist_day];
							$item_date = substr($item_date, 0, 10);

							$item_subject = str_replace(" ", "&nbsp;", $row[subject]); // Change space into entity

							$item_content = $row[content];

							// If there is the first attached image file
							if($row[file_copied_0]) { 
								$item_img = './data/'.$row[file_copied_0];  
							} else {
								$item_img = './data/default.jpg';
							}

							// Ripple
							$sql = "select * from $ripple where parent=$item_num";
							$result2 = mysql_query($sql, $connect);
							$num_ripple = mysql_num_rows($result2);
					?>
							<li>
								<a href="view.php?table=<?=$table?>&num=<?=$item_num?>&page=<?=$page?>&viewtype=<?=$viewtype?>&ripple=<?=$ripple?>">
									<div class="news_img"><img src="<?=$item_img?>" alt="news image"></div>
									<dl>
										<dt><?= $item_subject ?></dt>
										<dd><?= $item_content ?></dd>
										<dd>
											<span><?= $item_date ?></span>
											<span><i class="fas fa-eye"></i> <?= $item_hit ?></span>
											<? if($num_ripple){echo "<span><i class='fas fa-comment-dots'></i> $num_ripple</span>";} ?>
										</dd>
									</dl>
								</a>
							</li>
					<?
							$number--;
						}
					?>
				</ul>
			</div>
			<!-- list_footer -->
			<div class="list_footer">
				<div id="page_num">
					<span><i class="fas fa-angle-left"></i></span>
					<?
						for($i = 1; $i <= $total_page; $i++) {
							if ($page == $i) {
								echo "<b>$i</b>";
							} else {
								if($mode=="search") {
									echo "<a href='list.php?page=$i&scale=$scale&mode=search&find=$find&search=$search&viewtype=$viewtype'>$i</a>";
								} else {
									echo "<a href='list.php?page=$i&scale=$scale&viewtype=$viewtype'>$i</a>";
								}
							}      
						}
					?>			
					<span><i class="fas fa-angle-right"></i></span>
				</div>
				<div id="page_buttons">
					<a href="list.php?page=<?=$page?>&viewtype=<?=$viewtype?>">목록</a>
					<? 
						if($userid) {
					?>
							<a href="write_form.php?table=<?=$table?>&viewtype=<?=$viewtype?>" class="write_btn">글쓰기</a>
					<?
						}
					?>
				</div>
			</div>
		</div>
	</article>

    <? include "../common/sub_footer.html" ?>
</body>
</html>
