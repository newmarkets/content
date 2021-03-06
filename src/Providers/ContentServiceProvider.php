<?php namespace NewMarket\Content\Providers;

use Illuminate\Database\QueryException;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use NewMarket\Content\Commands\Install;
use Category;

class ContentServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFacades();
        $this->registerInstallCommand();
    }

    protected function registerFacades()
    {

        $this->app->bind('cms', function () {
            return new \NewMarket\Content\Models\Cms;
        });

        $this->app->bind('article', function () {
            return new \NewMarket\Content\Models\Article;
        });

        $this->app->bind('category', function () {
            return new \NewMarket\Content\Models\Category;
        });

        $loader = AliasLoader::getInstance();
        $loader->alias('Cms', 'NewMarket\\Content\\Facades\\Cms');
        $loader->alias('Article', 'NewMarket\\Content\\Facades\\Article');
        $loader->alias('Category', 'NewMarket\\Content\\Facades\\Category');

    }

    protected function registerInstallCommand()
    {

        $this->app['content::install'] = $this->app->share(function () {
            return new Install;
        });

        $this->commands('content::install');

    }

    public function boot()
    {

        $dir = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;
        $this->loadFrom($dir);
        $this->publishFrom($dir);
        $this->setRoutes();
        $this->extendBlade();

    }

    protected function loadFrom($dir)
    {

        // Tell Laravel where to find our stock New Market views.
        // Laravel will first look in resources/views/vendor/newmarket/content for a local
        // override. Developers should put customized views into that directory.
        $this->loadViewsFrom("{$dir}views", 'newmarkets\content');

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

        if ($this->app->routesAreCached()) {
            return;
        }

        Route::group(['namespace' => 'NewMarket\\Content\\Http\\Controllers'], function ($router) {

            try {
                $cats = Category::getPublicCategories();
            } catch (QueryException $e) {
                // migration has not been run, category table does not exist
                info('CMS routes not available. Run content:install command.');
                return;
            }

            foreach ($cats as $category) {

                $path = $category->path;

                // This defines an administrative route. This controller handles creation and editing of categories.
                // It uses a RESTful interface so it can be called from a javascript application.
                $router->get("$path/article/slug", 'ArticleController@getSlug');
                $router->resource("$path/article", 'ArticleController', ['except' => ['show']]);

                // These define the public routes for this category.
                $router->get("$path/index", 'ContentController@showCategory');
                $router->get("$path/{article}", 'ContentController@showArticle');
                $router->get($path, 'ContentController@showCategory');

            }

            // This defines an administrative route. This controller handles creation and editing of categories.
            // It uses a RESTful interface so it can be called from a javascript application.
            $router->resource(Config::get('content.category_base'), 'CategoryController');

        });

    }

    protected function extendBlade() {

        \Blade::directive('checked', function($expression) {
            return "<?php echo value($expression) ? 'checked' : ''; ?>";
        });

        \Blade::directive('shortdate', function($expression) {
            return "<?php echo substr(value($expression), 0, 10); ?>";
        });

    }

    public static function compiles()
    {
        $dir = dirname(__DIR__);
        return [
            $dir . '/Facades/Article.php',
            $dir . '/Facades/Category.php',
            $dir . '/Facades/Cms.php',
            $dir . '/Http/Controllers/ContentController.php',
            $dir . '/Http/Controllers/Controller.php',
            $dir . '/Models/Article.php',
            $dir . '/Models/Category.php',
            $dir . '/Models/Cms.php',
            $dir . '/Models/Model.php',
            $dir . '/Providers/ContentServiceProvider.php'
        ];
    }

}
