<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';
    
    protected $adminNamespace = 'App\Http\Controllers\Admin';
    
    protected $userNamespace = 'App\Http\Controllers\User';
    
    protected $wechatNamespace = 'App\Http\Controllers\Wechat';
    
    protected $generalNamespace = 'App\Http\Controllers';
    
    protected $webNamespace = 'App\Http\Controllers\Web';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
//         $this->mapApiRoutes();
    	$this->mapWebRoutes();
    	$this->mapAdminRoutes();
    	$this->mapGeneralRoutes();
    	$this->mapUserRoutes();
    	$this->mapWechatRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::group([
            'middleware' => 'web',
            'namespace' => $this->webNamespace,
        ], function ($router) {
            require base_path('routes/web.php');
        });
    }
    
    protected function mapAdminRoutes()
    {
    	Route::group([
    			'middleware' => 'web',
    			'namespace' => $this->adminNamespace,
    			'prefix' => 'admin',
    	], function ($router) {
    		require base_path('routes/admin.php');
    	});
    }
    
    protected function mapUserRoutes()
    {
    	Route::group([
    			'middleware' => 'web',
    			'namespace' => $this->userNamespace,
    			'prefix' => 'user',
    	], function ($router) {
    		require base_path('routes/user.php');
    	});
    }
    
    protected function mapWechatRoutes()
    {
    	Route::group([
    			'middleware' => ['web', 'wechat.oauth', 'userCheck'],
    			'namespace' => $this->wechatNamespace,
    			'prefix' => 'wechat',
    	], function ($router) {
    		require base_path('routes/wechat.php');
    	});
    }
    
    protected function mapGeneralRoutes()
    {
    	Route::group([
    			'namespace' => $this->generalNamespace
    	], function ($router) {
    		require base_path('routes/general.php');
    	});
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::group([
            'middleware' => 'api',
            'namespace' => $this->namespace,
            'prefix' => 'api',
        ], function ($router) {
            require base_path('routes/api.php');
        });
    }
}
