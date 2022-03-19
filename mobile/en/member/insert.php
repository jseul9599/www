<meta charset="utf-8">
<?
    @extract($_GET);
    @extract($_POST);
    @extract($_SESSION);

    $hp = $hp1."-".$hp2."-".$hp3;
    $email = $email1."@".$email2;
    $regist_day = date("Y-m-d (H:i)");

    // If all inputs are not empty
    include "../lib/dbconn.php";

    $sql = "select * from member where id='$id'";
    $result = mysql_query($sql, $connect);

    $exist_id = mysql_num_rows($result);

    if($exist_id) { // If ID already exists in the DB
        echo("
            <script>
                window.alert('The ID already exists. Type in again.');
                history.go(-1);
            </script>
        ");
        exit;

    } else { // If ID doesn't exist in the DB
        if(preg_match("/^[a-z0-9]+$/", $id) != 1){ // But when ID value includes letters apart from a-z, 0-9
            echo("
                <script>
                    alert('You can use only english and numbers. Type in again.');
                    history.go(-1);
                </script>
            ");
            exit;
        }

        // Add it to the DB
        $sql = "insert into member(id, pass, name, nick, hp, email, regist_day, level) values('$id', password('$pass'), '$name', '$nick', '$hp', '$email', '$regist_day', 9)";
        mysql_query($sql, $connect);
    }

    mysql_close();

    echo("
        <script>
            alert('Welcome to Lotte Fine Chemical!');
            location.href = '../login/login_form.php';
        </script>
    ");

?>

   
   
   
   
   
   
   
