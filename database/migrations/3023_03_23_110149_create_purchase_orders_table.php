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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_order_num')->nullable(); //
            $table->unsignedBigInteger('facility_id')->nullable();//
            $table->string('status')->default('new');
            $table->unsignedBigInteger('finacial_year')->nullable();//
            $table->string('date_delivered')->nullable();
            $table->longText('delivery_note')->nullable();
            $table->string('delivery_note_num')->nullable();
            $table->string('delivered_by')->nullable();
            $table->string('delivery_vehicle_num')->nullable();
            $table->string('vat')->nullable();
            $table->string('sub_total')->nullable();
            $table->string('total')->nullable();
            $table->string('period');
            $table->timestamps();

            $table->foreign('facility_id')->references('id')->on('facilities');
            $table->foreign('finacial_year')->references('id')->on('financial_years');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_orders');
    }
};
