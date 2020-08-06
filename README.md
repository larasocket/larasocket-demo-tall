Welcome to the larasocket.com demo repository using Tailwind, Alpine, Livewire, and Laravel. 

You can follow along [here](https://medium.com/@zachvv11/real-time-chat-room-with-larasocket-tailwind-alpine-livewire-and-laravel-406a8c5e680d).

# Getting Started
1. `git clone git@github.com:larasocket/larasocket-demo-tall.git`
1. `cd larasocket-demo-tall`
1. `composer install`
1. `cp .env.example .env`
1. `php artisan key:generate`
1. Update your `.env` file with your `LARASOCKET_TOKEN`. You can get one for free at [Larasocket](https://larasocket.com)
1. `php artisan migrate`
1. `php artisan serve`
1. Head over to: http://localhost:8000/chat to try out the demo.
