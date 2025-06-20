<?php
include 'connect.php';
define('UPLPATH', 'img/');
$kategorija = $_GET['id']; 
?>
<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">
  <title><?php echo strtoupper($kategorija); ?> - Arhiva</title>
  <style>
    *{
      font-family: 'Georgia', serif;
    }
    body {
      font-family: 'Georgia', serif;
      margin: 0;
      background: #f8f8f8;
    }
    header {
      padding: 20px;
      text-align: center;
    }
    header h1{
      color:#003b5c;
    }
    nav a {
      color: black;
      margin: 0 15px;
      text-decoration: none;
      font-weight: bold;
    }
    .container {
      max-width: 1000px;
      margin: 40px auto;
      padding: 0 20px;
    }
    .article {
      margin-bottom: 30px;
      border-bottom: 1px solid #ddd;
      padding-bottom: 20px;
    }
    .article img {
      max-width: 100%;
      height: auto;
    }
    .article h3 {
      margin: 10px 0;
    }
    .article .date {
      font-size: 13px;
      color: #666;
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

<div class="container">
  <h2>Arhiva kategorije: <?php echo strtoupper($kategorija); ?></h2>

  <?php
  $query = "SELECT * FROM vijesti WHERE kategorija='$kategorija' AND arhiva=1 ORDER BY id DESC";
  $result = mysqli_query($dbc, $query);
  while ($row = mysqli_fetch_array($result)) {
    echo '<div class="article">';
    echo '<a href="clanak.php?id=' . $row['id'] . '">';
    echo '<img src="' . UPLPATH . $row['slika'] . '" alt="slika">';
    echo '</a>';
    echo '<h3><a href="clanak.php?id=' . $row['id'] . '">' . $row['naslov'] . '</a></h3>';
    echo '<div class="date">' . $row['datum'] . '</div>';
    echo '<p>' . $row['sazetak'] . '</p>';
    echo '</div>';
  }
  ?>
</div>

</body>
 <footer>
    <p>&copy; Antun Ošust-0246117225</p>
  </footer>
</html>
