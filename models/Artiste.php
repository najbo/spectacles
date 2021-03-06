<?php namespace Digart\spectacles\Models;

use Model;
use Digart\spectacles\Models\Social;
/**
 * Model
 */
class Artiste extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];

    protected $jsonable = ['membres', 'liens_socials', 'rs'];

    protected $appends = ['full_name'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'digart_spectacles_artistes';


    public $attachMany = [
        'images' => ['System\Models\File', 'public' => true],
        'documents' => ['System\Models\File', 'public' => true],
        'documents_internes' => ['System\Models\File', 'public' => false],
    ];

    public $attachOne = [
        'image' => ['System\Models\File', 'public' => true],
    ];


    /**
     * @var array Validation rules
     */
    public $rules = [
        'designation' => 'required',
        'slug' => ['required', 'regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i', 'unique:digart_spectacles_artistes'],        
    ];

    public $belongsTo = [
        'agent' => ['DigArt\Spectacles\Models\Agent',
                   'key' => 'agent_id',
                   'order' => 'designation'],   
    // Permet d'afficher les réseaux sociaux dans le repeater "Liens réseaux sociaux"
                   
        'social_id' => ['DigArt\Spectacles\Models\Social',
                'key' => 'id',
                'scope' => 'isActive']                                                  
    ];  


    public $belongsToMany = [
        'spectacles' => [
            'DigArt\Spectacles\Models\Spectacle',
            'table' => 'digart_spectacles_spect_art',
        ],
        'spectaclesFrontend' => [
            'DigArt\Spectacles\Models\Spectacle',
            'table' => 'digart_spectacles_spect_art',
            'scope' => 'isFrontend',
        ],  
    ]; 


    // Affiche une liste des artistes qui sont venus
    public function scopeAvecSpectacles($query)
    {
        return $query->has('spectacles');
    }


    public function Trier()
    {

        return $this->where('is_actif',1)->orderBy('designation')->pluck('designation', 'id')->all();
    }


    // Utilisé pour le bouton dropdown sur le formulaire des artistes > réseaux sociaux
    public function getNbreSpectaclesAttribute()
    {
        return $this->spectacles->count();
    }


    public function getSocialIdOptions($value, $data)  
    {
        $social = Social::isActive();    
        return $social->lists('designation', 'id');
    }    

    public function getFullNameAttribute()
    {
        return $this->prenom_civil .' ' . $this->nom_civil;
    }               

    // Usage depuis TWIG : {{ artiste.getCategoryName(artiste.designation)}}
    // Renvoie le logo des réseaux sociaux du champ repeater de l'artiste
    public function getSocial($value) {
        $social = Social::find($value);

        if ($social)
        {
            return $social->icon ;
        }
    }    

    public function getMembresListeAttribute()
    {
        if ($this->membres)
        {
            $valeur = '';
            # return var_dump($this->membres);

            foreach ($this->membres as $membre)
                {
                    $valeur = $valeur . $membre['prenom'].' ' .$membre['nom']. ', ';
                }
            $valeur = rtrim($valeur,', ');
            return $valeur; 
        }
    }


    // Ne fonctionne pas avec les taglists :
    public function getArtisteComplementAttribute()
    {
        return 'hello';
    }
}
