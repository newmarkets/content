<?php namespace NewMarket\Content\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

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
}
