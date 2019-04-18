<?php
namespace lib\config;

use json;

/**
 * Get or set the configuration object.
 *
 * @param object|null $new_config The new configuration object (optional)
 * @return object|null The current object if no parameter given, otherwise the
 * old configuration which has been replaced.
 */
function config(?object $new_config = null): ?object {
    static $config = null;
    if ($new_config === null) {
        return $config;
    }
    $old_config = $config;
    $config = $new_config;
    return $old_config;
}
