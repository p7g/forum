<?php
require '../index.php';

use lib\http;
use lib\http\{Request, Response};
use lib\view;

http\handle(new class implements http\GETHandler, http\POSTHandler {
    public function get(Request $request, Response $response): void {
        view\render('../view/home', (object) [
            'thing' => $request->get_query('thing'),
            'request' => $request,
        ]);
    }

    public function post(Request $request, Response $response): void {
        $body = $request->json();
        echo \json_encode($body);
    }
});
