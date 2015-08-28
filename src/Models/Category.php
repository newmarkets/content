<?php namespace NewMarket\Content\Models;

use Illuminate\Database\Eloquent\Model;
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
 * @property string $meta_keywords
 * @property string $meta_description
 * @property boolean $featured
 * @property boolean $active
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

        return self::where('path', $name)->value('id');

    }

    public static function getPublicCategories() {

        return self::where('active', true)
            ->whereNull('deleted_at')
            ->orderBy('sortorder')
            ->get();

    }

    public static function findPublicCategory($path) {

        return self::where('active', true)
            ->whereNull('deleted_at')
            ->where('path', $path)
            ->first();

    }
}
