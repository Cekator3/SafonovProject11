FROM nginx:mainline-alpine-slim

WORKDIR /var/www/html

RUN addgroup \
    --gid 1010 \
    www
RUN adduser \
    --disabled-password \
    --gecos "" \
    --ingroup www \
    --no-create-home \
    --uid 1010 \
    www

COPY .docker/nginx/default.conf /etc/nginx/conf.d/default.conf
COPY .docker/nginx/nginx.conf /etc/nginx/nginx.conf
