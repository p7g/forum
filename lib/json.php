<?php
namespace lib\json;

function parse(string $json) {
    $value = \json_decode($json);
    if ($value === null && \json_last_error() !== JSON_ERROR_NONE) {
        throw new Error(\json_last_error_msg());
    }
    return $value;
}
