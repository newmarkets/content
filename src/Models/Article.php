<?php namespace NewMarket\Content\Models;

use NewMarket\Content\Models\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cocur\Slugify\Slugify;
use League\CommonMark\CommonMarkConverter;

/**
 * Class Article
 *
 * @author Michal Carson <michal.carson@carsonsoftwareengineering.com>
 *
 * @property-read integer $id
 * @property-read timestamp $created_at
 * @property-read timestamp $updated_at
 * @property-read timestamp $deleted_at
 * @property timestamp $live_at
 * @property timestamp $down_at
 * @property string $slug
 * @property string $title
 * @property string $subtitle
 * @property string $author
 * @property string $source_name
 * @property string $source_url
 * @property string $description
 * @property string $content
 * @property string $meta_title
 * @property boolean $featured
 * @property boolean $active
 * @property boolean $menu_item
 * @property string $filename
 * @property string $filename_description
 * @property integer $category_id
 *
 */
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
    protected $dates = ['deleted_at', 'live_at', 'down_at'];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function setContentAttribute($value) {
        $replace = ['<span>', '</span>', '<br>', "\r", '&gt;', '&lt;'];
        $with = ['', '', "\n", '', '>', '<'];
        $this->attributes['content'] = trim(str_replace($replace, $with, $value));
    }

    public function xgetContentAttribute($value) {
        return str_replace(["\n", "\r"], ['<br>', ''], $value);
    }

    public static function findPublicArticle($category_id, $slug) {

        return self::where('category_id', $category_id)
            ->where('slug', $slug)
            ->where('active', true)
            ->whereNull('deleted_at')
            ->whereRaw('(live_at <= now() or live_at is null)')
            ->whereRaw('(down_at >= now() or down_at is null)')
            ->first();

    }

    public static function findAdminArticle($category_id, $slug) {

        return self::where('category_id', $category_id)
            ->where('slug', $slug)
            ->first();

    }

    public static function listFromCategoryPublic($category_id) {

        return self::where('category_id', $category_id)
            ->where('active', true)
            ->whereNull('deleted_at')
            ->whereRaw('(live_at <= now() or live_at is null)')
            ->whereRaw('(down_at >= now() or down_at is null)')
            ->orderBy('created_at', 'desc')
            ->get();

    }

    public static function listFromCategoryAdmin($category_id) {

        return self::where('category_id', $category_id)
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'desc')
            ->get();

    }

    public static function makeSlug($title) {

        if (class_exists('\Cocur\Slugify\Slugify')) {
            // use Slugify if it is available
            $ruleset = Config::get('content.slug_ruleset');

            $slugify = new Slugify([
                'regexp' => Config::get('content.slug_regexp'),
                'lowercase' => Config::get('content.slug_lowercase'),
                'separator' => Config::get('content.slug_separator')
            ]);
            if (strlen($ruleset)) {
                $slugify->activateRuleset($ruleset);
            }
            return $slugify->slugify($title);

        } else {
            // use the standard Laravel slug function
            return str_slug($title, Config::get('content.slug_separator'));
        }

    }

    public function preview($len = 400) {

        $content = $this->content;

        if(mb_strwidth($content, 'UTF-8') <= $len) {
            return $content;
        }

        $short = Str::limit($content, $len, '');
        $pos = strrpos($short, ' ');
        $short = Str::limit($content, $pos);

        return $short;

    }

    public function longPreview() {
        return $this->preview(2000);
    }

    public static function renderMarkdown($text) {

        $converter = new CommonMarkConverter();
        return $converter->convertToHtml($text);

    }
}
