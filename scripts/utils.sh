#!/usr/bin/env bash

function parentdir() {
  CURRENT="$(cd $(dirname "$0") && pwd)"
  echo "$(dirname "$CURRENT")"
}
