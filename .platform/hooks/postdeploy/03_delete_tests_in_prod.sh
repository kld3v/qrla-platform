#!/bin/bash

# Check if the environment is production
if [ "$APP_ENV" == "production" ]; then
    echo "Production environment detected. Deleting tests folder..."
    if [ -d "tests" ]; then
        rm -rf tests
        echo "Tests folder deleted."
    else
        echo "No tests folder found."
    fi
else
    echo "Non-production environment detected. Tests folder retained."
fi
