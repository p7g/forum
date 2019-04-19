<?php
namespace lib\iter;

function collect(iterable $iter): array {
    $collected = [];

    foreach ($iter as $k => $v) {
        $collected[$k] = $v;
    }

    return $collected;
}
