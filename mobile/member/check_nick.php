<?
    @extract($_GET);
    @extract($_POST);
    @extract($_SESSION);

    if(!$nick) { // If nick input is empty
        echo("닉네임을 입력하세요.");
        
    }else { // If nick input is not empty
        include "../lib/dbconn.php";

        $sql = "select * from member where nick='$nick' ";
        $result = mysql_query($sql, $connect);

        $num_record = mysql_num_rows($result);

        if($num_record) {
            echo "<span style='color:red' class='fail'>해당 닉네임이 존재합니다. 다시 입력해주세요.</span>";
        } else {
            echo "<span style='color:green'>사용가능한 닉네입니다.</span>";
        }

        mysql_close();
    }

?>

