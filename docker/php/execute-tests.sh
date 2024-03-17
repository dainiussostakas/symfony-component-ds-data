#!/bin/bash

if ! ./vendor/bin/phpstan analyse src --level 3; then
    exit 1
fi

if ! ./vendor/bin/phpcs --standard=PSR12 src; then
    exit 1
fi

if ! ./vendor/bin/phpunit; then
    exit 1
fi