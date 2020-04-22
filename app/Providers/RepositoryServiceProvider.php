<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    private $group = array(
        // events
        array(
            'interface' => 'App\Repositories\Interfaces\EventRepositoryInterface',
            'repository' => 'App\Repositories\EventRepository',
            'service' => 'App\Services\EventService',
            'model' => [
                'App\Models\Event',
                'App\Models\Date'
            ]
        ),
    );
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {   
        foreach ($this->group as $key => $item) {
            $this->app->bind($item['interface'], function ($app) use ($item) {
                if (is_array($item['model'])) {
                    $models = [];
                    foreach ($item['model'] as $model) {
                        $models[] = new $model();
                    }
                    return new $item['repository'](...$models);
                } else {
                    return new $item['repository'](new $item['model']());
                }
            });
            $this->app->bind($item['service'], function ($app) use ($item) {
                return new $item['service'](
                    $app->make($item['interface']));
            });
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
