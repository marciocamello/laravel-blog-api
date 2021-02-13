# Setup

### Requirements

* Windows WSL/WSL2, Linux or Mac
* Docker
* Docker compose

### Run docker environment

```
docker-compose -p laravel_blog -up -d
```

### Access docker workstation

```
docker exec -it php bash
```

### Env config file

```
cp .env.dev .env
```

### Install laravel dependencies

```
composer install
```

### Migrate database
```
php artisan migrate
```
