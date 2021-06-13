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

<section>
    <div class="line">
        <hr>
    </div>
    

    <?php
    include 'connect.php';
    define('UPLPATH', 'img/');

    $kategorija = $_GET['id'];

    $query = "SELECT * FROM clanak WHERE arhiva=0 AND kategorija LIKE '$kategorija'";
    $result = mysqli_query($dbc, $query) or
    die("Error querying database.");;

    echo '<h2>' . $kategorija . '</h2>';

    while($row = mysqli_fetch_array($result)) {
        echo "<article class='clanak_indx'>";
        echo '<a href="clanak.php?id=' . $row['id'] . '">';
        echo "<div class='article_img'>";
        echo '<img src="' . UPLPATH . $row['slika'] . '" alt="' . $row['slika'] . '"/>';
        echo "</div>";
        echo '<h3>' . $row['naslov'] . '</h3>';
        echo "</a>";
        echo "</article>";
    }

    mysqli_close($dbc);
    ?>
</section>

<footer>
    <p>ⓒ Frano Blažević, 2021</p>
    <p>Contact: fblazevi1@tvz.hr</p>
    
</footer>
</body>
</html>