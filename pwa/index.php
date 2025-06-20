<?php
include 'connect.php';
define('UPLPATH', 'img/');
?>
<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8">
  <title>El Confidencial</title>
  <style>
    *{ font-family: 'Georgia', serif;}
    body {
      font-family: 'Georgia', serif;
      font-family: Georgia, serif;
      margin: 0;
      background: white;
      color: black;
    }
    header {
      font-family: 'Georgia', serif;
      text-align: center;
      padding: 30px 0 10px;
    }
    header h1 {
      font-family: 'Georgia', serif;
      color:#003b5c;
      font-size: 38px;
      margin: 0;
    }
    header p {
      font-size: 14px;
      color: #444;
    }
    nav {
      text-align: center;
      padding: 10px 0;
      border-top: 1px solid #ccc;
      border-bottom: 1px solid #ccc;
    }
    nav a {
      margin: 0 15px;
      text-decoration: none;
      color: black;
      font-weight: bold;
      font-family: Arial, sans-serif;
    }
    .section {
      max-width: 1200px;
      margin: 40px auto;
      padding: 0 20px;
    }
    .section h2 {
      font-size: 20px;
      margin-bottom: 20px;
      border-left: 8px solid #c00;
      padding-left: 10px;
      font-family: Arial, sans-serif;
    }
    .section.europa h2 {
      border-color: #d35400;
    }
    .section.teknautas h2 {
      border-color: #6c3483;
    }
    .articles {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
    }
    .article {
      flex: 1 1 calc(33.333% - 20px);
      box-sizing: border-box;
    }
    .article img {
      width: 100%;
      height: auto;
    }
    .article h4 {
      font-size: 16px;
      font-weight: normal;
      margin: 10px 0 5px;
    }
    .article a {
      text-decoration: none;
      color: black;
    }
    .article .date {
      font-size: 12px;
      color: #777;
    }
    footer {
      font-size: 13px;
      color: #555;
      text-align: center;
      padding: 40px 20px 20px;
      border-top: 1px solid #ddd;
    }
    @media (max-width: 768px) {
      .article {
        flex: 1 1 100%;
      }
    }
  </style>
</head>
<body>

<header>
  <h1>El Confidencial</h1>
</header>

<nav>
  <a href="index.php">HOME</a>
  <a href="kategorija.php?id=europa">EUROPA</a>
  <a href="kategorija.php?id=teknautas">TEKNAUTAS</a>
  <a href="administracija.php">ADMINISTRACIJA</a>
</nav>

<div class="section europa">
  <h2>EUROPA</h2>
  <div class="articles">
    <?php
    $query = "SELECT * FROM vijesti WHERE kategorija='europa' AND arhiva=0 ORDER BY datum DESC LIMIT 6";
    $result = mysqli_query($dbc, $query);
    while ($row = mysqli_fetch_array($result)) {
      echo '<div class="article">';
      echo '<a href="clanak.php?id=' . $row['id'] . '">';
      echo '<img src="' . UPLPATH . $row['slika'] . '" alt="slika">';
      echo '</a>';
      echo '<h4><a href="clanak.php?id=' . $row['id'] . '">' . $row['naslov'] . '</a></h4>';
      echo '<div class="date">' . $row['datum'] . '</div>';
      echo '</div>';
    }
    ?>
  </div>
</div>

<div class="section teknautas">
  <h2>TEKNAUTAS</h2>
  <div class="articles">
    <?php
    $query = "SELECT * FROM vijesti WHERE kategorija='teknautas' AND arhiva=0 ORDER BY datum DESC LIMIT 6";
    $result = mysqli_query($dbc, $query);
    while ($row = mysqli_fetch_array($result)) {
      echo '<div class="article">';
      echo '<a href="clanak.php?id=' . $row['id'] . '">';
      echo '<img src="' . UPLPATH . $row['slika'] . '" alt="slika">';
      echo '</a>';
      echo '<h4><a href="clanak.php?id=' . $row['id'] . '">' . $row['naslov'] . '</a></h4>';
      echo '<div class="date">' . $row['datum'] . '</div>';
      echo '</div>';
    }
    ?>
  </div>
</div>

<footer>
    <p>&copy; Antun Ošust-0246117225</p>
  </footer>

</body>
</html>
