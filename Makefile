PHP ?= docker-compose run --rm -T app php
COMPOSER ?= docker-compose run --rm -T app composer
CONSOLE ?= docker-compose run --rm -T app bin/console

help: ## ❓ Show this help.
	@printf "\n Available commands:\n\n"
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-25s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m## */[33m/'
.PHONY: help

init: ## 🚀 Start project!
	@$(MAKE) destroy
	@$(MAKE) build
	@$(MAKE) start
	@$(MAKE) vendor
.PHONY: init

build: ## 🏗️ Build docker images.
	docker-compose build
.PHONY: build

vendor: ## 🏗️ Install Composer dependencies.
	@$(DR) $(COMPOSER) install --prefer-dist --no-progress --no-interaction
.PHONY: vendor

start: ## 🚀 Start docker container.
	docker-compose up -d
.PHONY: start

stop: ## 🛑 Stop docker container.
	docker-compose stop
.PHONY: stop

destroy: ## 🛑 Destroy docker container.
	docker-compose down --remove-orphans
.PHONY: destroy

logs: ## 🛑 Destroy docker container.
	docker-compose logs -f
.PHONY: destroy
