<?php
include 'connect.php';
$poruka = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $ime = $_POST['ime'];
  $prezime = $_POST['prezime'];
  $username = $_POST['username'];
  $pass = $_POST['pass'];
  $passRep = $_POST['passRep'];

  if ($pass !== $passRep) {
    $poruka = "❌ Lozinke se ne podudaraju!";
  } else {
    $stmt = mysqli_prepare($dbc, "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
      $poruka = "⚠️ Korisničko ime već postoji.";
    } else {
      $hash = password_hash($pass, PASSWORD_DEFAULT);
      $stmt = mysqli_prepare($dbc, "INSERT INTO korisnik (ime, prezime, korisnicko_ime, lozinka, razina) VALUES (?, ?, ?, ?, 0)");
      mysqli_stmt_bind_param($stmt, "ssss", $ime, $prezime, $username, $hash);
      if (mysqli_stmt_execute($stmt)) {
        $poruka = "✅ Uspješno ste registrirani!";
      } else {
        $poruka = "❌ Došlo je do pogreške pri spremanju podataka.";
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">
  <title>Registracija</title>
  <style>
    *{ font-family: 'Georgia', serif;}
    body {
      font-family: 'Georgia', serif;
      margin: 0;
      background-color: #f4f4f4;
    }
    header {
      padding: 20px;
      text-align: center;
      border-bottom: 1px solid #ccc;
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
    main {
      max-width: 600px;
      margin: 40px auto;
      padding: 20px;
      background: white;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      border-radius: 5px;
    }
    h2 {
      text-align: center;
    }
    form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }
    input {
      padding: 10px;
      font-size: 16px;
    }
    button {
      padding: 10px;
      background-color: #003366;
      color: white;
      border: none;
      cursor: pointer;
      font-weight: bold;
    }
    .message {
      text-align: center;
      margin-bottom: 15px;
      font-weight: bold;
      color: #003366;
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
      <a href="login.php">PRIJAVA</a>
    </nav>
  </header>

  <main>
    <h2>Registracija korisnika</h2>

    <?php if (!empty($poruka)) echo "<div class='message'>$poruka</div>"; ?>

    <form method="POST">
      <input name="ime" placeholder="Ime" required>
      <input name="prezime" placeholder="Prezime" required>
      <input name="username" placeholder="Korisničko ime" required>
      <input type="password" name="pass" placeholder="Lozinka" required>
      <input type="password" name="passRep" placeholder="Ponovi lozinku" required>
      <button type="submit">Registriraj se</button>
    </form>
  </main>

</body>
 <footer>
    <p>&copy; Antun Ošust-0246117225</p>
  </footer>
</html>
