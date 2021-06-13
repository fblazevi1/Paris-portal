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
        }
        else {
            $uspjesnaPrijava = FALSE;
            $usrMsg = "Neispravno korisničko ime ili lozinka!";
            session_destroy();
        }
    }

    if(isset($_POST['odjava']) && isset($_SESSION['username'])){

        echo "uništen";
        unset($_SESSION["username"]);
        unset($_SESSION["level"]);

        session_destroy();
    }

    // Brisanje i promijena arhiviranosti
    if(isset($_POST['delete'])){
        include 'connect.php';

        $id=$_POST['id'];
        $query = "DELETE FROM clanak WHERE id=$id";
        $result = mysqli_query($dbc, $query) or die('Error querying database.');

        mysqli_close($dbc);
    }

    if(isset($_POST['update'])){
        include 'connect.php';

        $picture = $_FILES['picture']['name'];
        $title=$_POST['title'];
        $about=$_POST['about'];
        $content=$_POST['content'];
        $category=$_POST['category'];

        if(isset($_POST['archive'])){
            $archive=1;
        }
        else{
            $archive=0;
        }

        $target_dir = UPLPATH . $picture;
        move_uploaded_file($_FILES["picture"]["tmp_name"], $target_dir);

        $id=$_POST['id'];

        if($picture == ""){
            $query = "UPDATE clanak SET naslov='$title', sazetak='$about', tekst='$content', kategorija='$category', arhiva='$archive' WHERE id=$id ";
        }
        else{
            $target_dir = UPLPATH . $picture;
            move_uploaded_file($_FILES["picture"]["tmp_name"], $target_dir);

            $query = "UPDATE clanak SET naslov='$title', sazetak='$about', tekst='$content', slika='$picture', kategorija='$category', arhiva='$archive' WHERE id=$id ";
        }

        $result = mysqli_query($dbc, $query) or die('Error querying database.');
    }

    // Pokaži stranicu ukoliko je korisnik uspješno prijavljen i administrator je
    if (($uspjesnaPrijava == TRUE && $admin == TRUE) || (isset($_SESSION['username'])) && $_SESSION['level'] == 1) {
        $query = "SELECT * FROM clanak";
        $result = mysqli_query($dbc, $query) or
        die("Error querying database.");
    
        while($row = mysqli_fetch_array($result)) {
            echo '<form enctype="multipart/form-data" action="administrator.php" method="POST">
            <div class="form-item-admin">
            <label for="title">Naslov vjesti:</label>
            <div class="form-field"> <input type="text" name="title" class="form-field-textual" value="'.$row['naslov'].'">
            </div>
            </div>
            <div class="form-item-admin">
            <label for="about">Kratki sadržaj vijesti (do 50 znakova):</label>
            <div class="form-field">
            <textarea name="about" id="" cols="30" rows="10" class="form-field-textual">'.$row['sazetak'].'</textarea>
            </div> </div>
            <div class="form-item-admin">
            <label for="content">Sadržaj vijesti:
            </label> <div class="form-field">
            <textarea name="content" id="" cols="30" rows="10" class="form-field-textual">'.$row['tekst'].'</textarea>
            </div>
            </div> 
            <div class="form-item-admin"> 
            <label for="picture">Slika:</label> 
            <div class="form-field">
            <input type="file" accept="image/jpg" id="picture" value="' . $row['slika'] . '" name="picture"/> <br>
            <img src="' . UPLPATH . $row['slika'] . '" width=100px>
            </div>
            </div>
            <div class="form-item-admin">
            <label for="category">Kategorija vijesti:</label>
            <div class="form-field">
            <select name="category" id="" class="form-field-textual">';
    
            if($row['kategorija'] == "LjubavniBrodolomi"){
                echo '<option value="LjubavniBrodolomi" selected>LjubavniBrodolomi</option>
                <option value="KogaBriga">KogaBriga</option>';
            }
            if($row['kategorija'] == "KogaBriga"){
                echo '<option value="LjubavniBrodolomi">LjubavniBrodolomi</option>
                <option value="KogaBriga" selected>KogaBriga</option>';
            }
                
            
            echo '</select>
            </div>
            </div>
            <div class="form-item-admin">
            <label>Spremiti u arhivu:
            <div class="form-field">'; 
            if($row['arhiva'] == 0) { 
                echo '<input type="checkbox" name="archive" id="archive"/> Arhiviraj?';
            }
            else {
                echo '<input type="checkbox" name="archive" id="archive" checked/> Arhiviraj?';
            } 
            
            echo '</div> 
            </label> 
            </div> 
            </div>
            <div class="form-item-admin"> 
            <input type="hidden" name="id" class="form-field-textual" value="'.$row['id'].'"> 
            <button type="submit" name="update" value="Prihvati">Izmjeni</button> 
            <button type="reset" value="Poništi">Poništi</button> 
            <button type="submit" name="delete" value="Izbriši"> Izbriši</button> </div> 
            </form>
            <div class="line_admin">
            <hr>
            </div>';
        }
    }
    // Pokaži poruku da je korisnik uspješno prijavljen, ali nije administrator
    else if ($uspjesnaPrijava == TRUE && $admin == FALSE) {
        echo '<p>Bok ' . $imeKorisnika . '! Uspješno ste prijavljeni, ali niste administrator.</p>';
    }
    else if (isset($_SESSION['username']) && $_SESSION['level'] == 0) {
        echo '<p>Bok ' . $_SESSION['username'] . '! Uspješno ste prijavljeni, ali niste administrator.</p>';
    }
    else if ($uspjesnaPrijava == FALSE) {
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

<?php } 
mysqli_close($dbc);
?>

<footer>
    <p>ⓒ Frano Blažević, 2021</p>
    <p>Contact: fblazevi1@tvz.hr</p>
    
</footer>
</body>
</html>