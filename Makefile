# Makefile for deploying a Laravel application to an O2Switch server

# Server configuration
SSH_USER = dama8690
SERVER_ADDR = dama8690.odns.fr
SSH_KEY = ~/.ssh/o2switch-updaz
SSH_CONNECTION_CMD = $(SSH_USER)@$(SERVER_ADDR) -i $(SSH_KEY)

LOCAL_PROJECT_DIR = ~/Websites/updaz/
REMOTE_PROJECT_DIR = ~/repositories/updaz/

# Laravel specific commands
PHP_CLI = php
COMPOSER = composer
ARTISAN = $(PHP_CLI) artisan

# Local paths
LOCAL_DIR = $(shell pwd)

.PHONY: deploy

deploy-first-time:
	@echo "Laravel app first deployment..."
	ssh $(SSH_CONNECTION_CMD) "cd $(REMOTE_PROJECT_DIR) && git pull origin master && exit"
	make install-laravel-app
	ssh $(SSH_CONNECTION_CMD) "cd $(REMOTE_PROJECT_DIR) && make deploy-laravel-app && exit"


deploy:
	@echo "Laravel app deployment..."
	ssh $(SSH_CONNECTION_CMD) "cd $(REMOTE_PROJECT_DIR) && git pull origin master && make deploy-laravel-app && exit"

install-laravel-app:
	rsync -e "ssh -i $(SSH_KEY)" $(LOCAL_PROJECT_DIR).env.production $(SSH_USER)@$(SERVER_ADDR):$(REMOTE_PROJECT_DIR).env
	php artisan key:generate

deploy-laravel-app: vendor/autoload.php public/storage build-assets generate-sitemap optimize
    php artisan optimize:clear
    #php artisan migrate

public/storage:
    php artisan storage:link

#si le fichier autoload.php n'existe pas ou est moins récent que composer.lock
vendor/autoload.php: composer.lock
	composer install
	touch vendor/autoload.php

#si le fichier manifest.js n'existe pas ou est moins récent que package.json
build-assets:
	npm i
	npm run prod

generate-sitemap:
	php artisan sitemap:generate

optimize: 
	php artisan optimize

# Add more deployment steps as needed (e.g., clearing cache, restarting services, etc.)
# You can extend the Makefile with additional targets and commands.
