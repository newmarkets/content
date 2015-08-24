<?php namespace NewMarket\Content\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \NewMarket\Content\Models\Article
 */
class Article extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'article';
    }
}
