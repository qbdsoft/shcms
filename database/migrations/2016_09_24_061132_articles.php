<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
/*
select
	`c`.`title` AS `category_title`,
	`a`.`title` AS `title`,
	`u`.`name` AS `user_name`,
	`a`.`body` AS `body`,
	`ac`.`category_id` AS `category_id`,
	`a`.`id` AS `article_id`,
	`a`.`user_id` AS `user_id`

	from
		`articles` `a`
		left join `article_category` `ac` on `a`.`id` = `ac`.`article_id`
		left join `categories` `c` on `c`.`id` = `ac`.`category_id`
		left join `users` `u` on `u`.`id` = `a`.`user_id`
 */
class Articles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->longText('body');
            $table->integer('user_id') ->default(0) -> unsigned();
            $table->tinyInteger('version') ->default(0) -> unsigned();
            $table->timestamps();


            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
