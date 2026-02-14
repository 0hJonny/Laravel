#!/bin/sh
set -e

echo "⏳ Waiting for MinIO to be ready..."
until curl -sf http://localhost:9000/minio/health/live; do
    sleep 5
done

echo "✅ MinIO is ready!"

# Install MinIO client
if ! which mc >/dev/null 2>&1; then
    echo "📥 Installing MinIO client..."
    wget -q https://dl.min.io/client/mc/release/linux-amd64/mc -O /usr/bin/mc
    chmod +x /usr/bin/mc
fi

echo "🔧 Creating buckets..."

# Configure MinIO client
mc alias set myminio http://localhost:9000 "${MINIO_ROOT_USER}" "${MINIO_ROOT_PASSWORD}"

# Create publications bucket
echo "📦 Creating publications-bucket..."
mc mb myminio/publications-bucket --ignore-existing

# Set public read policy for publications bucket
echo "🔓 Setting public read policy..."
mc anonymous set public myminio/publications-bucket

# Create private bucket for sensitive files (optional)
echo "📦 Creating private-bucket..."
mc mb myminio/private-bucket --ignore-existing
mc anonymous set none myminio/private-bucket

# Enable versioning (optional)
echo "🔄 Enabling versioning..."
mc version enable myminio/publications-bucket

echo "✅ Buckets created successfully!"
echo "📚 MinIO Console: http://localhost:9001"
echo "📦 S3 Endpoint: http://localhost:9000"