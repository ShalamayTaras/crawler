# Crawler

## Run

```docker run --rm --interactive --tty -v "$PWD":/code -v ~/.ssh/:/root/.ssh -w /code composer install```

```docker run --rm -v $(pwd):/app -w /app php:cli php command htts://test-site.com```


## Run Test

```docker run --rm --interactive --tty -v "$PWD":/code -v ~/.ssh/:/root/.ssh -w /code composer install```

```docker run --rm -v $(pwd):/app -w /app php:cli php ./vendor/bin/phpunit tests```

## Result

Generate html report of the work is in the folder ./storage