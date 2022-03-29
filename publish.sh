#!/bin/bash

if ! ./node_modules/.bin/tailwind -i assets/css/app.css -o source/assets/css/app.css --minify; then
    echo "Unable to build assets" >&2
    exit 1
fi

if ! ./vendor/bin/sculpin generate --env=prod; then
    echo "Could not generate the site" >&2
    exit 1
fi

# Write functionality here for moving into github-pages
