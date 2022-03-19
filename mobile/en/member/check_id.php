<?
    @extract($_GET);
    @extract($_POST);
    @extract($_SESSION);

    if(!$id) { // If ID input is empty
        echo("Type in your ID.");
        
    } else { // If ID input is not empty
        if(preg_match("/^[a-z0-9]+$/", $id) != 1) { //But when the value includes letters apart from a-z, 0-9
            echo "<span style='color:red' class='fail'>You can use only english and numbers.</span>";

        } else {
            include "../lib/dbconn.php";

            $sql = "select * from member where id='$id' ";
            $result = mysql_query($sql, $connect);

            $num_record = mysql_num_rows($result);

            if($num_record) {
                echo "<span style='color:red' class='fail'>The ID already exists. Type in again.</span>";
            } else {
                echo "<span style='color:green'>You can use the ID.</span>";
            }

            mysql_close();
        }
    }

?>

