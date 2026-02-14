FROM postgres:16

# Настройка русской локали
RUN apt-get update && apt-get install -y locales \
 && localedef -i ru_RU -c -f UTF-8 -A /usr/share/locale/locale.alias ru_RU.UTF-8 \
 && rm -rf /var/lib/apt/lists/*

ENV LANG=ru_RU.UTF-8 \
    LANGUAGE=ru_RU:ru \
    LC_ALL=ru_RU.UTF-8

# Установка расширений (правильные имена пакетов!)
RUN apt-get update && apt-get install -y \
    postgresql-16-postgis-3 \
    postgresql-16-pgrouting \
    postgresql-16-rum \
    nano \
 && rm -rf /var/lib/apt/lists/*

# Healthcheck
HEALTHCHECK --interval=30s --timeout=10s --start-period=40s --retries=3 \
  CMD pg_isready -U "$POSTGRES_USER" -d "$POSTGRES_DB" || exit 1

# Оптимизация производительности
RUN echo "shared_buffers = 256MB" >> /usr/share/postgresql/postgresql.conf.sample && \
    echo "effective_cache_size = 1GB" >> /usr/share/postgresql/postgresql.conf.sample && \
    echo "work_mem = 16MB" >> /usr/share/postgresql/postgresql.conf.sample && \
    echo "maintenance_work_mem = 64MB" >> /usr/share/postgresql/postgresql.conf.sample

CMD ["postgres"]