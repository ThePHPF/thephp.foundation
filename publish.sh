#!/bin/bash

set -e

if ! npx tailwind -i assets/css/app.css -o source/assets/css/app.css --minify; then
    echo "Unable to build assets" >&2
    exit 1
fi

if ! ./vendor/bin/sculpin generate --env=prod; then
    echo "Could not generate the site" >&2
    exit 1
fi

# Get current branch name
branch=$(git branch --show-current)

# Get current commit revision
rev=$(git rev-parse --short HEAD)

git stash push
git switch gh-pages

cp -R output_prod/* .
rm -rf output_*

git add .
git commit -m "Rebuild site at ${rev}"
git push origin HEAD:gh-pages

git switch "${branch}"
git stash pop
