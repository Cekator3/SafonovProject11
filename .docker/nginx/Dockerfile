FROM nginx:alpine

WORKDIR /var/www/html

# COPY --chown=nginx . /var/www/html/

COPY .docker/nginx/default.conf /etc/nginx/conf.d/default.conf
COPY .docker/nginx/nginx.conf /etc/nginx/nginx.conf
