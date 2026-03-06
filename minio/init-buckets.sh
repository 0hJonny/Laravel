#!/bin/bash
set -e

# Ждем пока MinIO станет доступен (проверяем порт 9000)
echo "Waiting for MinIO to be ready..."
until mc alias set myminio http://localhost:9000 ${MINIO_ROOT_USER:-minioadmin} ${MINIO_ROOT_PASSWORD:-minioadmin} 2>/dev/null; do
  echo "MinIO is unavailable - sleeping"
  sleep 2
done

echo "MinIO is up and running!"

# Создаем бакет 'covers', если он еще не существует
# Флаг --ignore-existing предотвращает ошибку, если бакет уже создан
echo "Creating bucket 'covers'..."
mc mb --ignore-existing myminio/covers

# Устанавливаем политику доступа 'public' для бакета 'covers'
# Это делает все файлы в этом бакете доступными для чтения без авторизации
echo "Setting public policy for bucket 'covers'..."
mc policy set public myminio/covers

# Запускаем основной процесс контейнера (если он есть) или просто завершаем скрипт
# Если этот контейнер только для инициализации, можно оставить так:
echo "Initialization complete."
exec "$@"