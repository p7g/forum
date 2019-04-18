<?php
require __DIR__ . '/autoload.php';

use lib\db;
use lib\json;
use lib\config\KeyValueStore;

function configure(): void {
    db\configuration(KeyValueStore::from_json(__DIR__ . '/config/db.json'));
}
