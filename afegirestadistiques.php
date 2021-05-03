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

if(isset($_POST['btAfegir'])) {
    $stmtafegir = $conn->insert($_POST['modalitat'], $_POST['nivell'], $_POST['intents']);
    header("Location: resultats.php");
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
</head>
<body>

    <header class="container-fluid p-3 bg-secondary">
        <a href="index.php" class="btn shadow-none"><h3 class="text-white">Guess my number</h3></a>
    </header>
    <br><br>

    <div class="container">
        <h2 class="text-center">Crear estadística</h2><br><br>
        <div class="row">
            <div class="col">
                <div class="card m-auto" style="width: 50%;">
                    <div class="card-body">
                        <form method="POST">
                            Modalitat: <select class="form-control" name="modalitat">
                                <option>Maquina</option>
                                <option>Huma</option>
                            </select>
                            Nivell: <input class="form-control" type="text" name="nivell">
                            Intents: <input class="form-control" type="text" name="intents"><br>
                            <button class="btn btn-success d-flex m-auto" name="btAfegir">Acceptar</button>
                        </form>
                    </div>
                </div>
            </div>    
        </div>
    </div>
</body>
</html>