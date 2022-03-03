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
				console.log('aaa')
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

	$files = $_FILES["upfile"];

	$count = count($files["name"]); // The number of uploaded files

	$upload_dir = './data/';

	for($i = 0; $i < $count; $i++) {
		$upfile_name[$i]  = $files["name"][$i]; // Ex) a1.jpg
		$upfile_tmp_name[$i] = $files["tmp_name"][$i];
		$upfile_type[$i]  = $files["type"][$i]; 
		$upfile_size[$i] = $files["size"][$i];
		$upfile_error[$i] = $files["error"][$i];
      
		$file = explode(".", $upfile_name[$i]);
		$file_name = $file[0]; // Ex) a1
		$file_ext  = $file[1]; // Ex) jpg

		// If there isn't any error
		if(!$upfile_error[$i]) {
			$new_file_name = date("Y_m_d_H_i_s"); // Ex) 2022_02_22_10_30_15
			$new_file_name = $new_file_name."_".$i; // Ex) 2022_02_22_10_30_15_0
			$copied_file_name[$i] = $new_file_name.".".$file_ext; // Ex) 2022_02_22_10_30_15_0.jpg
			$uploaded_file[$i] = $upload_dir.$copied_file_name[$i]; // Ex) ./data/2022_02_22_10_30_15_0.jpg

			// But when the file is bigger than 500KB
			if($upfile_size[$i] > 500000) {
				echo("
					<script>
						alert('업로드 파일 크기가 지정된 용량(500KB)을 초과합니다! 파일 크기를 체크해주세요!');
						history.go(-1)
					</script>
				");
				exit;
			}

			 // But when the file isn't JPG / GIF / PNG
			if(($upfile_type[$i] != "image/gif") && ($upfile_type[$i] != "image/jpeg") && ($upfile_type[$i] != "image/pjpeg") && ($upfile_type[$i] != "image/png") && ($upfile_type[$i] != "image/x-png")) {
				echo("
					<script>
						alert('JPG, GIF, PNG 이미지 파일만 업로드 가능합니다!');
						history.go(-1)
					</script>
				");
				exit;
			}

			// But when uploading doesn't work well
			if(!move_uploaded_file($upfile_tmp_name[$i], $uploaded_file[$i])) {
				echo("
					<script>
						alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
						history.go(-1)
					</script>
				");
				exit;
			}
		}
	}

	include "../lib/dbconn.php";

	if($mode=="modify") { // If user modifies the posting
		$num_checked = count($_POST['del_file']);
		$position = $_POST['del_file'];

		for($i=0; $i<$num_checked; $i++) {                     // delete checked item
			$index = $position[$i];
			$del_ok[$index] = "y";
		}

		$sql = "select * from $table where num=$num";   // get target record
		$result = mysql_query($sql);

		$row = mysql_fetch_array($result);

		for($i=0; $i<$count; $i++) {				// update DB with the value of file input box
			$field_org_name = "file_name_".$i;
			$field_real_name = "file_copied_".$i;

			$org_name_value = $upfile_name[$i];
			$org_real_value = $copied_file_name[$i];
			if ($del_ok[$i] == "y") {
				$delete_field = "file_copied_".$i;
				$delete_name = $row[$delete_field];
				
				$delete_path = "./data/".$delete_name;

				unlink($delete_path);

				$sql = "update $table set $field_org_name = '$org_name_value', $field_real_name = '$org_real_value'  where num=$num";
				mysql_query($sql, $connect);

			} else {
				if(!$upfile_error[$i]) {
					$sql = "update $table set $field_org_name = '$org_name_value', $field_real_name = '$org_real_value'  where num=$num";
					mysql_query($sql, $connect);
				}
			}

		}
		
		// "(&quot;) '(&#039;) &(&amp;) <(&lt;) >(&gt;)
		$subject = htmlspecialchars($subject);
		$content = htmlspecialchars($content);
		$subject = str_replace("'", "&#039;", $subject);
		$content = str_replace("'", "&#039;", $content);
		
		$sql = "update $table set subject='$subject', content='$content' where num=$num";
		mysql_query($sql, $connect);
		
	} else { // If user writes a new posting
		if ($html_ok=="y") {
			$is_html = "y";
		} else {
			$is_html = "";
		}
		
		// "(&quot;) '(&#039;) &(&amp;) <(&lt;) >(&gt;)
		$subject = htmlspecialchars($subject);
		$content = htmlspecialchars($content);
		$subject = str_replace("'", "&#039;", $subject);
		$content = str_replace("'", "&#039;", $content);

		$sql = "insert into $table (id, name, nick, subject, content, regist_day, hit, is_html, file_name_0, file_name_1, file_name_2, file_copied_0,  file_copied_1, file_copied_2)";
		$sql .= "values('$userid', '$username', '$usernick', '$subject', '$content', '$regist_day', 0, '$is_html', '$upfile_name[0]', '$upfile_name[1]',  '$upfile_name[2]', '$copied_file_name[0]', '$copied_file_name[1]','$copied_file_name[2]')";
		mysql_query($sql, $connect);
	}

	mysql_close();

	echo("
		<script>
			location.href = 'list.php?table=$table&page=$page&viewtype=$viewtype';
		</script>
	");
?>

  
