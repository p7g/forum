<?php
namespace lib\http;

interface HEADHandler extends RequestHandler {
    public function head(Request $request, Response $response): void;
}
