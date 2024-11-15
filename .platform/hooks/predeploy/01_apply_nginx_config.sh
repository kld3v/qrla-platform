#!/usr/bin/env bash

# Exit immediately if a command exits with a non-zero status
set -e

# Log the environment variable for debugging
echo "Deploying to ENVIRONMENT: $APP_ENV"

# Define the source and destination paths
NGINX_CONF_DIR="/etc/nginx/conf.d"
PLATFORM_NGINX_CONF_DIR="/var/app/staging/.platform/nginx"

# Select the appropriate Nginx configuration
if [ "$APP_ENV" == "production" ]; then
    cp "$PLATFORM_NGINX_CONF_DIR/production.conf" "$NGINX_CONF_DIR/custom.conf"
    echo "Applied production Nginx configuration."
else
    cp "$PLATFORM_NGINX_CONF_DIR/staging.conf" "$NGINX_CONF_DIR/custom.conf"
    echo "Applied staging Nginx configuration."
fi
