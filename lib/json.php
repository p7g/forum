<?php
namespace lib\json;

function parse(...$args) {
    $value = \json_decode(...$args);
    if ($value === null && \json_last_error() !== JSON_ERROR_NONE) {
        throw new \Error(\json_last_error_msg());
    }
    return $value;
}

function parse_file(string $filename, ...$options) {
    if (!\file_exists($filename)) {
        throw new \Error("File $filename does not exist");
    }
    $contents = \file_get_contents($filename);
    return parse($contents, ...$options);
}
