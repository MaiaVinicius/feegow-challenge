FROM php
RUN docker-php-ext-install pdo_mysql pdo_
CMD ["php", "-S", "0.0.0.0:8001", "-t", "public", "public/index.php"]
CMD ["php", "-S", "0.0.0.0:8002", "-t", "public", "public/index.php"]