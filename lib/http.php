<?php
namespace lib\http;

function request_method(): Method {
    return Method::from_value($_SERVER['REQUEST_METHOD']);
}

function handle(RequestHandler $handler): void {
    $request = new_request();
    $response = new_response();

    switch (request_method()) {
    case Method::GET():
        if ($handler instanceof GETHandler) {
            $handler->get($request, $response);
            return;
        }
        break;
    case Method::POST():
        if ($handler instanceof POSTHandler) {
            $handler->post($request, $response);
            return;
        }
        break;
    case Method::PUT():
        if ($handler instanceof PUTHandler) {
            $handler->put($request, $response);
            return;
        }
        break;
    case Method::PATCH():
        if ($handler instanceof PATCHHandler) {
            $handler->patch($request, $response);
            return;
        }
        break;
    case Method::DELETE():
        if ($handler instanceof DELETEHandler) {
            $handler->delete($request, $response);
            return;
        }
        break;
    case Method::HEAD():
        if ($handler instanceof HEADHandler) {
            $handler->head($request, $response);
            return;
        }
        break;
    case Method::OPTIONS():
        if ($handler instanceof OPTIONSHandler) {
            $handler->options($request, $response);
            return;
        }
        break;
    }

    not_found($request, $response);
}

function not_found(Request $request, Response $response): void {
    http_response_code(404);
}

function get_headers(): array {
    $headers = [];
    foreach ($_SERVER as $key => $value) {
        if (\strncmp($key, 'HTTP_', 5) !== 0) {
            continue;
        }
        $name = \implode('-', \array_map('mb_strtolower', \explode('_', $key)));
        $headers[$name] = $value;
    }
    return $headers;
}

function new_request(): Request {
    $request = new Request();

    $request->set_headers(get_headers());
    $request->set_body(\fopen('php://input', 'r'));

    $qs = [];
    \parse_str($_SERVER['QUERY_STRING'] ?? '', $qs);
    $request->set_query_all($qs);

    return $request;
}

function new_response(): Response {
    $response = new Response();

    return $response;
}
