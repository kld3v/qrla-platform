#!/usr/bin/env bash

# Enable debug mode and log all commands
set -xe

# Redirect output to a log file
exec > >(tee -a /tmp/eb-predeploy.log) 2>&1

# Log the environment variable
echo "Deploying to ENVIRONMENT: $APP_ENV"

# Define the source and temporary destination paths
PLATFORM_NGINX_CONF_DIR="/var/app/current/.platform/nginx"
TEMP_CONF_DIR="/tmp/nginx_conf"

# Ensure the temporary directory exists
mkdir -p "$TEMP_CONF_DIR"

# Select the appropriate Nginx configuration
if [ "$APP_ENV" == "production" ]; then
    echo "Copying production Nginx configuration to $TEMP_CONF_DIR..."
    cp "$PLATFORM_NGINX_CONF_DIR/production.conf" "$TEMP_CONF_DIR/nginx.conf"
    echo "Production Nginx configuration copied to $TEMP_CONF_DIR."
else
    echo "Copying staging Nginx configuration to $TEMP_CONF_DIR..."
    cp "$PLATFORM_NGINX_CONF_DIR/staging.conf" "$TEMP_CONF_DIR/nginx.conf"
    echo "Staging Nginx configuration copied to $TEMP_CONF_DIR."
fi
