<?php namespace Digart\spectacles\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateDigartSpectaclesStatuts extends Migration
{
    public function up()
    {
        Schema::create('digart_spectacles_statuts', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('designation', 255);
            $table->text('developpement')->nullable();
            $table->integer('sort_order')->nullable()->unsigned();
            $table->boolean('is_actif')->nullable()->default(1);
            $table->boolean('is_spectacle')->nullable()->default(1);
            $table->boolean('is_saison')->nullable()->default(0);
            $table->boolean('is_brouillon')->nullable()->default(0);
            $table->boolean('is_frontend')->nullable()->default(1);
            $table->boolean('is_complet')->nullable();
            $table->boolean('is_annule')->nullable();
            $table->boolean('is_reporte')->nullable();
            $table->boolean('is_prog_souhait')->nullable();
            $table->boolean('is_prog_confirme')->nullable();
            $table->boolean('is_reservable')->nullable();

            $table->boolean('is_event_cltp')->nullable();
            $table->boolean('is_date_cltp')->nullable();
            $table->string('cltp_event_status_id', 25)->nullable(); // Indique le status d'un spectacle pour le Culturoscope
            $table->string('cltp_date_status_id', 25)->nullable();  // Indique le status d'une représentation pour le Culturoscope

            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('digart_spectacles_statuts');
    }
}
