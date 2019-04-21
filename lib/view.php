<?php
namespace lib\view;

function render(string $viewname, ?object $context = null): string {
    \ob_start();
    (function ($_viewname) {
        require "$_viewname.php";
    })->bindTo($context)($viewname);
    return \ob_get_clean();
}

function render_template(\Generator $template, array $sections): string {
    \ob_start();
    $current = $template->current();
    while ($template->valid()) {
        $current = $template->send($sections[$current] ?? null);
    }
    return \ob_get_clean();
}
