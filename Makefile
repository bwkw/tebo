build:
	docker compose build --no-cache --force-rm
init:
	docker compose up -d --build
	docker compose exec app composer install
	docker compose exec app cp .env.example .env
	docker compose exec app php artisan key:generate
	docker compose exec app php artisan storage:link
	@make db-fresh
up:
	docker compose up -d
down:
	docker compose down --remove-orphans
restart:
	@make down
	@make up
ps:
	docker compose ps
app:
	docker compose exec app bash
db:
	docker compose exec db bash
db-migrate:
	docker compose exec app php artisan migrate
db-fresh:
	docker compose exec app php artisan migrate:fresh --seed
test-db:
	docker compose exec test-db bash
test-db-migrate:
	docker compose exec app php artisan migrate --env=testing
test:
	docker compose exec app php artisan test
test-parallel:
	docker compose exec app php artisan test --parallel
npm:
	docker compose exec client ash
phpcs:
	docker compose exec app composer phpcs
phpcbf:
	docker compose exec app composer phpcbf