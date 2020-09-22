<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlmupcAccountingExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mlmupc_accounting_expenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_letter', 20);
            $table->date('date_expense');
            $table->text('description');
            $table->string('expense_type', 2);
            $table->decimal('riel', 13, 2);
            $table->decimal('dollar', 13, 2);
            $table->string('reciever', 90);
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
        Schema::dropIfExists('mlmupc_accounting_expenses');
    }
}
