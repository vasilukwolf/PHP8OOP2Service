<?php

class ShipLoader
{
private $pdo;

private $dbDsn;
private $dbUser;
private $dbPass;
public function __construct($dbDsn, $dbUser, $dbPass)
{
    $this->dbDsn = $dbDsn;
    $this->dbUser = $dbUser;
    $this->dbPass = $dbPass;
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
            if ($this->pdo === null) {
                $this->pdo = new PDO($this->dbDsn, $this->dbUser, $this->dbPass);
                // $this->pdo =new PDO('mysql:host=127.127.126.50;dbname=oo_battle', 'wolf','pass1234');
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return $this->pdo;
    }

}