<?php

class ShipLoader
{
private $pdo;
public function __construct(PDO $pdo)
{
    $this->pdo = $pdo;
}
    /**
     * @return Ship[]
     */
public function getShips()
{
    $shipsData = $this->queryForShips();

    foreach ($shipsData as $shipData) {
        $ships[] = $this->createShipFromData($shipData);
    }
    return $ships;

}

private function queryForShips()
{
    $pdo = $this->getPDO();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $pdo->prepare('SELECT * FROM ship');
    $statement->execute();
    $shipsArray = $statement->fetchAll(PDO::FETCH_ASSOC);
    return  $shipsArray;
}

 /**
     * @param $id
     * @return Ship
     */
public function findOneById($id)
{
    $pdo = $this->getPDO();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $pdo->prepare('SELECT * FROM ship WHERE id = :id');
    $statement->execute(array('id' => $id));
    $shipArray = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$shipArray) {
        return null;
    }
    return $this->createShipFromData($shipArray);
}

private function createShipFromData(array $shipData)
    {
        $ship = new Ship($shipData['name']);
        $ship->setId($shipData['id']);
        $ship->setWeaponPower($shipData['weapon_power']);
        $ship->setJediFactor($shipData['jedi_factor']);
        $ship->setStrength($shipData['strength']);
        return $ship;
    }

        /**
     * @return PDO
     */

    private function getPDO()
    {
        return $this->pdo;
    }

}