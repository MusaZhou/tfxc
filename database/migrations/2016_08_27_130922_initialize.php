<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Initialize extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $table){
        	$table->increments('id');
        	$table->string('name');
        	$table->string('phone')->nullable();
        	$table->string('job')->nullable();
        	$table->string('organization')->nullable();
        	$table->string('location')->nullable();
        	$table->string('email')->nullable();
        	$table->string('wechat_name')->nullable();
        	$table->string('wechat_icon')->nullable();
        	$table->string('open_id')->nullable();
        	$table->integer('gender')->unsigned()->nullable();
        	$table->string('note')->nullable();
        	$table->dateTime('created_at')->nullable();
        	$table->dateTime('updated_at')->nullable();
        	
        	$table->softDeletes();
        });
        
        Schema::create('payment_types', function(Blueprint $table){
        	$table->increments('id');
        	$table->string('name')->nullable();
        	$table->dateTime('created_at')->nullable();
        	$table->dateTime('updated_at')->nullable();
        	
        	$table->softDeletes();
        });
        
        Schema::create('vip_orders', function(Blueprint $table){
        	$table->increments('id');
        	$table->decimal('price')->unsigned()->nullable();
        	$table->integer('status')->unsigned()->nullable();
        	$table->integer('user_id')->unsigned()->nullable();
        	$table->dateTime('payment_time')->nullable();
        	$table->integer('payment_type_id')->unsigned()->nullable();
        	$table->dateTime('created_at')->nullable();
        	$table->dateTime('updated_at')->nullable();
        	
        	$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        	$table->foreign('payment_type_id')->references('id')->on('payment_types')->onDelete('cascade');
        	
        	$table->softDeletes();
        });
        
        Schema::create('vip_periods', function(Blueprint $table){
        	$table->increments('id');
        	$table->date('start_date')->nullable();
        	$table->date('end_date')->nullable();
        	$table->integer('user_id')->unsigned()->nullable();
        	$table->integer('vip_order_id')->unsigned()->nullable();
        	$table->dateTime('created_at')->nullable();
        	$table->dateTime('updated_at')->nullable();
        	
        	$table->foreign('user_id')->references('id')->on('users')->onDeletes('cascade');
        	$table->foreign('vip_order_id')->references('id')->on('vip_orders')->onDelete('cascade');
        	
        	$table->softDeletes();
        });
        
        Schema::create('activities', function(Blueprint $table){
        	$table->increments('id');
        	$table->string('name')->nullable();
        	$table->string('description')->nullable();
        	$table->decimal('price')->unsigned()->nullable();
        	$table->dateTime('start_time')->nullable();
        	$table->dateTime('end_time')->nullable();
        	$table->string('address')->nullable();
        	$table->dateTime('created_at')->nullable();
        	$table->dateTime('updated_at')->nullable();
        	
        	$table->softDeletes();
        });
        
        Schema::create('activity_orders', function(Blueprint $table){
        	$table->increments('id');
        	$table->decimal('price')->unsigned()->nullable();
        	$table->integer('user_id')->unsigned()->nullable();
        	$table->integer('activity_id')->unsigned()->nullable();
        	$table->string('note')->nullable();
        	$table->integer('payment_type_id')->unsigned()->nullable();
        	$table->dateTime('payment_time')->nullable();
        	$table->integer('status')->unsigned()->default(1);
        	$table->dateTime('created_at')->nullable();
        	$table->dateTime('updated_at')->nullable();
        	
        	$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        	$table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');
        	$table->foreign('payment_type_id')->references('id')->on('payment_types')->onDelete('cascade');
        	
        	$table->softDeletes();
        });
        
        Schema::create('admins', function(Blueprint $table){
        	$table->increments('id');
        	$table->string('name');
        	$table->string('password');
        	$table->dateTime('created_at')->nullable();
        	$table->dateTime('updated_at')->nullable();
        	
        	$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::drop('admins');
        Schema::drop('activity_orders');
        Schema::drop('activities');
        Schema::drop('vip_periods');
        Schema::drop('vip_orders');
        Schema::drop('payment_types');
        Schema::drop('users');
    }
}
