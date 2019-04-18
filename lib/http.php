<?php
namespace lib\http;

/**
 * Get the Method instance for the current request's HTTP method.
 *
 * @return Method An instance of the Method enum
 */
function request_method(): Method {
    return Method::from_value($_SERVER['REQUEST_METHOD']);
}

/**
 * Given an instance of a request handler class, dispatch the current request.
 *
 * Note that there is no routing involved, other than by HTTP method. It is
 * assumed that the routing has already happened when this is called. One way to
 * do this is by calling this function in an `index.php` file within a directory
 * that represents the desired path of this request, for example
 * `topics/index.php`. This way, when the user visits `/topics`, the webserver
 * will execute that index.php file, which calls this function with the handler
 * for that route.
 *
 * @param RequestHandler $handler The handler instance. It must implement
 * RequestHandler (an empty interface), which can be accomplished by
 * implementing one or more HTTP handler interfaces e.g. GETHandler
 * @return void
 */
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

/**
 * Send back a 404 using the configured 404 page (TODO)
 *
 * @param Request $request The current request object
 * @param Response $response The current response object
 * @return void
 */
function not_found(Request $request, Response $response): void {
    http_response_code(404);
}

/**
 * Searches the $_SERVER array for any keys starting with "HTTP_", which
 * signifies a request header. These keys are then converted to skewer case.
 *
 * @return string[] An associative array of headers
 */
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

/**
 * Create a new Request object for the current request.
 *
 * @return Request A Request object populated with the current request's info
 */
function new_request(): Request {
    $request = new Request();

    $request->set_headers(get_headers());
    $request->set_body(\fopen('php://input', 'r'));

    $qs = [];
    \parse_str($_SERVER['QUERY_STRING'] ?? '', $qs);
    $request->set_query_all($qs);

    return $request;
}

/**
 * Create a new Response object populated with default values.
 *
 * @return Response A new response object with default values
 */
function new_response(): Response {
    $response = new Response();

    return $response;
}
