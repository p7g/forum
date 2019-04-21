<?php
namespace forum\views;

use lib\http\Response;
use lib\view;
use function lib\import\import;

const STYLES = [
    'https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css',
];

const SCRIPTS = [
    'https://use.fontawesome.com/releases/v5.3.1/js/all.js',
    '/js/navbar-toggle.js',
];

$template = import(__DIR__ . '/views/template');

function render(Response $response, string $viewname, object $context): void {
    global $template;
    echo view\render_template($template(), [
        'styles' => STYLES,
        'scripts' => SCRIPTS,
        'header' => view\render(__DIR__ . '/views/header'),
        'main' => view\render(__DIR__ . "/$viewname", $context),
    ]);
}
