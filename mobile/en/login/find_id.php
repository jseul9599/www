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
    <title>Find ID</title>
    <link rel="stylesheet" href="../css/common.css">
	<link rel="stylesheet" href="./css/find_account.css">

    <script src="../js/jquery-1.12.4.min.js"></script>
    <script src="../js/jquery-migrate-1.4.1.min.js"></script>
    <script src="./js/find.js"></script>
</head>
<body>
    <header>
		<h1><a class="logo" href="../index.html">LOTTE FINE CHEMICAL</a></h1>
	</header>

    <article id="content">
        <h2>Find ID</h2>
        <form name="find" method="post" action="find1.php">
            <ul>
                <li>
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" required> 
                </li>
                <li>
                    <p>Mobile</p>
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
                    <button type="button" class="find">Find ID</button>
                </li>
            </ul>
	    </form>

        <div id="loadtext"></div>

        <div class="find_account">
            <p>Forgotten your password?</p>
            <a href="./find_pw.php">Find Password</a>
        </div>
    </article>
</body>
</html>