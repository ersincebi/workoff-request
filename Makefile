build:
	@docker-compose up -d --build
	@docker exec -i debian_php8 composer install
	@docker exec -i debian_php8 cp .env.example .env
	@docker exec -i debian_php8 php artisan key:generate
	@docker exec -i debian_php8 php artisan migrate

remove:
	@docker-compose down
	@docker system prune -af
	@docker volume prune -f