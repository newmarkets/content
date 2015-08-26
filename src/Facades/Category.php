<?php namespace NewMarket\Content\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \NewMarket\Content\Models\Category
 */
class Category extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'category';
    }
}
