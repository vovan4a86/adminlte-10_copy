<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Adminlte3\Events\BuildingMenu;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Event::listen(BuildingMenu::class, function (BuildingMenu $event) {
            // Add some items to the menu...
            $event->menu->add([
                'text' => 'Dashboard',
                'url' => '/admin',
                'icon' => 'fa fa-anchor mr-1',
            ]);
            $event->menu->add('НАВИГАЦИЯ');
            $event->menu->add([
                'text' => 'Структура сайта',
                'url' => 'admin/pages',
                'icon' => 'fa fa-clone mr-1',
            ]);
            $event->menu->add([
                'text' => 'Каталог',
                'url' => 'admin/catalog',
                'icon' => 'fa fa-bars mr-1',
            ]);
            $event->menu->add([
                'text' => 'Новости',
                'url' => '#',
                'icon' => 'fa fa-calendar mr-1',
                'submenu' => [
                    [
                        'text' => 'Новости',
                        'url' => 'admin/news',
                        'icon' => 'fa fa-calendar mr-1',
                    ],
                    [
                        'text' => 'Категории',
                        'url' => 'admin/news-categories',
                        'icon' => 'fa fa-calendar mr-1',
                    ],
                ]
            ]);
            $event->menu->add([
                'text' => 'Отзывы',
                'url' => 'admin/reviews',
                'icon' => 'fa fa-comment mr-1',
            ]);
            $event->menu->add('НАСТРОЙКИ ПРОФИЛЯ');
            $event->menu->add([
                'text' => 'Пользователи',
                'url' => 'admin/users',
                'icon' => 'fa fa-users mr-1',
                'label' => User::all()->count(),
                'label_color' => 'success',
            ]);
            $event->menu->add('НАСТРОЙКИ САЙТА');
            $event->menu->add([
                'text' => 'Общие',
                'url' => 'admin/settings',
                'icon' => 'fa fa-cogs mr-1',
            ]);
        });
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
