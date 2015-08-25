<?php namespace NewMarket\Content\Http\Composers;

use Config;
use Illuminate\Contracts\View\View;

class MasterComposer {

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {

        $factory = $view->getFactory();
        $prefix = Config::get('content.article_prefix');
        $factory->make('newmarkets\content::article')->render();

        $sections = $factory->getSections();

        foreach(['content', 'title'] as $property) {
            $factory->inject($prefix . $property, $sections['cms_article_' . $property]);
            $factory->stopSection();
        }

    }

}
