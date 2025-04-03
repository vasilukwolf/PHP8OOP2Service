<?php

class ShipLoader
{
    
function getShips()
{
    $shipsData = $this->queryForShips();

    foreach ($shipsData as $shipData) {
        $ship = new Ship($shipData['name']);
        $ship->setWeaponPower($shipData['weapon_power']);
        $ship->setJediFactor($shipData['jedi_factor']);
        $ship->setStrength($shipData['strength']);
        $ships[] = $ship;
    }
     return $ships;

}

private function queryForShips()
{
    $pdo = new PDO('mysql:host=127.127.126.50;dbname=oo_battle', 'wolf','pass1234');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $pdo->prepare('SELECT * FROM ship');
    $statement->execute();
    $shipsArray = $statement->fetchAll(PDO::FETCH_ASSOC);
    return  $shipsArray;
}

}