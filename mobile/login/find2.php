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
            </script>
        ");
        exit;
    }

    //If name input is empty
   if(!$name) {
        echo("
            <script>
                window.alert('이름을 입력하세요.');
            </script>
        ");
        exit;
    }

    // If hp inputs are empty
    if(!($hp2 && $hp3)) {
        echo("
            <script>
                window.alert('연락처를 입력하세요.');
            </script>
        ");
        exit;
    }

    // If ID, name and hp inputs are not empty
    include "../lib/dbconn.php";

    $sql = "select * from member where id='$id'";
    $result = mysql_query($sql, $connect);

    $num_match = mysql_num_rows($result);

    if(!$num_match) { // If ID doesn't exist in the DB
        echo(" 
            <script>
                window.alert('등록되지 않은 아이디 입니다.');
            </script>
        ");
        exit;

    } else { // If ID exists in the DB
        $hp = $hp1."-".$hp2."-".$hp3;

        $sql ="select * from member where id='$id' and name='$name' and hp='$hp'";
        $result = mysql_query($sql, $connect);

        $num_match = mysql_num_rows($result);

        if(!$num_match) { //But when name and hp aren't correct
            echo("
                <script>
                    window.alert('등록된 정보가 없습니다.');
                </script>
            ");
            exit;

        } else { //When name and hp are correct
            // Generate Random password
            function generateRandomPassword($length=8, $strength=0) {
                $vowels = 'aeuy';
                $consonants = 'bdghjmnpqrstvz6789';
                if($strength & 1) {
                    $consonants .= 'BDGHJLMNPQRSTVWXZ12345';
                }

                $password = '';
                $alt = time() % 2;
                for ($i = 0; $i < $length; $i++) {
                    if ($alt == 1) {
                        $password .= $consonants[(rand() % strlen($consonants))];
                        $alt = 0;
                    } else {
                        $password .= $vowels[(rand() % strlen($vowels))];
                        $alt = 1;
                    }
                }
                return $password;
            }

            $ranpass = generateRandomPassword(8,1);

            $row = mysql_fetch_array($result);
            $userid = $row[id];
            $username = $row[name];

            echo $userid."($username)님의 임시 비밀번호는 <strong>$ranpass</strong> 입니다.<br>로그인 후 비밀번호를 변경해 주세요.";

            // Change password into the temporary password
            $sql = "update member set pass=password('$ranpass') where id='$id' and name='$name' and hp='$hp'";
            $result = mysql_query($sql, $connect);
        }
    }

?>
