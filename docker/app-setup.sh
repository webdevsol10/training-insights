pecl install redis
docker-php-ext-enable redis

export PATH="$PATH:./vendor/bin"
alias art='php artisan'
alias pu='phpunit'
alias dcp='docker-compose'
