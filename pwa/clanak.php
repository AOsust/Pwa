<?php
include 'connect.php';
define('UPLPATH', 'img/');
$id = $_GET['id'];
$query = "SELECT * FROM vijesti WHERE id=$id";
$result = mysqli_query($dbc, $query);
$row = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">
  <title><?php echo $row['naslov']; ?></title>
  <style>
    *{ font-family: 'Georgia', serif;}
    body {
      font-family: Georgia, serif;
      margin: 0;
      background-color: #fff;
      color: #000;
    }
    header {
      color: black;
      padding: 20px;
      text-align: center;
    }
    nav a {
      color: color;
      margin: 0 15px;
      text-decoration: none;
      font-weight: bold;
    }
    main {
      max-width: 900px;
      margin: 0 auto;
      padding: 40px 20px;
      background-color: #fff;
    }
    h1 {
      font-size: 36px;
      line-height: 1.2;
      margin-bottom: 10px;
      text-align: center;
    }
    .subtitle {
      font-size: 16px;
      text-align: center;
      color: #555;
      max-width: 650px;
      margin: 0 auto 30px auto;
    }
    img.article-img {
      display: block;
      max-width: 100%;
      margin: 30px auto;
    }
    .date {
      font-size: 14px;
      font-weight: bold;
      margin-bottom: 20px;
      color: #222;
    }
    .text {
      font-size: 17px;
      line-height: 1.7;
      color: #333;
    }
    .text p {
      margin-bottom: 20px;
    }
    footer {
      padding: 20px;
      text-align: center;
      border-top: 1px solid #ccc;
      font-size: 0.9em;
      background: rgb(236, 235, 235);
      margin-top:30px;
    }
    footer nav a {
      color: #555;
    }
  </style>
</head>
<body>

<header>
  <h1>El Confidencial</h1>
  <nav>
    <a href="index.php">HOME</a>
    <a href="kategorija.php?id=europa">EUROPA</a>
    <a href="kategorija.php?id=teknautas">TEKNAUTAS</a>
    <a href="administracija.php">ADMINISTRACIJA</a>
  </nav>
</header>

<main>
  <h1><?php echo $row['naslov']; ?></h1>

  <?php if (!empty($row['sazetak'])): ?>
    <div class="subtitle"><?php echo $row['sazetak']; ?></div>
  <?php endif; ?>

  <img src="<?php echo UPLPATH . $row['slika']; ?>" class="article-img" alt="Slika članka">

  <div class="date"><?php echo $row['datum']; ?></div>

  <div class="text">
    <?php echo nl2br($row['tekst']); ?>
  </div>
</main>


</body>

 <footer>
    <p>&copy; Antun Ošust-0246117225</p>
  </footer>
</html>
