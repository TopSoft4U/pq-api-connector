ARG PHP_VERSION=8.3
FROM php:${PHP_VERSION}-cli

# The extensions this package and its tooling need — ext-curl (runtime),
# ext-dom, ext-mbstring, ext-xml, ext-xmlwriter (PHPUnit + PHPStan) — are already
# compiled into the official php:*-cli images, so we only build ext-zip, which
# composer uses and which is NOT shipped precompiled.
RUN apt-get update && apt-get install -y --no-install-recommends \
        libzip-dev \
        unzip \
        git \
        ca-certificates \
    && docker-php-ext-install zip \
    && rm -rf /var/lib/apt/lists/*

# Composer from the official, pinned image.
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
