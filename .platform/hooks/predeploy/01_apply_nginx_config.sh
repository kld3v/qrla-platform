#!/usr/bin/env bash

# Enable debug mode and log all commands
set -xe

# Redirect output to a log file
exec > >(tee -a /tmp/eb-predeploy.log) 2>&1

# Log the environment variable for debugging
echo "Deploying to ENVIRONMENT: $APP_ENV"

# Define the source and destination paths
NGINX_CONF_DIR="/etc/nginx/conf.d"
PLATFORM_NGINX_CONF_DIR="/var/app/current/.platform/nginx"

# Verify if source files exist
echo "Checking if Nginx configuration files exist in $PLATFORM_NGINX_CONF_DIR"
ls -la "$PLATFORM_NGINX_CONF_DIR"

# Select the appropriate Nginx configuration
if [ "$APP_ENV" == "production" ]; then
    echo "Copying production Nginx configuration..."
    cp "$PLATFORM_NGINX_CONF_DIR/production.conf" "$NGINX_CONF_DIR/custom.conf"
    echo "Applied production Nginx configuration."
else
    echo "Copying staging Nginx configuration..."
    cp "$PLATFORM_NGINX_CONF_DIR/staging.conf" "$NGINX_CONF_DIR/custom.conf"
    echo "Applied staging Nginx configuration."
fi
