.PHONY: *

include .env
APP_PATH=${PWD}/app
export

up-%:
	docker-compose --file ./docker/$*/docker-compose.yml up -d --remove-orphans

down:
	docker-compose down --no-build

in-%:
	docker exec -u www-data:www-data -it ${PROJECT_NAME}-$* bash

npm-install:
	docker run --rm -it -v ${PWD}/app:/app -w /app  node:latest bash -c "npm run dev"