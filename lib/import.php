<?php
namespace lib\import;

function import(string $name) {
    if (\file_exists($name)) {
        return require $name;
    }
    return require "$name.php";
}
