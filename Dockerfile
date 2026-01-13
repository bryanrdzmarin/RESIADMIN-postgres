FROM node:24-alpine3.21

RUN apk add php git
RUN apk add php-phar php-iconv php-mbstring php-openssl
RUN apk add php-curl php-session php-tokenizer php-xml
RUN apk add php-zip php-bcmath php-pdo php-pdo_mysql php-mysqli
RUN apk add php-ctype php-json php-dom php-simplexml php-xmlwriter
RUN apk add php-fileinfo php-gd php-cli php-sockets
RUN apk add php-pgsql php-pdo_pgsql postgresql-libs postgresql-client

COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN npm install --verbose
RUN composer update

EXPOSE 8000 5173

# RUN php artisan migrate --force
# RUN php artisan db:seed --force

CMD [ "npx", "concurrently", "-c", "'#93c5fd,#c4b5fd,#fdba74'", "'php artisan serve --host=0.0.0.0'", "'php artisan queue:listen --tries=1'", "'npm run dev'", "--names='server,queue,vite'"]
