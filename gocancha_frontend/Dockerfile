FROM node:14 as node
WORKDIR /
COPY ./ /
RUN npm install -g ionic
RUN npm install
ARG npmrun=build
RUN npm run $npmrun

FROM nginx:alpine
COPY --from=node /www /usr/share/nginx/html
COPY ./nginx-custom.conf /etc/nginx/conf.d/default.conf