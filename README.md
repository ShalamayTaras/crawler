# crawler


Run

composer install 

docker run --rm -v $(pwd):/app -w /app php:cli php command htts://test-site.com


Run Test

composer install 

docker run --rm -v $(pwd):/app -w /app php:cli php ./vendor/bin/phpunit tests
