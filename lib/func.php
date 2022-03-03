<?
	function latest_article($table, $loop, $char_limit) {

		include "dbconn.php";

		$sql = "select * from $table order by num desc limit $loop";
		$result = mysql_query($sql, $connect);

		while ($row = mysql_fetch_array($result)) {
			$num = $row[num];
			$len_subject = mb_strlen($row[subject], 'utf-8'); // The number of letters
			$subject = $row[subject];

			if($len_subject > $char_limit) {
				$subject = mb_substr($subject, 0, $char_limit, 'utf-8');
				$subject = $subject."...";
			}

			$regist_day = substr($row[regist_day], 0, 10);

            if($table=='concert') {
                if($row[file_copied_0]) { // If there is an attached image
                 $concertimg='./concert/data/'.$row[file_copied_0];
                } else {
                 $concertimg= './concert/data/default.jpg';
                }
            }

			if($table=='concert') {
				echo("
					<li class='news_item'>
						<a href='./$table/view.php?table=$table&num=$num&ripple=free_ripple'>
							<div class='news_img'>
								<img src='$concertimg' alt='$subject'>
								<span>NEWS</span>
							</div>
							<p>$subject<span>$regist_day</span></p>
						</a>
					</li>
				");
			}
		}
		mysql_close();
	}

?>