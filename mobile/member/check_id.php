<?
    @extract($_GET);
    @extract($_POST);
    @extract($_SESSION);

    if(!$id) { // If ID input is empty
        echo("아이디를 입력하세요.");
        
    } else { // If ID input is not empty
        if(preg_match("/^[a-z0-9]+$/", $id) != 1) { //But when the value includes letters apart from a-z, 0-9
            echo "<span style='color:red' class='fail'>아이디에는 영문과 숫자만 사용가능합니다.</span>";

        } else {
            include "../lib/dbconn.php";

            $sql = "select * from member where id='$id' ";
            $result = mysql_query($sql, $connect);

            $num_record = mysql_num_rows($result);

            if($num_record) {
                echo "<span style='color:red' class='fail'>해당 아이디가 존재합니다. 다시 입력해주세요.</span>";
            } else {
                echo "<span style='color:green'>사용가능한 아이디입니다.</span>";
            }

            mysql_close();
        }
    }

?>

