<? 
	session_start();

    @extract($_GET);
    @extract($_POST);
    @extract($_SESSION);

	include "../lib/dbconn.php";

	$sql = "select * from $table where num=$num";
	$result = mysql_query($sql, $connect);

    $row = mysql_fetch_array($result);
	
	$item_num = $row[num];
	$item_id = $row[id];
	$item_name = $row[name];
  	$item_nick = $row[nick];
	$item_hit = $row[hit];

    $item_date    = $row[regist_day];

	$item_subject = str_replace(" ", "&nbsp;", $row[subject]); // Change space into entity

	$item_content = $row[content];

	$is_html      = $row[is_html];
	if($is_html!="y") {
		$item_content = str_replace(" ", "&nbsp;", $item_content); // Change space into entity
		$item_content = str_replace("\n", "<br>", $item_content); // Change enter into <br> tag
	}

	$image_name[0] = $row[file_name_0];
	$image_name[1] = $row[file_name_1];
	$image_name[2] = $row[file_name_2];

	$image_copied[0] = $row[file_copied_0];
	$image_copied[1] = $row[file_copied_1];
	$image_copied[2] = $row[file_copied_2];
	
	for($i = 0; $i < 3; $i++) {
		if($image_copied[$i]) { // If there are uploaded files
			$imageinfo = GetImageSize("./data/".$image_copied[$i]);
			$image_width[$i] = $imageinfo[0]; // Width of the file
			$image_height[$i] = $imageinfo[1]; // Height of the file
			$image_type[$i]  = $imageinfo[2]; // Type of the file

			if($image_width[$i] > 785) {
				$image_width[$i] = 785;
			}

		} else {
			$image_width[$i] = "";
			$image_height[$i] = "";
			$image_type[$i]  = "";
		}
	}

	// Increase view
	$new_hit = $item_hit + 1;
	$sql = "update $table set hit=$new_hit where num=$num";
	mysql_query($sql, $connect);
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
	<link rel="stylesheet" href="./css/view.css">
	<script>
		function del(href){
			if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")){
				document.location.href = href;
			};
		};
	</script>
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
				<?
					for($i = 0; $i < 3; $i++) { // Show uploaded images
						if($image_copied[$i]) {
							$img_name = "./data/".$image_copied[$i];
							$img_width = $image_width[$i];

							echo "<img src='$img_name' width='$img_width'>"."<br><br>";
						}
					}
				?>
				<?= $item_content ?>
			</div>
			<!-- ripple -->
			<div class="ripple">
				<p>댓글</p>
				<?
					$sql = "select * from $ripple where parent='$item_num'";
					$ripple_result = mysql_query($sql);

					while ($row_ripple = mysql_fetch_array($ripple_result)) {
						$ripple_num = $row_ripple[num];
						$ripple_id = $row_ripple[id];
						$ripple_nick = $row_ripple[nick];
						$ripple_content = str_replace("\n", "<br>", $row_ripple[content]);
						$ripple_content = str_replace(" ", "&nbsp;", $ripple_content);
						$ripple_date = $row_ripple[regist_day];
				?>
						<div class="ripple_item">
							<ul>
								<li><?=$ripple_nick?> | <?=$ripple_date?></li>
								<? 
									if($userid=="admin" || $userid==$ripple_id) {
										echo("
											<li>
												<a href='delete_ripple.php?table=$table&num=$item_num&ripple_num=$ripple_num&ripple=$ripple'>
													<i class='fa fa-trash'></i>
												</a>
											</li>
										");
									}
								?>
							</ul>
							<div class="ripple_content">
								<?=$ripple_content?>
							</div>
						</div>
				<?
					}

					if($userid){ // Let the user writing a comment when they are logged in
				?>		
						<form  name="ripple_form" method="post" action="insert_ripple.php?table=<?=$table?>&num=<?=$item_num?>&ripple=<?=$ripple?>">  
							<div class="ripple_box">
								<textarea rows="3" name="ripple_content"></textarea>
								<button>등록</button>
							</div>
						</form>
				<?
					}
				?>
			</div>
			<!-- view_buttons -->
			<div class="view_buttons">
				<a href="list.php?page=<?=$page?>&viewtype=<?=$viewtype?>">목록</a>
				<?
					if($userid==$item_id || $userlevel==1 || $userid=="admin"){ // If user is admin
				?>
						<a href="write_form.php?table=<?=$table?>&mode=modify&num=<?=$num?>&page=<?=$page?>&viewtype=<?=$viewtype?>">수정</a>
						<a href="javascript:del('delete.php?table=<?=$table?>&num=<?=$num?>&viewtype=<?=$viewtype?>')">삭제</a>
				<?
					}
				?>
				<? 
					if($userid) { // If user is logged in
				?>
						<a href="write_form.php?table=<?=$table?>&viewtype=<?=$viewtype?>" class="write_btn">글쓰기</a>
				<?
					}
				?>
			</div>
		</div>
	</article>

	<? include '../common/sub_footer.html' ?>
</body>
</html>
