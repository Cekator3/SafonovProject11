<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Request $request): void
    {
        Model::preventLazyLoading(! $this->app->isProduction());
        Model::preventSilentlyDiscardingAttributes(! $this->app->isProduction());
        Model::preventAccessingMissingAttributes(! $this->app->isProduction());
        $this->logDatabaseQueries();
        $this->logHttpQueries($request);
    }

    private function logDatabaseQueries() : void
    {
        DB::listen(function ($query) {
            Log::info("SQL QUERY: {$query->sql}");     
            Log::info("SQL QUERY TIME: {$query->time} ms"); 
        });
    }

    private function logHttpQueries(Request $request): void
    {
        Log::info("HTTP QUERY: {$request->getPathInfo()}");     
    }
}
