# Influera

Influera is an influencer marketing platform designed to connect brands and influencers through a **Digital DNA matching system**, helping identify authentic and value-aligned collaborations.

## Features

- Brand and influencer profiles
- Digital DNA matching system
- Campaigns and job listings
- Match results and compatibility breakdowns
- Payment workflow logic
- Responsive user interface built with Tailwind CSS

## Tech Stack

- **Backend:** Laravel 12, PHP
- **Database:** MySQL
- **Frontend:** Blade, Tailwind CSS, JavaScript
- **Environment:** Docker, Laravel Sail
- **Build Tools:** Vite, npm
- **Version Control:** Git

## Installation

### Prerequisites

- Docker Desktop
- Git

### Setup

Clone the repository and navigate to the project directory:

```bash
git clone https://github.com/todorovskatamaraa/influera.git
cd influera
```

Create your environment file:

```bash
cp .env.example .env
```

Start the Docker containers:

```bash
./vendor/bin/sail up -d
```

Install PHP dependencies and generate the application key:

```bash
./vendor/bin/sail composer install
./vendor/bin/sail artisan key:generate
```

Configure your database connection in `.env`, then run the migrations:

```bash
./vendor/bin/sail artisan migrate
```

Install frontend dependencies and build the assets:

```bash
./vendor/bin/sail npm install
./vendor/bin/sail npm run build
```

The application should now be ready to run in your local development environment.
