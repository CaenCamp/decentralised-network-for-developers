.PHONY: cache-clear

CURRENT_UID=$(shell id -u):$(shell id -g)
export CURRENT_UID

help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

install: ## Install Docker environment
	docker-compose pull

start: ## Start dev env
	docker-compose up -d

stop: ## Stop dev env
	docker-compose down

logs: ## Display logs in development from Docker
	docker-compose logs -f

connect-php: ## Start cli session in the php container
	docker-compose exec php ash 
connect-admin: ## Start cli session in the react-admin container
	docker-compose exec admin ash 

generate-entity-from-schema: ## Generate entities from schema.yaml
	docker-compose exec php vendor/bin/schema generate-types src/ config/schema.yaml

update-db-model-force: ## Tell Doctrine to sync the database tables structure with our new data model
	docker-compose exec php bin/console doctrine:schema:update --force

cache-clear: ## Clear Symfony Cache
    docker-compose exec php bin/console cache:clear
