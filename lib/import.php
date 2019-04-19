<?php
namespace lib\import;

function import(string $__name) {
    if (!\file_exists($__name)) {
        $__name .= '.php';
    }
    return (function () use ($__name) {
        return require $__name;
    })();
}
