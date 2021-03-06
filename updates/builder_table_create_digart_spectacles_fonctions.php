<?php namespace Digart\spectacles\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateDigartSpectaclesFonctions extends Migration
{
    public function up()
    {
        Schema::create('digart_spectacles_fonctions', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('designation', 255);
            $table->string('abreviation', 15)->nullable();
            $table->text('developpement')->nullable();
            $table->integer('destination')->unsigned()->default(0); // 0 = les deux ; 1 = spectacle ; 2 = representation
            $table->integer('sort_order')->nullable()->unsigned();
            $table->boolean('is_actif')->nullable()->default(1);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('digart_spectacles_fonctions');
    }
}