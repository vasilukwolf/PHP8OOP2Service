<?php

require_once __DIR__.'/lib/Ship.php';
require_once __DIR__.'/lib/BattleManager.php';
require_once __DIR__.'/lib/ShipLoader.php';
require_once __DIR__.'/lib/BattleResult.php';
require_once __DIR__.'/lib/Container.php';

$configuration = array(
    'db_dsn'  => 'mysql:host=127.127.126.50;dbname=oo_battle',
    'db_user' => 'wolf',
    'db_pass' => 'pass1234',
);
