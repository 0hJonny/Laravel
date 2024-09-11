-- Удаляем базу данных "Library"
DROP DATABASE IF EXISTS library;

-- Создание базу данных "library"
CREATE DATABASE library;

-- Подключение к базе данных "library"
\c library;

-- установка расширения для поиска
CREATE EXTENSION IF NOT EXISTS pg_trgm;
