<?php namespace Digart\spectacles\Models;

use Model;

/**
 * Model
 */
class Institution extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sortable;
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'digart_spectacles_instit';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'designation' => 'required'

    ];

    public $attachOne = [
        'image_communication' => ['System\Models\File', 'public' => true]
    ];  

    public function getInstitutionActiveAttribute(){
        if (! $this->is_defaut) {
            return $this->designation;
        }
    }

}
