<?php namespace NewMarket\Content\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category
 *
 * @author Michal Carson <michal.carson@carsonsoftwareengineering.com>
 *
 * @property integer id
 * @property date created_at
 * @property timestamp updated_at
 * @property timestamp deleted_at
 * @property integer sortorder
 * @property string path
 * @property string title
 * @property string subtitle
 * @property string description
 * @property string meta_title
 * @property string meta_keywords
 * @property string meta_description
 * @property string featured
 * @property string active
 *
 */
class Category extends Model
{

    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'category';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public static function getId($name) {

        $id = \DB::table('category')->where('path', $name)->value('id');
        return $id;

    }

    public static function getPublicCategories() {

        $cats = \DB::table('category')
            ->where('active', true)
            ->whereNull('deleted_at')
            ->orderBy('sortorder')
            ->get();
        return $cats;
    }

    public static function findPublicCategory($path) {

        $cat = \DB::table('category')
            ->where('active', true)
            ->whereNull('deleted_at')
            ->where('path', $path)
            ->first();
        return $cat;
    }
}
