.PHONY: start
start: erase up ## Clean current environment, recreate dependencies and spin up again

.PHONY: stop
stop: ## Stop environment
		docker-compose -f docker-compose.yml stop

.PHONY: erase
erase: ## Stop and delete containers, clean volumes
		docker-compose -f docker-compose.yml stop
		docker-compose -f docker-compose.yml rm -v -f

.PHONY: composer-install
composer-install: ## Install project dependencies
		docker-compose run --rm php sh -lc 'composer install'

.PHONY: composer-update
composer-update: ## Update project dependencies
		docker-compose run --rm php sh -lc 'composer update'

.PHONY: up
up: ## spin up environment
		docker-compose -f docker-compose.yml up -d

.PHONY: phpunit
phpunit: ## execute project unit tests
		docker-compose exec php sh -lc "./vendor/bin/phpunit --testdox"

.PHONY: phpstan
phpstan: ## executes php stan
		docker-compose run --rm php sh -lc './vendor/bin/phpstan analyse'

.PHONY: exec
exec: ## Gets inside a container, use 's' variable to select a service. make exec s=php
		docker-compose exec $(s) bash -l

.PHONY: logs
logs: ## Look for 's' service logs, make s=php logs
		docker-compose logs -f $(s)

.PHONY: network
network: ## Inspect network
		docker-compose exec php ngrep -q -t -l -w -W byline '^(GET|POST|PATCH|HEAD|HTTP)'

.PHONY: help
help: ## Display this help message
	@cat $(MAKEFILE_LIST) | grep -e "^[a-zA-Z_\-]*: *.*## *" | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'
