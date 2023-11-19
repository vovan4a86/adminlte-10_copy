<?php namespace Adminlte3;

use Adminlte3\Models\AdminLog;
use Adminlte3\Models\Catalog;
use Adminlte3\Models\News;
use Adminlte3\Models\Page;
use Adminlte3\Models\Product;
use Adminlte3\Models\Review;
use Illuminate\Support\ServiceProvider;

class AdminLogServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {

		Page::created(function($item){
			AdminLog::add('Создана новая страница: ' . $item->name);
		});

		Page::updated(function($item){
			AdminLog::add('Отредактирована страница: ' . $item->name);
		});

		Page::deleting(function($item){
			AdminLog::add('Удалена страница: ' . $item->name);
		});

		Catalog::created(function($item){
			AdminLog::add('Создана новая категория: ' . $item->name);
		});

		Catalog::updated(function($item){
			AdminLog::add('Отредактирована категория: ' . $item->name);
		});

		Catalog::deleting(function($item){
			AdminLog::add('Удалена категория: ' . $item->name);
		});

        Product::created(function($item){
            AdminLog::add('Создан новый товар: ' . $item->name);
        });

        Product::updated(function($item){
            AdminLog::add('Отредактирован товар: ' . $item->name);
        });

        Product::deleting(function($item){
            AdminLog::add('Удален товар: ' . $item->name);
        });

        News::created(function($item){
            AdminLog::add('Создана новость: ' . $item->name);
        });

        News::updated(function($item){
            AdminLog::add('Отредактирована новость: ' . $item->name);
        });

        News::deleting(function($item){
            AdminLog::add('Удалена новость: ' . $item->name);
        });

        Review::created(function($item){
            AdminLog::add('Создан отзыв: ' . $item->name);
        });

        Review::updated(function($item){
            AdminLog::add('Отредактирован отзыв: ' . $item->name);
        });

        Review::deleting(function($item){
            AdminLog::add('Удален отзыв: ' . $item->name);
        });
	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register() {
	}

}
