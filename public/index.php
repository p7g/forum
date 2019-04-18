<?php
require \dirname($_SERVER['DOCUMENT_ROOT']) . '/index.php';

use lib\db;
use lib\http;
use lib\http\{Request, Response};
use lib\view;

configure();

http\handle(new class implements http\GETHandler, http\POSTHandler {
    public function get(Request $request, Response $response): void {
        view\render('../view/home', (object) [
            'thing' => $request->get_query('thing'),
            'request' => db\configuration()->get('dsn'),
        ]);
    }

    public function post(Request $request, Response $response): void {
        $body = $request->json();
        echo \json_encode($body);
    }
});
