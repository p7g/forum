<?php
namespace lib\http;

interface OPTIONSHandler extends RequestHandler {
    public function options(Request $request, Response $response): void;
}
