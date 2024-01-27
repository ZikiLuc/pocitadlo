<head>
<meta http-equiv="Content-Security-Policy" content="frame-src *">

<title>Počítadlo</title>
	<style>
		body {
			background-repeat: no-repeat;
			background-size: cover;
			background-position: center center;
			background-color: rgba(0, 0, 0, 0.5);
			font-family: Arial, sans-serif;
		}

		.background {
			background-image: url('https://cdn.pixabay.com/photo/2016/11/29/01/16/abacus-1866497_1280.jpg');
			opacity: 0.3;
		}

		form {
			width: 510px;
			margin: 0 auto;
			background-color: #fff;
			padding: 20px;
			border-radius: 5px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
		}

		label {
			display: block;
			margin-bottom: 10px;
			font-weight: bold;
			color: #555;
		}

		input[type="number"],
		input[type="text"] {
			padding: 10px;
			border: 1px solid #ccc;
			border-radius: 5px;
			width: 100%;
			margin-bottom: 20px;
			box-sizing: border-box;
			font-size: 16px;
			color: #555;
		}

		input[type="submit"] {
			padding: 10px 20px;
			background-color: #007bff;
			color: #fff;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			transition: all 0.3s ease;
			font-size: 16px;
		}
.login {
			padding: 10px 20px;
			background-color: #007bff;
			color: #fff;
            right:2px;
            text-align:right;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			transition: all 0.3s ease;
			font-size: 16px;
		}
		input[type="submit"]:hover, .login:hover {
			background-color: #0062cc;
		}

		h1 {
			text-align: center;
			color: #fff;
			margin-top: 50px;
			font-size: 36px;
			text-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
		}

		table {
			margin-top: 30px;
			border-collapse: collapse;
			width: 100%;
			text-align: center;
		}

		th {
			background-color: #007bff;
			color: #fff;
			padding: 10px;
			font-size: 18px;
		}

		td {
			padding: 10px;
			font-size: 16px;
			color: white;
			border-bottom: 1px solid #ccc;
		}

		.error {
			color: red;
			font-weight: bold;
			margin-top: 10px;
		}
    .banner {
  padding: 10px;
  margin-bottom: 10px;
  border-radius: 5px;
  font-size: 18px;
  color: #fff;
  text-align: center;
  width: 98.8%;
}

.banner.important {
  background-color: #f44336;
}

.banner.success {
  background-color: #4CAF50;
}

.closebtn {
  
  color: #fff;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;

}

.closebtn:hover {
  color: black;
}
	</style>
</head>
<body>
<div class="banner important">
  <span class="closebtn" style="right:20px"onclick="this.parentElement.style.display='none';">&times</span> 
  <strong> Výsledky je nutné logicky zaokrouhlit na nižší číslo, protože se započítavájí hodiny jako celek. Tedy při výsledku 12,5 je maximální počet zameškaných hodin 12. </strong>
</div>

	<h1>Počítadlo absence</h1>
    <div style="display:flex; justify-content:left; align-items:left; position:absolute; left:30px;">

    <img width="200px" src="https://cdn.pixabay.com/photo/2016/11/29/01/16/abacus-1866497_1280.jpg">
    </div>
    <div style="display:flex; justify-content:right; align-items:right; position:absolute; right:30px;">

    <img width="200px" src="https://cdn.pixabay.com/photo/2016/11/29/01/16/abacus-1866497_1280.jpg">
    </div>

	<form method="post">
		<label for="predmet">Typ předmětu:</label>
		<select name="predmet" id="predmet">
			<option value="normalni">Normální předmět</option>
			<option value="hv">Hudební výchova</option>
		</select>
       <br><br> <label for="x">Absence v hodinách:</label>
		<input placeholder="Zde uveďte data ze sloupce Absence za období" type="number" name="x" id="x"><br><br>
		<label for="y">Aktuální absence v procentech:</label>
	<input placeholder="Zde uveďte data ze sloupce Absence (%)" type="text" name="y" id="y"><br><br>

	<input type="submit" value="Vypočítat absenci"> <input type="button" class="login" onclick="loginSOL()" value="Login do ŠOLu">  <input type="button" class="login" onclick="logoutSOL()" value="Odhlásit se ze ŠOLu">


</form>

<script>
function loginSOL() {
  window.open("https://aplikace.skolaonline.cz/SOL/App/Dochazka/KZD002_ZobrAbsPredmZaka.aspx#", "_blank", "width=1800, height=600");
}
function logoutSOL() {
  var popup = window.open("https://aplikace.skolaonline.cz/SOL/App/Logout.aspx", "_blank", "width=1, height=1");
  var intervalId = setInterval(function() {
    if (popup.closed) {
      clearInterval(intervalId);
      alert("Odhlášení bylo úspěšné");
    } else if (popup.location.href !== "about:blank" && popup.location.href !== "https://aplikace.skolaonline.cz/SOL/App/Logout.aspx") {
      clearInterval(intervalId);
      alert("Odhlášení bylo úspěšné");
    }
  }, 500);

  setTimeout(function() {
    popup.close();
  }, 5000);
}


</script>
<?php
if(isset($_POST['predmet']) && isset($_POST['x']) && isset($_POST['y'])){
	$typ_predmetu = $_POST['predmet'];
	$x = $_POST['x'];
	$y = $_POST['y'];
	if($typ_predmetu == "normalni"){
		$vysledek = $x * 25 / $y;
	} else {
		$vysledek = $x * 35 / $y;
	}
    
echo "<table class='pozor'><tr><th>Výsledek</th></tr><tr><td>$vysledek hodin můžeš celkem zameškat.</td></tr></table>";
}
?>
</body>
</html>
