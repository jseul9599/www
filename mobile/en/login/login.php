<?
    session_start();

    @extract($_GET);
    @extract($_POST);
    @extract($_SESSION);

    // If ID input is empty
    if(!$id) {
        echo("
            <script>
                window.alert('Type in your ID.');
                history.go(-1);
            </script>
        ");
        exit;
    }

    // If password input is empty
    if(!$pass) {
        echo("
            <script>
                window.alert('Type in your password.');
                history.go(-1);
            </script>
        ");
        exit;
    }

    // If ID and password inputs are not empty
    include "../lib/dbconn.php";

    $sql = "select * from member where id='$id'";
    $result = mysql_query($sql, $connect);

    $num_match = mysql_num_rows($result);

    if(!$num_match) { // If ID doesn't exist in the DB
        echo("
            <script>
                window.alert('We have no registered ID.');
                history.go(-1);
            </script>
        ");

    } else { // If ID exists in the DB
        $sql ="select * from member where id='$id' and pass=password('$pass')";
        $result = mysql_query($sql, $connect);

        $num_match = mysql_num_rows($result);

        if(!$num_match) { //But when the password isn't correct
            echo("
                <script>
                    window.alert('The password you entered is wrong.');
                    history.go(-1);
                </script>
            ");
            exit;

        } else { // When the password is correct

            $row = mysql_fetch_array($result); 
            $_SESSION['userid'] = $row[id];
            $_SESSION['username'] = $row[name];
            $_SESSION['usernick'] = $row[nick];
            $_SESSION['userlevel'] = $row[level];
            
            echo("
                <script>
                    alert('Hello, ".$row[nick]."');
                    location.href = '../index.html';
                </script>
            ");
        }
    }
  
?>
