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

    /**
     * @doc inherit
     */
    public function setAttribute($key, $value) {

        // Let parent handle mutators
        if ($this->hasSetMutator($key)) {
            parent::setAttribute($key, $value);
        }

        // We are only concerned with date fields that are empty strings.
        // Eloquent does not handle these right. It will set these null dates to
        // the database default format for null dates ('0000-00-00 00:00:00').
        // Let's just pass the database a null and let the database do its job.
        else if (in_array($key, $this->getDates()) && $value == '') {
            $this->attributes[$key] = null;
        }

        else {
            parent::setAttribute($key, $value);
        }

    }

}
