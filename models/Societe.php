<?php namespace Digart\spectacles\Models;

use Model;

/**
 * Model
 */
class Societe extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'digart_spectacles_societes';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'raison_sociale' => 'required',
    ];
   
}
