<?php
namespace lib\console;

const COLOUR_RED = "\u{001b}[31m";
const COLOUR_GREEN = "\u{001b}[32m";
const COLOUR_RESET = "\u{001b}[0m";

function supports_colour(): bool {
    return true; // TODO
}

function set_colour(string $colour): void {
    echo $colour;
}

function reset_colour(): void {
    echo COLOUR_RESET;
}

function with_colour(string $colour, string $text): void {
    set_colour($colour);
    echo $text;
    reset_colour();
}
