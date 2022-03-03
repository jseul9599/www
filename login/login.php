<?
    session_start();

    @extract($_GET);
    @extract($_POST);
    @extract($_SESSION);

    // If ID input is empty
    if(!$id) {
        echo("
            <script>
                window.alert('아이디를 입력하세요.');
                history.go(-1);
            </script>
        ");
        exit;
    }

    // If password input is empty
    if(!$pass) {
        echo("
            <script>
                window.alert('비밀번호를 입력하세요.');
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
                window.alert('등록되지 않은 아이디입니다.');
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
                    window.alert('비밀번호가 일치하지 않습니다.');
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
                    alert('".$row[nick]."님 반갑습니다!');
                    location.href = '../index.html';
                </script>
            ");
        }
    }
  
?>
