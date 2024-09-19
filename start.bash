#!/bin/bash

# Determine the directory where the script resides
SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )"

# Check if running as root
if [[ $EUID -ne 0 ]]; then
   echo "This script must be run as root" 
   exit 1
fi

# Install docker-compose if not already installed
if [[ "$(uname)" == "Linux" ]] && ! command -v docker-compose &> /dev/null; then
    echo "Installing docker-compose..."
    apt-get update
    apt-get install -y docker-compose
fi

# Directories to create
directories=(
    ./postgres/data
    ./postgres/pgadmin
)

# Create necessary directories if they don't exist
for dir in "${directories[@]}"; do
    mkdir -p "$dir"
done

# Set permissions for directories
chown -R 5050:5050 ./postgres/pgadmin/
chown -R postgres:postgres ./postgres/data
# Start Docker Compose
cd compose || exit
docker-compose up