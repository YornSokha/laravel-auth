<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlmupcAccountingRevenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mlmupc_accounting_revenues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_invoice', 20);
            $table->date('date_expense');
            $table->text('description');
            $table->decimal('riel', 13, 2);
            $table->string('owner', 90);
            $table->text('organization');
            $table->string('payer', 90);
            $table->integer('revenue_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mlmupc_accounting_revenues');
    }
}
