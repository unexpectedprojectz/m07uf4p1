<?php

include 'partida.php';
include 'DatabasePDO.php';
include 'DatabaseOOP.php';
include 'DatabaseProc.php';

session_start();

// PDO
$conn = new DatabasePDO("localhost", "admin", "admin", "m07uf3");

// OOP
// $conn = new DatabaseOOP("localhost", "admin", "admin", "m07uf3");

// PROC
// $conn = new DatabaseProc("localhost", "admin", "admin", "m07uf3");

$conn->connect();

if(!isset($_SESSION['partida'])) {
    $_SESSION['partida'] = new Partida();
}

unset($_SESSION['inicitipusa']); unset($_SESSION['inicitipusb']);
unset($_POST['numero']); unset($_POST['btAcceptar']); 
unset($_POST['btMenor']); unset($_POST['btMajor']); unset($_POST['btCorrecte']); unset($_POST['btSeguir']);
unset($_SESSION['mostrar1']); unset($_SESSION['mostrar2']); unset($_SESSION['mostrar3']); unset($_SESSION['mostrarbtseguir']);
unset($_SESSION['pista']);

if (isset($_POST['btEliminarResultats'])) {
    $conn->deleteAll();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guess my number</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>
<body>
    
    <header class="container-fluid p-3 bg-secondary d-flex justify-content-between">
        <div><a href="index.php" class="btn shadow-none"><h3 class="text-white">Guess my number</h3></a></div>
        <div><form method="POST"><a class="btn btn-success" href="resultats.php">Resultats</a><span class="p-1"></span><button class="btn btn-danger" name="btEliminarResultats">Eliminar resultats</button></form></div>
    </header><br><br>
    
    <div class="container">
        
        <h4 class="text-center">Tria una modalitat</h4>
        <br><br>

        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Aplicació descobreix</h5>
                        <p class="card-text">El jugador introdueix un número i l'aplicació l'ha d'endevinar a partir de pistes facilitades per l'usuari.</p>
                        <a href="aplicaciodescobreix.php" class="btn btn-success">Començar</a>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Jugador descobreix</h5>
                        <p class="card-text">El jugador ha de descobrir el número plantejat per l'aplicació a partir de pistes que li faciliti aquesta.</p>
                        <a href="jugadordescobreix.php" class="btn btn-success">Començar</a>
                    </div>
                </div>
            </div>
        </div>
        <br><br><br><br><br><br>

        <div class="d-flex justify-content-center text-muted">
            <div>
                <h5 class="text-center fw-bold"><i class="fas fa-info-circle"></i><span class="p-1"></span>Nivells</h5><br>
                <h5>Nivell 1: Números del 1 al 10</h5>
                <h5>Nivell 2: Números del 1 al 50</h5>
                <h5>Nivell 3: Números del 1 al 100</h5>
            </div>
        </div>
        
    </div>
    
    <script>
        window.open("./credits.php" , "credits" , "width=350,height=150")
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

</body>
</html>