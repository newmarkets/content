<?php namespace NewMarket\Content\Models;

use NewMarket\Content\Models\Model;
use Illuminate\Support\Facades\Config;

/**
 * Class CMS
 *
 * @author Michal Carson <michal.carson@carsonsoftwareengineering.com>
 *
 */
class Cms extends Model
{

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function getCategories() {
        return Category::getPublicCategories();
    }
}
