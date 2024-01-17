<?php namespace WUserApi\JWTPersistentBlacklist;

use Illuminate\Contracts\Cache\Repository;
use System\Classes\PluginBase;
use Tymon\JWTAuth\Providers\Storage\Illuminate;

/**
 * JWTPersistentBlacklist Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name' => 'JWTPersistentBlacklist',
            'description' => 'Adds persistent JWT blacklist in cache.',
            'author' => 'WUserApi',
            'icon' => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {
        $this->app->config
            ->set('cache.stores.jwt', [
                'driver' => 'file',
                'path' => storage_path('framework/jwt'),
            ]);

        $this->app
            ->when(Illuminate::class)
            ->needs(Repository::class)
            ->give(function () {
                return cache()->store('jwt');
            });
    }
}
