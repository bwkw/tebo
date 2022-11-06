build:
	docker compose build --no-cache --force-rm
init:
	docker compose up -d --build
	docker compose exec app composer install
	docker compose exec app cp .env.example .env
	docker compose exec app php artisan key:generate
	docker compose exec app php artisan storage:link
	@make fresh
up:
	docker compose up -d
down:
	docker compose down
restart:
	@make down
	@make up
ps:
	docker compose ps
app:
	docker compose exec app bash
fresh:
	docker compose exec app php artisan migrate:fresh --seed
db:
	docker compose exec db bash
npm:
	docker compose exec client ash
