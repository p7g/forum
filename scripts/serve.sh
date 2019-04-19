#!/usr/bin/env bash

USAGE="USAGE: $0 [-p <port>] [-h <host>]"

source "$(dirname "$0")/utils.sh"

PORT=8080
HOST=localhost

while getopts ':p:h:' opt; do
  case "$opt" in
    p)
      PORT="$OPTARG";;
    h)
      HOST="$OPTARG";;
    \?)
      echo "Invalid option -$OPTARG" >&2;
      echo $USAGE >&2;
      exit 1;;
    :)
      echo 'Expected option' >&2;
      echo $USAGE >&2;
      exit 1;;
  esac
done

echo $HOST
echo $PORT

exit 0

OLD_PWD="$PWD"
cd "$(parentdir "$0")/public"

php -S "$HOST:$PORT"

cd "$OLD_PWD"
