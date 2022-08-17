FROM nginx:1.19.2-alpine

# ensure www-data user exists
RUN set -x ; \
  addgroup -g 82 -S www-data ; \
  adduser -u 82 -D -S -G www-data www-data && exit 0 ; exit 0

COPY ./_docker/nginx/templates /etc/nginx/templates

COPY ./public /application/public

RUN chown -R www-data:www-data /application

WORKDIR /application
