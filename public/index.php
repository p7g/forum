<?php
require \dirname($_SERVER['DOCUMENT_ROOT']) . '/index.php';

use lib\db;
use lib\http;
use lib\http\{Request, Response};
use lib\iter;
use lib\view;

configure();

$create_hullo = db\prepare(<<<SQL
    CREATE TABLE IF NOT EXISTS hullo (
        id INTEGER PRIMARY KEY,
        text TEXT
    );
SQL
);
db\execute($create_hullo);

$seed_hullo = db\prepare(<<<SQL
    INSERT INTO hullo (text)
    VALUES
        ('test'),
        ('hullo');
SQL
);
$query_hullo = db\prepare("SELECT * FROM hullo");

http\handle(new class implements http\GETHandler, http\POSTHandler {
    public function get(Request $request, Response $response): void {
        global $seed_hullo, $query_hullo;
        $result = db\transact(function () use ($seed_hullo, $query_hullo) {
            db\execute($seed_hullo);
            return iter\collect(db\query_all($query_hullo));
        });

        view\render('../view/home', (object) [
            'thing' => $request->get_query('thing'),
            'request' => $result,
        ]);
    }

    public function post(Request $request, Response $response): void {
        $body = $request->json();
        echo \json_encode($body);
    }
});
