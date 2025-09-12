.PHONY: all build up down migrate seed storage key reset up-dev up-prod

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
	docker-compose up -d

up-dev-build:
	docker-compose up -d --build

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

# Full reset
reset: down build up-prod

build-backend-image:
	docker build -t ubudab109/myproject-backend:latest ./backend

build-frontend-image:
	docker build -t ubudab109/myproject-frontend:latest -f ./frontend/Dockerfile.prod ./frontend

push-backend-image:
	docker push ubudab109/myproject-backend:latest

push-frontend-image:
	docker push ubudab109/myproject-frontend:latest