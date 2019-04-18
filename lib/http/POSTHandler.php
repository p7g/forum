<?php
namespace lib\http;

interface POSTHandler extends RequestHandler {
    public function post(Request $request, Response $response): void;
}
