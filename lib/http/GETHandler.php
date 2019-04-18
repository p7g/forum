<?php
namespace lib\http;

interface GETHandler extends RequestHandler {
    public function get(Request $request, Response $response): void;
}
