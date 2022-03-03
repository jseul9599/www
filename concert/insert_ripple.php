<?
    session_start();
?>
<meta charset="utf-8">
<?
    @extract($_GET);
    @extract($_POST);
    @extract($_SESSION);

    if(!$userid) {
        echo("
            <script>
                window.alert('로그인 후 이용하세요.')
                history.go(-1)
            </script>
        ");
        exit;
    }

    if(!$ripple_content) {
		echo("
			<script>
				window.alert('내용을 입력하세요.')
				history.go(-1)
			</script>
		");
	 	exit;
	}

    include "../lib/dbconn.php";

    $regist_day = date("Y-m-d (H:i)");

    $sql = "insert into $ripple (parent, id, name, nick, content, regist_day) values($num, '$userid', '$username', '$usernick', '$ripple_content', '$regist_day')";  
    mysql_query($sql, $connect);

    mysql_close();

    echo("
        <script>
            location.href = 'view.php?table=$table&num=$num&ripple=$ripple';
        </script>
    ");
?>

   
