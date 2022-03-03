<?
    session_start();

    @extract($_GET);
    @extract($_POST);
    @extract($_SESSION);
?>
<meta charset="utf-8">
<?
	if(!$userid) {
		echo("
			<script>
				window.alert('로그인 후 이용해 주세요.')
				history.go(-1)
			</script>
		");
		exit;
	}

	if(!$subject) {
		echo("
			<script>
				window.alert('제목을 입력하세요.')
				history.go(-1)
			</script>
		");
	 	exit;
	}

	if(!$content) {
		echo("
			<script>
				window.alert('내용을 입력하세요.')
				history.go(-1)
			</script>
		");
	 	exit;
	}

	// Current date and time
	$regist_day = date("Y-m-d (H:i)");

	include "../lib/dbconn.php";

	if($mode=="modify") { // If user modifies the posting
        $subject = htmlspecialchars($subject);
		$content = htmlspecialchars($content);

		$sql = "update greet set subject='$subject', content='$content' where num=$num";
		
	} else { // If user writes a new posting
		if($html_ok=="y") {
			$is_html = "y";
		} else {
			$is_html = "";
		}
		
		// "(&quot;) '(&#039;) &(&amp;) <(&lt;) >(&gt;)
		$subject = htmlspecialchars($subject);
		$content = htmlspecialchars($content);

		$sql = "insert into greet (id, name, nick, subject, content, regist_day, hit, is_html) values('$userid', '$username', '$usernick', '$subject', '$content', '$regist_day', 0, '$is_html')";
	}

	mysql_query($sql, $connect);

	mysql_close();

	echo("
		<script>
			location.href = 'list.php?page=$page';
		</script>
	");
?>

  
