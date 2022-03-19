<?
	session_start();

    @extract($_GET);
    @extract($_POST);
    @extract($_SESSION);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Join</title>
	<link rel="stylesheet" href="../css/common.css">
	<link rel="stylesheet" href="./css/member_form.css">
	
	<script src="../js/jquery-1.12.4.min.js"></script>
    <script src="../js/jquery-migrate-1.4.1.min.js"></script>
    <script src="./js/member_form_redundancy.js"></script>
    <script src="./js/member_form.js"></script>
</head>
<body>
    <header>
        <h1><a class="logo" href="../index.html">LOTTE FINE CHEMICAL</a></h1>
    </header>
	 
	<article id="content">
        <div class="title_box">
            <h2>Join</h2>
            <p class="comment"><span>*</span> are required information.</p>
        </div>
        <form  name="member_form" method="post" action="insert.php">
            <ul>
                <li>
                    <label for="id"><span>*</span>ID</label>
                    <input type="text" name="id" id="id" placeholder="Only english and numbers" required>
                    <div id="loadtext1"></div>
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
                    <label for="name"><span>*</span>Name</label>
                    <input type="text" name="name" id="name" required> 
                </li>
                <li>
                    <label for="nick"><span>*</span>Nickname<label>
                    <input type="text" name="nick" id="nick" required>
                    <div id="loadtext3"></div>
                </li>
                <li>
                    <p><span>*</span>Mobile</p>
                    <label class="hidden" for="hp1">The first three digits of your Mobile</label>
                    <select class="hp" name="hp1" id="hp1"> 
                        <option value='010'>010</option>
                        <option value='011'>011</option>
                    </select>
                    <span class="space">-</span>
                    <label class="hidden" for="hp2">The second four digits of your Mobile</label>
                    <input type="text" class="hp" name="hp2" id="hp2" maxlength="4" placeholder="(ex. 1111)" required>
                    <span class="space">-</span>
                    <label class="hidden" for="hp3">The last four digits of your Mobile</label>
                    <input type="text" class="hp" name="hp3" id="hp3" maxlength="4" placeholder="(ex. 2222)" required>
                </li>
                <li>
                    <p>E-mail</p>
                    <label class="hidden" for="email1">E-main ID</label>
                    <input type="text" id="email1" name="email1" required>
                    <span class="space">@</span>
                    <label class="hidden" for="email2">E-main Address</label>
                    <input type="text" name="email2" id="email2" required>
                </li>
            </ul>

            <div class="buttons">
                <button type="button" onclick="check_input()">Join</button>
                <button type="button" onclick="reset_form()">Reset</button>
            </div>
        </form>
	</article>
</body>
</html>
