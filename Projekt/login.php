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

<?php
    session_start();
    include 'connect.php';
    define('UPLPATH', 'img/');
    $uspjesnaPrijava = FALSE;
    $usrMsg ="";
    $sesija = FALSE;

    // Provjera da li je korisnik došao s login forme
    if (isset($_POST['prijava'])) {
        // Provjera da li korisnik postoji u bazi uz zaštitu od SQL injectiona
        $prijavaImeKorisnika = $_POST['username'];
        $prijavaLozinkaKorisnika = $_POST['lozinka'];

        $sql = "SELECT korisnicko_ime, lozinka, razina FROM korisnik WHERE korisnicko_ime = ?";
        $stmt = mysqli_stmt_init($dbc);
        if (mysqli_stmt_prepare($stmt, $sql)){
            mysqli_stmt_bind_param($stmt, 's', $prijavaImeKorisnika);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
        }
        mysqli_stmt_bind_result($stmt, $imeKorisnika, $lozinkaKorisnika, $levelKorisnika);
        mysqli_stmt_fetch($stmt);

        //Provjera lozinke
        if (password_verify($_POST['lozinka'], $lozinkaKorisnika) && mysqli_stmt_num_rows($stmt) > 0) {
            $uspjesnaPrijava = TRUE;

            // Provjera da li je admin
            if($levelKorisnika == 1) {
                $admin = TRUE;
            }
            else {
                $admin = FALSE;
            }
            //postavljanje session varijabli
            $_SESSION['username'] = $imeKorisnika; 
            $_SESSION['level'] = $levelKorisnika;
            $sesija = TRUE;
        }
        else {
            $uspjesnaPrijava = FALSE;
            $usrMsg = "Neispravno korisničko ime ili lozinka!";
            session_destroy();
        }
    }

    if(isset($_SESSION['username'])){
        $sesija = TRUE;
    }

    if(isset($_POST['odjava']) && isset($_SESSION['username'])){

        unset($_SESSION["username"]);
        unset($_SESSION["level"]);

        $sesija = FALSE;

        session_destroy();
    }

    if ($uspjesnaPrijava == FALSE && $sesija == FALSE) {
?>

<section role="main">
    <form enctype="multipart/form-data" action="login.php" method="POST">
        <div class="form-item-reg">
            <label for="content">Korisničko ime:</label> 
            <div class="form-field">
                <input type="text" name="username" id="username" class="form-field-textual">
            </div>
        </div>

        <div class="form-item-reg">
            <label for="pass">Lozinka: </label>
            <div class="form-field">
                <input type="password" name="lozinka" id="lozinka" class="form-field-textual">
            </div>
        </div>
        <div class="form-item-reg">
        <span id="porukaPass" class="bojaPoruke error"><?php echo $usrMsg; ?></span><br>
            <button type="submit" name="prijava" value="Prijava" id="slanje">Prijava</button>
        </div>
    </form>
</section>

<?php
}
else{
    echo '<p>Bok! Uspješno ste prijavljeni kao ' . $_SESSION['username'] . '!</p>';
}

mysqli_close($dbc);
?>

<footer>
    <p>ⓒ Frano Blažević, 2021</p>
    <p>Contact: fblazevi1@tvz.hr</p>
</footer>

</body>
</html>