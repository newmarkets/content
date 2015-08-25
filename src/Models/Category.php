<?php namespace NewMarket\Content\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function getId($name) {

        $id = DB::table('category')->where('name', $name)->value('id');
        return $id;

    }
}
