<?php
namespace lib\view;

function render(string $viewname, ?object $context = null): void {
    (function ($_viewname) {
        require "$_viewname.php";
    })->bindTo($context)($viewname);
}
