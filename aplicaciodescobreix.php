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

// Si encara no s'ha inicialitzat aquest tipus de partida
// Nivell 1: entre 1 i 10
if(!isset($_SESSION['inicitipusa'])) {
    // Inicialitzem: $nivell, $maximnumero, $intents1a, $intents2a i $intents3a
    $_SESSION['partida']->inicialitzadora(1, 10, 0, 0, 0);
    $_SESSION['inicitipusa'] = 1;
}

// Si s'ha clicat el botó d'acceptar
if (isset($_POST['btAcceptar']) && isset($_POST['numero']) && !empty($_POST['numero'])) {
    $_SESSION['partida']->setNumerocalculat(rand(1, $_SESSION['partida']->getMaximnumero()));
    if($_SESSION['partida']->getNivell() == 1) { $_SESSION['partida']->setIntents1a($_SESSION['partida']->getIntents1a() + 1); }
    else if($_SESSION['partida']->getNivell() == 2) { $_SESSION['partida']->setIntents2a($_SESSION['partida']->getIntents2a() + 1); }
    else if($_SESSION['partida']->getNivell() == 3) { $_SESSION['partida']->setIntents3a($_SESSION['partida']->getIntents3a() + 1); }
    $_SESSION['mostrar1'] = 'none';
    $_SESSION['mostrar2'] = '';
    unset($_POST['btAcceptar']);
}

// Si s'ha clicat el botó de correcte
else if (isset($_POST['btCorrecte'])) {
    $_SESSION['partida'] = $_SESSION['partida'];
    $_SESSION['mostrar1'] = 'none';
    $_SESSION['mostrar2'] = 'none';
    $_SESSION['mostrar3'] = '';
    unset($_SESSION['partida']->minimrang);
    unset($_SESSION['partida']->maximrang);
    unset($_POST['btCorrecte']);
    if ($_SESSION['partida']->getNivell() == 1) {
        $conn->insert("Maquina", 1, $_SESSION['partida']->getIntents1a());
    }
    else if ($_SESSION['partida']->getNivell() == 2) {
        $conn->insert("Maquina", 2, $_SESSION['partida']->getIntents2a());
    }
    else if ($_SESSION['partida']->getNivell() == 3) {
        $conn->insert("Maquina", 3, $_SESSION['partida']->getIntents3a());
    }
}

// Si s'ha clicat el botó de número menor
else if (isset($_POST['btMenor'])) {
    if($_SESSION['partida']->getNumerocalculat() == 1){
        $_SESSION['missatge'] = 'Fora de rang';
        $_SESSION['missatgecolor'] = 'danger';
    }
    else {
        $_SESSION['partida']->setMaximrang($_SESSION['partida']->getNumerocalculat() - 1);
        $_SESSION['partida']->setNumerocalculat(rand(isset($_SESSION['partida']->minimrang) ? $_SESSION['partida']->getMinimrang() : 1, $_SESSION['partida']->getMaximrang()));
        
        if($_SESSION['partida']->getNivell() == 1) { $_SESSION['partida']->setIntents1a($_SESSION['partida']->getIntents1a() + 1); }
        else if($_SESSION['partida']->getNivell() == 2) { $_SESSION['partida']->setIntents2a($_SESSION['partida']->getIntents2a() + 1); }
        else if($_SESSION['partida']->getNivell() == 3) { $_SESSION['partida']->setIntents3a($_SESSION['partida']->getIntents3a() + 1); }
    }
    unset($_POST['btMenor']);
}

// Si s'ha clicat el botó de número major
else if (isset($_POST['btMajor'])) {
    if($_SESSION['partida']->getNumerocalculat() == 10){
        $_SESSION['missatge'] = 'Fora de rang';
        $_SESSION['missatgecolor'] = 'danger';
    }
    else {
        $_SESSION['partida']->setMinimrang($_SESSION['partida']->getNumerocalculat() + 1);
        $_SESSION['partida']->setNumerocalculat(rand($_SESSION['partida']->getMinimrang(), isset($_SESSION['partida']->maximrang) ? $_SESSION['partida']->getMaximrang() : $_SESSION['partida']->getMaximnumero()));
        
        if($_SESSION['partida']->getNivell() == 1) { $_SESSION['partida']->setIntents1a($_SESSION['partida']->getIntents1a() + 1); }
        else if($_SESSION['partida']->getNivell() == 2) { $_SESSION['partida']->setIntents2a($_SESSION['partida']->getIntents2a() + 1); }
        else if($_SESSION['partida']->getNivell() == 3) { $_SESSION['partida']->setIntents3a($_SESSION['partida']->getIntents3a() + 1); }
    }
    unset($_POST['btMajor']);
}

// Si s'ha clicat el botó de seguir següent nivell
else if (isset($_POST['btSeguir'])) {
    $_SESSION['partida']->setNivell($_SESSION['partida']->getNivell() + 1);
    if($_SESSION['partida']->getNivell() == 3){
        $_SESSION['mostrarbtseguir'] = 'none';
    }
    // Nivell 2: entre 1 i 50 i Nivell 3: entre 1 i 100
    if($_SESSION['partida']->getNivell() == 2) { $_SESSION['partida']->setMaximnumero(50); }
    else if($_SESSION['partida']->getNivell() == 3) { $_SESSION['partida']->setMaximnumero(100); }
    $_SESSION['mostrar1'] = '';
    $_SESSION['mostrar2'] = 'none';
    $_SESSION['mostrar3'] = 'none';
    unset($_POST['btSeguir']);
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

    <?php if(isset($_SESSION['missatge'])) { ?>
        <div class="container-fluid position-absolute p-0">
            <div class="alert alert-<?= $_SESSION['missatgecolor'] ?> alert-dismissible fade show position-relative" role="alert">
            <?= $_SESSION['missatge'] ?>
            <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php unset($_SESSION['missatge']); unset($_SESSION['missatgecolor']); } ?>

    <div class="container">
        <br><br><br>
        <div class="row">
            <div class="col-4"></div><div class="col-4">
                <form method="POST">
                    
                    <h5 class="text-center text-muted">Aplicacio Descobreix</h5><br><br>

                    <div class="card" style="display: <?= isset($_SESSION['mostrar1']) ? $_SESSION['mostrar1'] : '' ?>">
                        <div class="card-body">
                            <h5 class="card-title">Introdueix un número de l'1 al <?= isset($_SESSION['partida']->maximnumero) ? $_SESSION['partida']->getMaximnumero() : 10 ?></h5>
                            <input class="form-control" type="text" style="width: 30%;" name="numero"><br>
                            <button class="btn btn-success" name="btAcceptar">Acceptar</button>
                        </div>
                    </div>
                    
                    <div class="card" style="display: <?= isset($_SESSION['mostrar2']) ? $_SESSION['mostrar2'] : 'none' ?>">
                        <div class="card-body text-center">
                            <h5 class="card-title">És aquest el número?</h5>
                            <h5 class="card-title fw-bold"><?= isset($_SESSION['partida']->numerocalculat) ? $_SESSION['partida']->getNumerocalculat() : '' ?></h5><br>
                            <button class="btn btn-success" name="btMenor">Menor <i class="fas fa-chevron-left"></i></button>
                            <span class="p-1"></span>
                            <button class="btn btn-success" name="btCorrecte"><i class="fas fa-check"></i></button>
                            <span class="p-1"></span>
                            <button class="btn btn-success" name="btMajor">Major <i class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>

                    <div class="card" style="display: <?= isset($_SESSION['mostrar3']) ? $_SESSION['mostrar3'] : 'none' ?>">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold">Número encertat! <?=$_SESSION['partida']->getNumerocalculat() ?></h5><br>
                            <button class="btn btn-success" name="btSeguir" style="display: <?= isset($_SESSION['mostrarbtseguir']) ? $_SESSION['mostrarbtseguir'] : '' ?>">Següent nivell</button>
                            <span class="p-1"></span>
                            <a href="resultats.php" class="btn btn-success">Resultats</a>
                        </div>
                    </div>
                
                </form>
            </div>
            <div class="col-4"></div>
        </div>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/releases/v5.15.2/js/all.js" data-auto-a11y="true"></script>

</body>
</html>

    