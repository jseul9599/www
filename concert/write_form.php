<? 
	session_start();

    @extract($_GET);
    @extract($_POST);
    @extract($_SESSION);

	include "../lib/dbconn.php";

	if($mode=="modify") {
		$sql = "select * from $table where num=$num";
		$result = mysql_query($sql, $connect);

		$row = mysql_fetch_array($result);       
	
		$item_subject     = $row[subject];
		$item_content     = $row[content];

		$item_file_0 = $row[file_name_0];
		$item_file_1 = $row[file_name_1];
		$item_file_2 = $row[file_name_2];

		$copied_file_0 = $row[file_copied_0];
		$copied_file_1 = $row[file_copied_1];
		$copied_file_2 = $row[file_copied_2];
	}
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
	<link rel="stylesheet" href="./css/write_form.css">
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
			<!-- write_title -->
			<?
				if($mode=="modify") {
			?>
					<div class="write_title">수정하기</div>
			<?
				} else {
			?>
					<div class="write_title">글쓰기</div>
			<?
				}
			?>
			<!-- write_content -->
			<div class="write_content">
				<?
					if($mode=="modify") {
				?>
						<form  name="board_form" method="post" action="insert.php?mode=modify&num=<?=$num?>&page=<?=$page?>&table=<?=$table?>&viewtype=<?=$viewtype?>" enctype="multipart/form-data"> 
				<?
					} else {
				?>
						<form  name="board_form" method="post" action="insert.php?table=<?=$table?>&viewtype=<?=$viewtype?>" enctype="multipart/form-data"> 
				<?
					}
				?>
					<!-- write_form -->
					<div class="write_form">
						<ul id="write_row1">
							<li>작성자</li>
							<li><?=$usernick?></li>
							<?
								if($userid && ($mode != "modify")) { // If user writes a new posting
							?>
									<li><input type="checkbox" name="html_ok" value="y"> HTML 쓰기</li>
							<?
								}
							?>
						</ul>
						<ul id="write_row2">
							<li>제목</li>
							<li><input type="text" name="subject" value="<?=$item_subject?>"></li>
						</ul>
						<ul id="write_row3">
							<li>내용</li>
							<li><textarea rows="15" name="content"><?=$item_content?></textarea></li>
						</ul>
						<ul id="write_row4">
							<li>이미지파일1</li>
							<li><input type="file" name="upfile[]"></li>
							<li>
								<?
									if($mode=="modify" && $item_file_0) {
								?>
										<div class="delete_ok">
											<?=$item_file_0?> 파일이 등록되어 있습니다.
											<input type="checkbox" name="del_file[]" value="0"> 삭제
										</div>
								<?
									}
								?>
							</li>
						</ul>
						<ul id="write_row5">
							<li>이미지파일2</li>
							<li><input type="file" name="upfile[]"></li>
							<li>
								<?
									if($mode=="modify" && $item_file_1) {
								?>
										<div class="delete_ok">
											<?=$item_file_1?> 파일이 등록되어 있습니다.
											<input type="checkbox" name="del_file[]" value="1"> 삭제
										</div>
								<?
									}
								?>
							</li>
						</ul>
						<ul id="write_row6">
							<li>이미지파일3</li>
							<li><input type="file" name="upfile[]"></li>
							<li>
								<?
									if($mode=="modify" && $item_file_2) {
								?>
										<div class="delete_ok"><?=$item_file_2?> 파일이 등록되어 있습니다. <input type="checkbox" name="del_file[]" value="2"> 삭제</div>
										<div class="clear"></div>
								<?
									}
								?>
							</li>
						</ul>
					</div>
					<!-- write_buttons -->
					<div class="write_buttons">
						<button>완료</button>
						<a href="list.php?page=<?=$page?>&viewtype=<?=$viewtype?>">목록</a>
					</div>
				</form>
			</div>
		</div>
	</article>

	<? include '../common/sub_footer.html' ?>
</body>
</html>
