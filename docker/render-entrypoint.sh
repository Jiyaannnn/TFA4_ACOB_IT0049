#!/bin/sh
set -eu

render_port="${PORT:-10000}"
render_url="${RENDER_EXTERNAL_URL:-http://localhost:${render_port}}"

sed -ri "s/Listen [0-9]+/Listen ${render_port}/" /etc/apache2/ports.conf
sed -ri "s/:80>/:${render_port}>/" /etc/apache2/sites-available/000-default.conf

cp env .env
{
    printf '\nCI_ENVIRONMENT = production\n'
    printf "app.baseURL = '%s/'\n" "${render_url%/}"
} >> .env

exec "$@"
