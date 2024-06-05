FROM nginx:1.26.0-alpine

RUN addgroup -g 1000 apimon
RUN adduser -G apimon -u 1000 apimon -D

COPY default.conf /etc/nginx/conf.d/default.conf

WORKDIR /home/apimon