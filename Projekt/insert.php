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
include 'connect.php';

$date=date('d.m.Y.');
$title=$_POST['title'];
$category=$_POST['category'];
$about=$_POST['about'];
$content=$_POST['content'];
$picture = $_FILES['picture']['name'];

if(isset($_POST['archive'])){
    $archive=1; 
}
else{
    $archive=0;
}
$target_dir = 'img/'. $picture;
move_uploaded_file($_FILES["picture"]["tmp_name"], $target_dir);

$query = "INSERT INTO clanak (datum, naslov, sazetak, tekst, slika, kategorija, arhiva) VALUES ('$date', '$title', '$about', '$content', '$picture', '$category', '$archive')";
$result = mysqli_query($dbc, $query) or die('Error querying databese.');

mysqli_close($dbc);
?>

<div class="clanak">
        <h2>
            <?php 
                echo $category;
            ?>
        </h2>
        <h3>
            <?php
                echo $title;
            ?>
        </h3>

        <figure>
            <?php 
                echo "<img src='img/$picture' alt='$picture'/>";
            ?>
        </figure>

        <div class="summary">
            <p>
                <?php
                    echo $about;
                ?>
            </p>
        </div>

        <div class="content">
            <p>
                <?php
                    echo $content;
                ?>
            </p>
        </div>
    </div>

<footer>
    <p>ⓒ Frano Blažević, 2021</p>
    <p>Contact: fblazevi1@tvz.hr</p>
    
</footer>
</body>
</html>

