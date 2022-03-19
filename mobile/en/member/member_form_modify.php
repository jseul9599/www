<?
	session_start();

    @extract($_GET);
    @extract($_POST);
    @extract($_SESSION);

    include "../lib/dbconn.php";

    $sql = "select * from member where id='$userid'";
    $result = mysql_query($sql, $connect);

    $row = mysql_fetch_array($result);

    $hp = explode("-", $row[hp]);
    $hp1 = $hp[0];
    $hp2 = $hp[1];
    $hp3 = $hp[2];

    $email = explode("@", $row[email]);
    $email1 = $email[0];
    $email2 = $email[1];

    mysql_close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Details</title>
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="./css/member_form.css">

    <script src="../js/jquery-1.12.4.min.js"></script>
    <script src="../js/jquery-migrate-1.4.1.min.js"></script>
    <script src="./js/member_form_modify.js"></script>
</head>
<body>
    <header>
        <h1><a class="logo" href="../index.html">LOTTE FINE CHEMICAL</a></h1>
    </header>

    <article id="content">
        <div class="title_box">
            <h2>My Details</h2>
            <p class="comment"><span>*</span> are required information.</p>
        </div>
        <form  name="member_form" method="post" action="modify.php">
            <ul>
                <li>
                    <label for="id">ID</label>
                    <input type="text" name="id" id="id" value="<?= $row[id] ?>" disabled>
                </li>
                <li>
                    <label for="pass"><span>*</span>Password</label>
                    <input type="password" name="pass" id="pass" required>
                </li>
                <li>
                    <label for="pass_confirm"><span>*</span>Password Confirm</label>
                    <input type="password" name="pass_confirm" id="pass_confirm" required>
                    <div id="loadtext2"></div>
                </li>
                <li>
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="<?= $row[name] ?>" disabled> 
                </li>
                <li>
                    <label for="nick"><span>*</span>Nickname<label>
                    <input type="text" name="nick" id="nick" value="<?= $row[nick] ?>" required>
                    <div id="loadtext3"></div>
                </li>
                <li>
                    <p><span>*</span>Mobile</p>
                    <label class="hidden" for="hp1">The first three digits of your Mobile</label>
                    <select class="hp" name="hp1" id="hp1" value="<?= $hp1 ?>"> 
                        <option value='010'>010</option>
                        <option value='011'>011</option>
                    </select>
                    <span class="space">-</span>
                    <label class="hidden" for="hp2">The second four digits of your Mobile</label>
                    <input type="text" class="hp" name="hp2" id="hp2" maxlength="4" placeholder="(ex. 1111)" value="<?= $hp2 ?>" required>
                    <span class="space">-</span>
                    <label class="hidden" for="hp3">The last four digits of your Mobile</label>
                    <input type="text" class="hp" name="hp3" id="hp3" maxlength="4" placeholder="(ex. 2222)" value="<?= $hp3 ?>" required>
                </li>
                <li>
                    <p>E-mail</p>
                    <label class="hidden" for="email1">E-main ID</label>
                    <input type="text" id="email1" name="email1" value="<?= $email1 ?>" required>
                    <span class="space">@</span>
                    <label class="hidden" for="email2">E-main Address</label>
                    <input type="text" name="email2" id="email2" value="<?= $email2 ?>" required>
                </li>
            </ul>

            <div class="buttons">
                <button type="button" onclick="check_input()">Save</button>
                <button type="button" onclick="reset_form()">Reset</button>
            </div>
        </form>
    </article>
</body>
</html>