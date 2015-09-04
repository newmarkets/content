<?php namespace NewMarket\Content\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
/**
 * Class Article
 *
 * @author Michal Carson <michal.carson@carsonsoftwareengineering.com>
 *
 */
class Model extends EloquentModel {


    /**
     * @doc inherit
     */
    protected function asDateTime($value) {

        if (in_array($value, ['0000-00-00 00:00:00', '0000-00-00'])) {
            return null;
        }
        return parent::asDateTime($value);

    }

}
