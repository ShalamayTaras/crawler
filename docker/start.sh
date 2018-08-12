#!/bin/bash

. $(dirname "$0")/help.sh

path=$(current_path)
project_dir="$path/../"

if $ENV_DEV; then
    cd "$path/dev" \
    && docker-compose -p $PROJECT_NAME_DEV up -d

    CONTAINER=$(docker ps -aqf "name=${PROJECT_NAME_DEV}_app")

fi