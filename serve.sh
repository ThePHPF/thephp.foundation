#!/bin/bash

# Kill entire process tree on exit
trap 'kill 0' INT TERM EXIT

# Run Tailwind with prefixed output
npx tailwind -i assets/css/app.css -o source/assets/css/app.css --watch 2>&1 | awk '{print "[tailwind] " $0; fflush()}' &

# Run Sculpin with prefixed output
./vendor/bin/sculpin generate --watch --server 2>&1 | awk '{print "[sculpin] " $0; fflush()}' &

# Wait for both
wait
