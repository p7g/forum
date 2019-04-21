<?php
require \dirname($_SERVER['DOCUMENT_ROOT']) . '/configure.php';

use lib\db;
use lib\http;
use lib\http\{Request, Response};
use function lib\import\import;
use lib\iter;

use forum\db\users;
use forum\models\User;
use forum\views;

configure();

http\handle(new class implements http\GETHandler, http\POSTHandler {
    public function get(Request $request, Response $response): void {
        views\render($response, 'views/users', (object) [
            'users' => users\get_all(),
        ]);
    }

    public function post(Request $request, Response $response): void {
        $user = $_POST;
        users\create(User::from_array($user));
        header('Location: /');
    }
});
