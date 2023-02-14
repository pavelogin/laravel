<?php

namespace App\Providers;

use App\Http\Kernel;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\PDO\Connection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
       //
        Model::preventLazyLoading(!app()->isProduction());
        Model::preventSilentlyDiscardingAttributes(!app()->isProduction());

        DB::listen(function ($query){
            if ($query->time > CarbonInterval::second()) {
                logger()
                    ->channel('telegram')
                    ->debug('Long query: ' . $query->sql, $query->bindings);
            }
        });

        app(Kernel::class)->whenRequestLifecycleIsLongerThan(
            CarbonInterval::seconds(4),
            static function() {
                //
            }
        );
    }
}
