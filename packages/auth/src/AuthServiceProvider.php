<?php namespace Adminlte3\Auth;

use App\Models\User;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider {

	/**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // регистрируем namespace для файлов представлений
        $this->loadViewsFrom(__DIR__.'/views', 'auth');

        // Создание нового пользователя
        User::creating(function($user)
        {
            $user->remember_token = str_random(100);
        });

        require __DIR__.'/routes.php';
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}
