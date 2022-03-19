<?
    session_start();

    @extract($_GET);
    @extract($_POST);
    @extract($_SESSION);

    // If name input is empty
    if(!$name) {
        echo("
            <script>
                window.alert('Type in your name.');
            </script>
        ");
        exit;
    }

    // If hp inputs are empty
    if(!($hp2 && $hp3)) {
        echo("
            <script>
                window.alert('Type in your mobile.');
            </script>
        ");
        exit;
    }

    // If name and hp inputs are not empty
    include "../lib/dbconn.php";

    $sql = "select * from member where name='$name'";
    $result = mysql_query($sql, $connect);

    $num_match = mysql_num_rows($result);

    if(!$num_match) { // If name doesn't exist in the DB
        echo(" 
            <script>
                window.alert('We have no registered information.');
            </script>
        ");
        exit;

    } else { // If name exists in the DB
        $hp = $hp1."-".$hp2."-".$hp3;

        $sql ="select * from member where name='$name' and hp='$hp'";
        $result = mysql_query($sql, $connect);

        $num_match = mysql_num_rows($result);

        if(!$num_match) { //But when hp isn't correct
            echo("
                <script>
                    window.alert('We have no registered information.');
                </script>
            ");
            exit;

        } else { // When hp is correct
            $row = mysql_fetch_array($result);
            $userid = $row[id];
            $username = $row[name];

            echo $username.", your ID is <strong>$userid</strong> 입니다.";
        }
    }          
?>
