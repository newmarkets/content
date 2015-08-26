<?php namespace NewMarket\Content\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'article';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['live_at', 'down_at'];


    public function howdy() {
        return 'howdy';
    }

    public static function findByCatidSlug($category_id, $slug) {

        $article = \DB::table('article')
            ->where('category_id', $category_id)
            ->where('slug', $slug)
            ->first();
        return $article;

    }
}
