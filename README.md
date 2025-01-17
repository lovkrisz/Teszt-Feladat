## Install

git clone https://github.com/lovkrisz/teszt-feladat.git

cp .env.example .env

composer install

npm install

php artisan migrate:fresh --seed

php artisan key:generate

npm run build
