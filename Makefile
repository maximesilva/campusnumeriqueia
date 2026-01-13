.PHONY: install env key migrate seed swagger-publish swagger-generate serve start

# Install PHP and Node.js dependencies
install:
	composer install
	npm install
	composer dump-autoload

# Copy environment file
env:
	cp .env.example .env

# Generate application key
key:
	php artisan key:generate

# Run database migrations (incremental)
migrate:
	php artisan migrate

# Fresh migrate and seed the database
seed:
	php artisan migrate:fresh --seed

# Publish L5-Swagger config
swagger-publish:
	php artisan vendor:publish --provider="L5Swagger\L5SwaggerServiceProvider"

# Generate Swagger documentation
swagger-generate:
	php artisan l5-swagger:generate

# Start the Laravel development server
serve:
	php artisan serve

# Full setup and start: install dependencies, setup env, generate key, fresh migrate and seed, setup swagger, and serve
start: install env key seed swagger-publish swagger-generate serve
