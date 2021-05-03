<?php
include_once 'ModalitatEnum.php';

interface DB {
    
    public function connect(): void;

    public function insert($modalitat, $nivell, $intents): int;
    
    public function selectAll();
    
    public function selectByModalitat($modalitat);
    
    public function delete($id);

    public function update($id, $modalitat, $nivell, $intents);

    public function findById($id);

}