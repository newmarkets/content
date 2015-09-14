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

    public function getMenus() {

        return Category::where('active', true)
            ->where('menu', true)
            ->whereNull('deleted_at')
            ->orderBy('sortorder')
            ->get();

    }

    public function hasMenuItems($category_id) {

        return Article::where('category_id', $category_id)
            ->where('active', true)
            ->where('menu_item', true)
            ->whereNull('deleted_at')
            ->whereRaw('(live_at <= now() or live_at is null)')
            ->whereRaw('(down_at >= now() or down_at is null)')
            ->count();

    }

    public function getMenuItems($category_id) {

        return Article::where('category_id', $category_id)
            ->where('active', true)
            ->where('menu_item', true)
            ->whereNull('deleted_at')
            ->whereRaw('(live_at <= now() or live_at is null)')
            ->whereRaw('(down_at >= now() or down_at is null)')
            ->get();

    }

}
