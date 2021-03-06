<?php namespace Digart\spectacles\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateDigartSpectaclesCategories extends Migration
{
    public function up()
    {
        Schema::create('digart_spectacles_cat', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('designation', 255);
            $table->string('symbole', 255)->nullable();
            $table->string('slug', 255);
            $table->string('color_txt', 10)->nullable();
            $table->string('color_bg', 10)->nullable();
            $table->string('cltp_cat_id', 5)->nullable(); // Catégorie du Culturoscope
            $table->boolean('is_actif')->nullable()->default(true);
            $table->integer('sort_order')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('digart_spectacles_cat');
    }
}
