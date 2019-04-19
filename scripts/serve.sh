#!/usr/bin/env sh

source "$(dirname "$0")/utils.sh"

DEFAULT_PORT=8080
PORT=${1:-$DEFAULT_PORT}

OLD_PWD="$PWD"
cd "$(parentdir "$0")/public"

php -S "localhost:$PORT"

cd "$OLD_PWD"
