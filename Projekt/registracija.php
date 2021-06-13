<!DOCTYPE html>
<html lang="hr">
<head>
    <meta name="author" content="Frano Blazevic">
    <meta charset="utf-8">
    <title>LeParisien</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="shortcut icon" href="img/LeParisien-favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<?php
$msg="";
if(isset($_POST['slanje'])){

    include 'connect.php';

    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $username = $_POST['username'];
    $lozinka = $_POST['pass'];
    $hashed_password = password_hash($lozinka, CRYPT_BLOWFISH);
    $razina = 0;
    $registriranKorisnik = '';
    

    //Provjera postoji li u bazi već korisnik s tim korisničkim imenom
    $sql = "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime = ?";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
    } 

    if(mysqli_stmt_num_rows($stmt) > 0){
        $msg='Korisničko ime već postoji!';
    }
    else{ 
        // Ako ne postoji korisnik s tim korisničkim imenom - Registracija korisnika u bazi pazeći na SQL injection 
        $sql = "INSERT INTO korisnik (ime, prezime, korisnicko_ime, lozinka, razina)VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($dbc);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, 'ssssd', $ime, $prezime, $username, $hashed_password, $razina);
            mysqli_stmt_execute($stmt);
            $registriranKorisnik = TRUE;
        }
    }

    //Registracija je prošla uspješno
    if($registriranKorisnik == TRUE) {
        echo '<p>Korisnik je uspješno registriran!</p>';
    }
    else {
        echo 'registracija nije protekla uspješno ili je korisnik prvi put došao na stranicu';
    }
    mysqli_close($dbc);
}

?>

<body>
<header>
    <div id="login">
        <a href="login.php">LOGIN</a>
        <form enctype="multipart/form-data" action="login.php" method="POST">
            <button type="submit" name="odjava" value="logOut" id="slanje">LOG OUT</button>
        </form>
    </div>
    <h1><a href="index.php"><img src="img/LeParisien-logo.png" id="logo" alt="LeParisien - logo"></a></h1>
    <nav>
        <ul>
            <li><a href="index.php">HOME</a></li>
            <li><a href="kategorija.php?id=LjubavniBrodolomi">BRODOLOMI</a></li>
            <li><a href="kategorija.php?id=KogaBriga">KOGA BRIGA</a></li>
            <li><a href="administrator.php">ADMINISTRACIJA</a></li>
            <li><a href="unos.html">UNOS VIJESTI</a></li>
            <li><a href="registracija.php">REGISTRACIJA</a></li>
        </ul>
    </nav>
</header>

<section role="main">
    <form enctype="multipart/form-data" action="registracija.php" method="POST">
        <div class="form-item-reg">
            <span id="porukaIme" class="bojaPoruke error"></span>
            <label for="title">Ime: </label>
            <div class="form-field">
                <input type="text" name="ime" id="ime" class="form-field-textual">
            </div>
        </div>

        <div class="form-item-reg">
            <span id="porukaPrezime" class="bojaPoruke error"></span>
            <label for="about">Prezime: </label>
            <div class="form-field">
                <input type="text" name="prezime" id="prezime" class="form-field-textual">
            </div> 
        </div> 
        <div class="form-item-reg">
            <span id="porukaUsername" class="bojaPoruke error"></span>
            <label for="content">Korisničko ime:</label> 
            <!-- Ispis poruke nakon provjere korisničkog imena u bazi -->
            <?php 
                echo '<br><span class="bojaPoruke">' . $msg . '</span>';
            ?>
            <div class="form-field">
                <input type="text" name="username" id="username" class="form-field-textual">
            </div>
        </div>

        <div class="form-item-reg">
            <span id="porukaPass" class="bojaPoruke error"></span>
            <label for="pass">Lozinka: </label>
            <div class="form-field">
                <input type="password" name="pass" id="pass" class="form-field-textual">
            </div>
        </div>
        <div class="form-item-reg">
            <span id="porukaPassRep" class="bojaPoruke error"></span>
            <label for="passRep">Ponovite lozinku: </label>
            <div class="form-field">
                <input type="password" name="passRep" id="passRep" class="form-field-textual">
            </div>
        </div>

        <div class="form-item-reg">
            <button type="submit" name="slanje" value="Prijava" id="slanje">Prijava</button>
        </div>
    </form>
</section>

<footer>
    <p>ⓒ Frano Blažević, 2021</p>
    <p>Contact: fblazevi1@tvz.hr</p>
    
</footer>

<script type="text/javascript">
document.getElementById("slanje").onclick = function(event) {
    var slanjeForme = TRUE;

    // Ime korisnika mora biti uneseno
    var poljeIme = document.getElementById("ime");
    var ime = document.getElementById("ime").value;
    if (ime.length == 0) {
        slanjeForme = FALSE;
        poljeIme.style.border="1px dashed red";
        document.getElementById("porukaIme").innerHTML="<br>Unesite ime!<br>";
    }
    else {
        poljeIme.style.border="1px solid green";
        document.getElementById("porukaIme").innerHTML="";
    } 
    
    // Prezime korisnika mora biti uneseno
    var poljePrezime = document.getElementById("prezime");
    var prezime = document.getElementById("prezime").value;
    if (prezime.length == 0) {
        slanjeForme = FALSE;
        poljePrezime.style.border="1px dashed red";
        document.getElementById("porukaPrezime").innerHTML="<br>Unesite Prezime!<br>";
    }
    else {
        poljePrezime.style.border="1px solid green";
        document.getElementById("porukaPrezime").innerHTML="";
    } 
    // Korisničko ime mora biti uneseno
    var poljeUsername = document.getElementById("username");
    var username = document.getElementById("username").value;
    if (username.length == 0) {
        slanjeForme = FALSE; 
        poljeUsername.style.border="1px dashed red";
        document.getElementById("porukaUsername").innerHTML="<br>Unesite korisničko ime!<br>";
    }
    else {
        poljeUsername.style.border="1px solid green";
        document.getElementById("porukaUsername").innerHTML="";
    }

    // Provjera podudaranja lozinki
    var poljePass = document.getElementById("pass");
    var pass = document.getElementById("pass").value;
    var poljePassRep = document.getElementById("passRep");
    var passRep = document.getElementById("passRep").value;
    if (pass.length == 0 || passRep.length == 0 || pass != passRep) {
        slanjeForme = FALSE; poljePass.style.border="1px dashed red";
        poljePassRep.style.border="1px dashed red";
        document.getElementById("porukaPass").innerHTML="<br>Lozinke nisu iste!<br>";
        document.getElementById("porukaPassRep").innerHTML="<br>Lozinke nisu iste!<br>";
    }
    else {
        poljePass.style.border="1px solid green";
        poljePassRep.style.border="1px solid green";
        document.getElementById("porukaPass").innerHTML="";
        document.getElementById("porukaPassRep").innerHTML="";
    }
    if (slanjeForme != TRUE) { 
        event.preventDefault();
    }
};
</script>

</body>
</html>