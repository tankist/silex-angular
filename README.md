# Silex 2.x + AngularJS 1.x

## Install

1. Setup `docker` and `docker-compose`
1. Run composer via command (in application directory): 
```bash
sudo docker run --rm -it --dns=8.8.8.8 \
    -v $(pwd)/:/app \
    -v /etc/passwd:/etc/passwd:ro \
    -v /etc/group:/etc/group:ro \
    -v /tmp/composer:/composer \
    --user $(id -u):$(id -g) \
    composer install --no-dev --ignore-platform-reqs --no-scripts
```
1. Run `docker-compose -d up`
1. Visit http://silex-angular.lan

## NodeJS / NPM run

Global setup of the Vue CLI:

```bash
sudo docker run --rm -it --dns=8.8.8.8 \
     -v $(pwd)/:/app \
     -v $(pwd)/docker/node/node_modules:/usr/local/lib/node_modules \
     node:7-alpine \
     npm i -g vue-cli
```

Initialize Vue project (should be run only once)

```bash
sudo docker run --rm -it --dns=8.8.8.8 \
     -v $(pwd)/:/app \
     -v $(pwd)/docker/node/node_modules:/usr/local/lib/node_modules \
     node:7-alpine \
     sh -c 'cd /app && /usr/local/lib/node_modules/vue-cli/bin/vue init webpack-simple ./'
```

NPM install dependencies:

```bash
sudo docker run --rm -it --dns=8.8.8.8 \
    -v $(pwd)/:/app \
    -v $(pwd)/docker/node/node_modules:/usr/local/lib/node_modules \
    -v /etc/passwd:/etc/passwd:ro \
    -v /etc/group:/etc/group:ro \
    --user $(id -u):$(id -g) \
    node:7-alpine /bin/bash -c 'cd /app && npm install'
```

OR Yarn install dependencies

```bash
sudo docker run --rm -it --dns=8.8.8.8 \
     -v $(pwd)/:/app \
     -v $(pwd)/docker/node/node_modules:/usr/local/lib/node_modules \
     node:7-alpine \
     sh -c 'cd /app && yarn install --no-bin-links'
```