<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('name');
            $table->string('stripe_id');
            $table->string('stripe_plan');
            $table->string('plan_id');
            $table->integer('business_id')->default(0);
            $table->enum('status',['1','0'])->default(0);
            $table->integer('price')->default(0);
            $table->string('o_interval')->default(0);
            $table->integer('is_checking_in')->nullable();
            $table->integer('last_usage_date')->default(0);
            $table->integer('checkin_code')->default(0);
            $table->integer('quantity')->nullable();
            $table->integer('uses')->nullable();
            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamp('ends_at')->nullable();
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
        Schema::dropIfExists('subscriptions');
    }
}
