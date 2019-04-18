<?php
namespace lib\http;

interface PATCHHandler extends RequestHandler {
    public function patch(Request $request, Response $response): void;
}
