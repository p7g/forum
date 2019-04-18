<?php
namespace lib\http;

interface PUTHandler extends RequestHandler {
    public function put(Request $request, Response $response): void;
}
