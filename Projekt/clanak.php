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
    $id = $_GET['id'];
    include 'connect.php';
    define('UPLPATH', 'img/');

    $query =  "SELECT * FROM clanak WHERE id LIKE $id";
    $result = mysqli_query($dbc, $query) or
    die("Error querying database.");

    $row = mysqli_fetch_array($result);

?>

<div class="clanak">
    <div>
        <h2>
            <?php 
                echo "<span>" . $row['kategorija'] . "</span>"; 
            ?>
        </h2>
        <h3>
            <?php 
                echo $row['naslov']; 
            ?>
        </h3>
        <p>AUTOR:</p>
        <p>OBJAVLJENO: 
            <?php 
                echo "<span>".$row['datum']."</span>";
            ?>
        </p>
    </div>
    <figure>
        <?php
            echo '<img src="' . UPLPATH . $row['slika'] . '" alt="' . $row['slika'] . '"/>';
        ?>
    </figure>
    <div class="summary">
        <p> 
            <?php 
                echo "<i>" . $row['sazetak'] . "</i>"; 
            ?>
        </p>
    </div>
    <div class="content">
        <p> 
            <?php
                echo $row['tekst']; 
            ?>
        </p>
    </div>
</div>

<?php
    mysqli_close($dbc);
?>

<footer>
    <p>ⓒ Frano Blažević, 2021</p>
    <p>Contact: fblazevi1@tvz.hr</p>
    
</footer>
</body>
</html>