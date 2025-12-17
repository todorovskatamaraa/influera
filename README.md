# Influentia

Influentia е платформа за маркетинг која ги поврзува брендовите и инфлуенсерите преку Digital DNA matching, со цел автентични и вредносно усогласени соработки.

## Функционалности
- Профили за брендови и инфлуенсери  
- Digital DNA систем за совпаѓање  
- Кампањи и job огласи  
- Приказ на match резултати  
- Escrow логика за плаќања   
- Responsive UI со Tailwind CSS  

## Технологии
- **Backend:** Laravel (PHP)  
- **База на податоци:** MySQL  
- **Frontend:** Blade, Tailwind CSS  
- **Environment:** Docker (Laravel Sail)  
- **Tools:** Vite, Git  


## Инсталација (Docker)

```bash
cp .env.example .env

./vendor/bin/sail up -d

./vendor/bin/sail composer install
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate

./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
