<?php namespace NewMarket\Content\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class ContentServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function boot()
    {

        $dir = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;
        $this->loadFrom($dir);
        $this->publishFrom($dir);
        $this->setRoutes();

    }

    protected function loadFrom($dir)
    {

        // Tell Laravel where to find our stock New Market views.
        // Laravel will first look in resources/views/vendor/newmarket/content for a local
        // override. Developers should put customized views into that directory.
        $this->loadViewsFrom("{$dir}views", 'content');

        // Tell Laravel where to find our translation files.
        $this->loadTranslationsFrom("{$dir}translations", 'content');

        // Merge the local config file with ours so we have a complete set of config options.
        // If the config file has been copied to the application's config directory, developers may remove
        // any config options from that file that they don't want to override. If it hasn't been copied,
        // we still have our original distribution config file.
        $this->mergeConfigFrom("{$dir}config" . DIRECTORY_SEPARATOR . 'content.php', 'content');

    }

    protected function publishFrom($dir)
    {

        // This will allow developers to copy all of our views to the vendor directory
        // by running the Artisan command vendor:publish. We use the 'views' tag so the
        // views can be published without other elements using the --tag="views" option.
        $this->publishes(["{$dir}views" => base_path('resources/views/vendor/newmarkets/content')], 'views');

        // This copies our config file to the application's config directory. This also
        // has a tag so it can be published seperately using --tag="config".
        $this->publishes(
            ["{$dir}config" . DIRECTORY_SEPARATOR . 'content.php' => config_path('content.php')],
            'config'
        );

        // This copies our public assets like javascript and css to the application's public directory.
        // It will be in the vendor/newmarket/content subdirectory. Again, the tag allows these assets to be
        // published seperately using --tag="assets".
        $this->publishes(["{$dir}public" => public_path('vendor/newmarkets/content')], 'assets');

    }

    protected function setRoutes()
    {

        // As a default, we will set up a route with the keyword "content" in the URL. Everything under
        // that will be interpreted as an article belonging to some category. The developer can change
        // this in their own routes. For instance, they might want to route everything to the content
        // management system that isn't handled by another route.
        Route::resource('content', 'ContentController');

        // Here we define the administrative routes. These contro handle creation and editing of
        // articles and categories. They use RESTful interfaces.
        Route::resource('article', 'ArticleController');
        Route::resource('category', 'CategoryController');

    }

    public static function compiles() {
        // @todo: fill out the list of compiled classes
    }

}
