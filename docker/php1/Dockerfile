FROM php
RUN docker-php-ext-install pdo_mysql
CMD ["php", "-S", "0.0.0.0:8002", "-t", "build", "build/index.html"]
