<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sap_operations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('operation_type_id');
            $table->foreign('operation_type_id')->references("id")->on("operation_types")->cascadeOnDelete();
            $table->string('title');
            $table->date('date');
            $table->string('subject');
            $table->unsignedDecimal('sum',10,2);
            $table->integer('sap_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sap_operations');
    }
};
