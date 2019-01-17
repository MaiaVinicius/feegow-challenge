FROM php
RUN docker-php-ext-install pdo_mysql
CMD ["php", "-S", "0.0.0.0:8081", "-t", "public", "public/index.php"]