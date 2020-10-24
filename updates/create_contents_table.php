<?php namespace Meevo\Gutenberg\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateContentsTable extends Migration
{
    public function up()
    {
        Schema::create('meevo_gutenberg_contents', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('raw_content')->nullable();
            $table->text('rendered_content')->nullable();
            $table->morphs('contentable');
            $table->string('type')->default('page');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('meevo_gutenberg_contents');
    }
}
