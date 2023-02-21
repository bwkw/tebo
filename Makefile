build:
	docker compose build --no-cache --force-rm
init:
	@make build
	docker compose run client npm install
	@make up
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
.PHONY: client
client:
	docker compose exec client sh
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
	docker compose exec app php artisan test --env=testing
test-parallel:
	docker compose exec app php artisan test --parallel --env=testing
npm:
	docker compose exec client ash
lint:
	docker compose exec client npm run lint
phpcs:
	docker compose exec app composer phpcs
phpcbf:
	docker compose exec app composer phpcbf
