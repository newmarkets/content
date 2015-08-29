<?php namespace NewMarket\Content\Models;

use Illuminate\Database\Eloquent\Model;
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
 * @property string $meta_keywords
 * @property string $meta_description
 * @property boolean $featured
 * @property boolean $active
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
    protected $dates = ['live_at', 'down_at'];


    public function howdy() {
        return 'howdy';
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
            ->where('active', true)
            ->whereNull('deleted_at')
            ->whereRaw('(live_at <= now() or live_at is null)')
            ->whereRaw('(down_at >= now() or down_at is null)')
            ->orderBy('created_at', 'desc')
            ->get();

    }

    public static function makeSlug($title) {

        $ruleset = Config::get('content.slug_ruleset');
        $regexp = Config::get('content.slug_regexp');

        $slugify = new Slugify($regexp, [
            'lowercase' => Config::get('content.slug_lowercase')
        ]);
        if (strlen($ruleset)) {
            $slugify->activateRuleset($ruleset);
        }
        return $slugify->slugify($title, Config::get('content.slug_separator'));

    }

    public function preview($len = 400) {

        $content = $this->content;

        if(strlen($content) <= $len) {
            return $content;
        }

        $short = substr($content, 0, $len);
        $pos = strrpos($short, ' ');
        $short = substr($content, 0, $pos);

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
