CERTBOT=docker-compose run --rm certbot
WEBROOT=./certbot/www
EMAIL=rizkyfirdaus0309@gmail.com


.PHONY: all build up down migrate seed storage key reset up-dev up-prod ssl-backend ssl-frontend ssl-renew

# Build production
build:
	docker-compose -f docker-compose.yaml build

# Run production
up-prod:
	docker-compose -f docker-compose.yaml up -d

up-prod-build:
	docker-compose -f docker-compose.yaml up -d --build

# Run development
up-dev:
	docker-compose -f docker-compose.override.yaml up -d

up-dev-build:
	docker-compose -f docker-compose.override.yaml up -d --build

# Stop containers
down:
	docker-compose down

# Laravel artisan commands
migrate:
	docker-compose exec backend php artisan migrate

seed:
	docker-compose exec backend php artisan db:seed

storage:
	docker-compose exec backend php artisan storage:link

key:
	docker-compose exec backend php artisan key:generate

stop:
	docker-compose stop

# Full reset
reset: down build up-prod

build-backend-image:
	docker build -t ubudab109/myproject-backend:latest -f ./backend/Dockerfile.prod ./backend

build-frontend-image:
	docker build -t ubudab109/myproject-frontend:latest -f ./frontend/Dockerfile.prod ./frontend

push-backend-image:
	docker push ubudab109/myproject-backend:latest

push-frontend-image:
	docker push ubudab109/myproject-frontend:latest

ssl-backend:
	$(CERTBOT) certonly --webroot --webroot-path=$(WEBROOT) \
		--email $(EMAIL) --agree-tos --no-eff-email \
		-d api.rizkydausprofile.site

# Issue SSL for frontend (React)
ssl-frontend:
	$(CERTBOT) certonly --webroot --webroot-path=$(WEBROOT) \
		--email $(EMAIL) --agree-tos --no-eff-email \
		-d rizkydausprofile.site

# Renew all SSL certificates
ssl-renew:
	$(CERTBOT) renew