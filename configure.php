<?php
require __DIR__ . '/autoload.php';

use lib\db;
use lib\json;
use lib\config\KeyValueStore;

function configure(): void {
    try {
        db\configuration(KeyValueStore::import(__DIR__ . '/config/db.php'));
    } catch(\Throwable $e) {
        \error_log('Missing required database configuration file');
        exit(1);
    }
}
