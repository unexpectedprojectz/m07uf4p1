<?php
class Partida {
  // Propietats
  public $nivell;
  public $maximnumero;
  public $numerocalculat;
  public $minimrang;
  public $maximrang;
  public $intents1;
  public $intents2;
  public $intents3;

  // Inicialitzadors
  function inicialitzadora($nivell, $maximnumero, $intents1a, $intents2a, $intents3a){
    $this->nivell = $nivell;
    $this->maximnumero = $maximnumero;
    $this->intents1a = $intents1a;
    $this->intents2a = $intents2a;
    $this->intents3a = $intents3a;
  }

  function inicialitzadorb($nivell, $maximnumero, $intents1b, $intents2b, $intents3b, $numerocalculat){
    $this->nivell = $nivell;
    $this->maximnumero = $maximnumero;
    $this->intents1b = $intents1b;
    $this->intents2b = $intents2b;
    $this->intents3b = $intents3b;
    $this->numerocalculat = $numerocalculat;
  }

  // Metodes
  function setNivell($nivell) {
    $this->nivell = $nivell;
  }

  function getNivell() {
    return $this->nivell;
  }

  function setMaximnumero($maximnumero) {
    $this->maximnumero = $maximnumero;
  }

  function getMaximnumero() {
    return $this->maximnumero;
  }

  function setNumerocalculat($numerocalculat) {
    $this->numerocalculat = $numerocalculat;
  }

  function getNumerocalculat() {
    return $this->numerocalculat;
  }

  function setMinimrang($minimrang) {
    $this->minimrang = $minimrang;
  }

  function getMinimrang() {
    return $this->minimrang;
  }

  function setMaximrang($maximrang) {
    $this->maximrang = $maximrang;
  }

  function getMaximrang() {
    return $this->maximrang;
  }

  function setIntents1a($intents1a) {
    $this->intents1a = $intents1a;
  }

  function getIntents1a() {
    return $this->intents1a;
  }

  function setIntents2a($intents2a) {
    $this->intents2a = $intents2a;
  }

  function getIntents2a() {
    return $this->intents2a;
  }

  function setIntents3a($intents3a) {
    $this->intents3a = $intents3a;
  }

  function getIntents3a() {
    return $this->intents3a;
  }

  function setIntents1b($intents1b) {
    $this->intents1b = $intents1b;
  }

  function getIntents1b() {
    return $this->intents1b;
  }

  function setIntents2b($intents2b) {
    $this->intents2b = $intents2b;
  }

  function getIntents2b() {
    return $this->intents2b;
  }

  function setIntents3b($intents3b) {
    $this->intents3b = $intents3b;
  }

  function getIntents3b() {
    return $this->intents3b;
  }

}
?>