<?php namespace Digart\spectacles\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class PublicationsEtendues extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController',        'Backend\Behaviors\ReorderController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public $requiredPermissions = [
        'digart.spectacles.publications.etendues' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Digart.spectacles', 'communication', 'blog-etendue');
    }
}
