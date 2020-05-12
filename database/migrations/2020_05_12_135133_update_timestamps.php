<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTimestamps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('UPDATE `users` SET `created_at` = CURRENT_TIMESTAMP   WHERE `created_at` is null and `id` <999999999;');
        DB::statement('UPDATE `users` SET `updated_at` = CURRENT_TIMESTAMP   WHERE `updated_at` is null and `id` <999999999;');

        DB::statement('ALTER TABLE `users` CHANGE `created_at` `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;');
        DB::statement('ALTER TABLE `users` CHANGE `updated_at` `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;');
         
        DB::statement('UPDATE `roles` SET `created_at` = CURRENT_TIMESTAMP   WHERE `created_at` is null and `id` <999999999;');
        DB::statement('UPDATE `roles` SET `updated_at` = CURRENT_TIMESTAMP   WHERE `updated_at` is null and `id` <999999999;');

        DB::statement('ALTER TABLE `roles` CHANGE `created_at` `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;');
        DB::statement('ALTER TABLE `roles` CHANGE `updated_at` `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;');

        DB::statement('UPDATE `tags` SET `created_at` = CURRENT_TIMESTAMP   WHERE `created_at` is null and `id` <999999999;');
        DB::statement('UPDATE `tags` SET `updated_at` = CURRENT_TIMESTAMP   WHERE `updated_at` is null and `id` <999999999;');

        DB::statement('ALTER TABLE `tags` CHANGE `created_at` `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;');
        DB::statement('ALTER TABLE `tags` CHANGE `updated_at` `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;');
         
        DB::statement('UPDATE `subscribers` SET `created_at` = CURRENT_TIMESTAMP   WHERE `created_at` is null and `id` <999999999;');
        DB::statement('UPDATE `subscribers` SET `updated_at` = CURRENT_TIMESTAMP   WHERE `updated_at` is null and `id` <999999999;');

        DB::statement('ALTER TABLE `subscribers` CHANGE `created_at` `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;');
        DB::statement('ALTER TABLE `subscribers` CHANGE `updated_at` `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;');

        DB::statement('UPDATE `posts` SET `created_at` = CURRENT_TIMESTAMP   WHERE `created_at` is null and `id` <999999999;');
        DB::statement('UPDATE `posts` SET `updated_at` = CURRENT_TIMESTAMP   WHERE `updated_at` is null and `id` <999999999;');

        DB::statement('ALTER TABLE `posts` CHANGE `created_at` `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;');
        DB::statement('ALTER TABLE `posts` CHANGE `updated_at` `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;');

        DB::statement('UPDATE `post_tag` SET `created_at` = CURRENT_TIMESTAMP   WHERE `created_at` is null and `id` <999999999;');
        DB::statement('UPDATE `post_tag` SET `updated_at` = CURRENT_TIMESTAMP   WHERE `updated_at` is null and `id` <999999999;');

        DB::statement('ALTER TABLE `post_tag` CHANGE `created_at` `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;');
        DB::statement('ALTER TABLE `post_tag` CHANGE `updated_at` `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;');

        DB::statement('UPDATE `comments` SET `created_at` = CURRENT_TIMESTAMP   WHERE `created_at` is null and `id` <999999999;');
        DB::statement('UPDATE `comments` SET `updated_at` = CURRENT_TIMESTAMP   WHERE `updated_at` is null and `id` <999999999;');

        DB::statement('ALTER TABLE `comments` CHANGE `created_at` `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;');
        DB::statement('ALTER TABLE `comments` CHANGE `updated_at` `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;');

        DB::statement('UPDATE `category_post` SET `created_at` = CURRENT_TIMESTAMP   WHERE `created_at` is null and `id` <999999999;');
        DB::statement('UPDATE `category_post` SET `updated_at` = CURRENT_TIMESTAMP   WHERE `updated_at` is null and `id` <999999999;');

        DB::statement('ALTER TABLE `category_post` CHANGE `created_at` `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;');
        DB::statement('ALTER TABLE `category_post` CHANGE `updated_at` `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;');

        DB::statement('UPDATE `categories` SET `created_at` = CURRENT_TIMESTAMP   WHERE `created_at` is null and `id` <999999999;');
        DB::statement('UPDATE `categories` SET `updated_at` = CURRENT_TIMESTAMP   WHERE `updated_at` is null and `id` <999999999;');

        DB::statement('ALTER TABLE `categories` CHANGE `created_at` `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;');
        DB::statement('ALTER TABLE `categories` CHANGE `updated_at` `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;');



        
         
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
