start:
	php artisan serve --host 0.0.0.0

setup:
	composer install
	cp -n .env.example .env
	php artisan key:gen --ansi
	touch database/database.sqlite
	php artisan migrate
	php artisan db:seed
	npm install
	npm run build

lint:
	composer exec --verbose phpcs -- --standard=PSR12 routes app/Http/Controllers/LabelController.php app/Http/Controllers/TaskController.php app/Http/Controllers/TaskStatusController.php

test:
	php artisan test

test-coverage-text:
	XDEBUG_MODE=coverage composer exec --verbose phpunit tests -- --coverage-text

test-coverage:
	XDEBUG_MODE=coverage composer exec --verbose phpunit tests -- --coverage-clover build/logs/clover.xml

deploy:
	git push heroku main
