#!/usr/bin/env sh

function parentdir() {
  CURRENT="$(cd $(dirname "$0") && pwd)"
  echo "$(dirname "$CURRENT")"
}
