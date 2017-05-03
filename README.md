# Silex 2.x + AngularJS 1.x

## Install

1. Setup `docker` and `docker-compose`
1. Run composer via command (in application directory): 
```bash
docker run --rm -it --dns=8.8.8.8 \
    -v $(pwd)/:/app \
    -v /etc/passwd:/etc/passwd:ro \
    -v /etc/group:/etc/group:ro \
    -v /tmp/composer:/composer \
    --user $(id -u):$(id -g) \
    composer install --no-dev --ignore-platform-reqs --no-scripts
```
1. Run `docker-compose -d up`
1. Visit http://silex-angular.lan