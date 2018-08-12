FROM php:7.2

# Install PHP extensions and CURL
RUN apt-get update && apt-get install -y curl \

# Install Composer.
WORKDIR /app
    COPY . ./

