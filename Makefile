start:
	php artisan serve --host 0.0.0.0

setup:
	composer install

lint:
	composer exec --verbose phpcs -- --standard=PSR12 routes

test:
	php artisan test

test-coverage-text:
	XDEBUG_MODE=coverage composer exec --verbose phpunit tests -- --coverage-text

test-coverage:
	XDEBUG_MODE=coverage composer exec --verbose phpunit tests -- --coverage-clover build/logs/clover.xml

deploy:
	git push heroku main