<?php
require \dirname($_SERVER['DOCUMENT_ROOT']) . '/configure.php';

use lib\db;
use lib\http;
use lib\http\{Request, Response};
use lib\iter;
use lib\view;

use forum\db\users;
use forum\models\User;

configure();

http\handle(new class implements http\GETHandler, http\POSTHandler {
    public function get(Request $request, Response $response): void {
        view\render('../views/users', (object) [
            'users' => users\get_all(),
        ]);
    }

    public function post(Request $request, Response $response): void {
        $user = $_POST;
        users\create(User::from_array($user));
        header('Location: /');
    }
});
