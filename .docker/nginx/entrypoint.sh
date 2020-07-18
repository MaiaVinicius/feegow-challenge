#!/bin/sh

dockerize -template ./nginx.conf:/etc/nginx/conf.d/nginx.conf


nginx -g "daemon off;"
