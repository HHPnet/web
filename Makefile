run: composer_install run_server

build:
	docker build -t hhpnet/web .

composer_install:
	docker run --rm -v $(PWD):/app hhpnet/core_composer install

composer_update:
	docker run --rm -v $(PWD):/app hhpnet/core_composer update

test:
	bin/phpcpd ./src/
	bin/phpmd ./src/ text .phpmd.xml
	docker run --rm -v $(PWD):/app hhpnet/core_phpspec run --format=pretty -vvv --ansi

run_server:
	docker-compose up
