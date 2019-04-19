#!/usr/bin/env bash

source "$(dirname "$0")/utils.sh"

OLD_PWD="$PWD"

cd "$(parentdir "$0")"
php "$PWD/lib/test.php" --continue-on-fail "$@" "$PWD/tests"
cd "$OLD_PWD"
