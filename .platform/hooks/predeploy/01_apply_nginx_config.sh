#!/usr/bin/env bash

# Enable debug mode and log all commands
set -xe

# Redirect output to two log files
exec > >(tee -a /tmp/eb-predeploy.log /var/log/eb-deploy.log) 2>&1

# Log the environment variable for debugging
echo "Deploying to ENVIRONMENT: $APP_ENV"

# Add a unique marker for testing
echo "PREDEPLOY SCRIPT CALLED - Marker: $(date +%s)"
