<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->string('status');
           // $table->timestamp('status_at'); // дата изменения статуса, или вести отдельную таблицу с историей статусов
           // $table->string('status_comment')->nullable(); // какой-то комент например админа, почему например отменил или еще что

            $table->string('currency_id');
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->decimal('amount', 12, 2);

            /*$table->string('payable_type'); // полиморфные отношения
            $table->integer('payable_id');*/ // или прописываем руками колонки или используем morphs

            $table->morphs('payable');

            /*$table->foreignId('method_id')->nullable(); //эти две строки идентичны constrained
            $table->foreign('method_id')->references('id')->on('payment_methods');*/

            $table->foreignId('method_id')->nullable()->constrained('payment_methods');

            $table->string('driver')->nullable();
           // $table->timestamp('expires_at'); // истечение срока платежа. если человек не оплатил в течении какого-то времени
                                                // и по истечении срока отменять его, например через команду крон

            $table->string('driver_currency_id')->nullable()->comment('Валюта провайдера');
            $table->foreign('driver_currency_id')->references('id')->on('currencies');
            $table->decimal('driver_amount', 12, 2)->nullable();
            $table->string('driver_payment_id')->nullable()->comment('ID платежа провайдера');

            $table->timestamps();

            // необходимо хранить разные комиссии платежей. потому что они постоянно меняются. и у каждого платежа
            // может быть своя комиссия на момент создания платежа и не одна.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
