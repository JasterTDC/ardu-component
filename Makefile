build:
	docker build --tag=nginx .

sniffer:
	docker-compose exec nginx /srv/www/vendor/bin/phpcs --standard=PSR2 /srv/www/src/ /srv/www/config/

stan:
	docker-compose exec nginx /srv/www/vendor/bin/phpstan analyze /srv/www/src/ -l 7

test:
	docker-compose exec nginx /srv/www/vendor/bin/phpunit -c /srv/www/phpunit.xml --no-coverage

coverage:
	docker-compose exec nginx /srv/www/vendor/bin/phpunit -c /srv/www/phpunit.xml
