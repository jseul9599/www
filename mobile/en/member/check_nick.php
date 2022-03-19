<?
    @extract($_GET);
    @extract($_POST);
    @extract($_SESSION);

    if(!$nick) { // If nick input is empty
        echo("Type in your nickname.");
        
    }else { // If nick input is not empty
        include "../lib/dbconn.php";

        $sql = "select * from member where nick='$nick' ";
        $result = mysql_query($sql, $connect);

        $num_record = mysql_num_rows($result);

        if($num_record) {
            echo "<span style='color:red' class='fail'>The nickname already exists. Type in again.</span>";
        } else {
            echo "<span style='color:green'>You can use the nickname.</span>";
        }

        mysql_close();
    }

?>

