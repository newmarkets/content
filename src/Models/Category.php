<?php namespace NewMarket\Content\Models;

use NewMarket\Content\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category
 *
 * @author Michal Carson <michal.carson@carsonsoftwareengineering.com>
 *
 * @property-read integer $id
 * @property-read timestamp $created_at
 * @property-read timestamp $updated_at
 * @property-read timestamp $deleted_at
 * @property integer $sortorder
 * @property string $path
 * @property string $title
 * @property string $subtitle
 * @property string $description
 * @property string $meta_title
 * @property boolean $featured
 * @property boolean $active
 * @property boolean $menu
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

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public static function getId($name) {

        return self::where('path', $name)->value('id');

    }

    public static function getPublicCategories() {

        return self::where('active', true)
            ->whereNull('deleted_at')
            ->orderBy('sortorder')
            ->get()
            ->all();

    }

    public static function getAdminCategories() {

        return self::orderBy('sortorder')
            ->get()
            ->all();

    }

    public static function findPublicCategory($path) {

        return self::where('active', true)
            ->whereNull('deleted_at')
            ->where('path', $path)
            ->first();

    }

    public static function findAdminCategory($path) {

        return self::where('path', $path)
            ->orderBy('active', 'desc')
            ->first();

    }
}
