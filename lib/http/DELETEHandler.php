<?php
namespace lib\http;

interface DELETEHandler extends RequestHandler {
    public function delete(Request $request, Response $response): void;
}
