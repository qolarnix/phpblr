<?php declare(strict_types=1);

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../bootstrap.php';

use Illuminate\Database\Capsule\Manager;

Manager::schema()->drop('posts');

Manager::schema()->create('posts', function($t) {
    $t->increments('id');
    $t->string('path')->unique();
    $t->string('description');

    // user relation
    $t->integer('user_id')->unsigned();
    $t->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

    // timestamps
    $t->timestamp('created_at')->useCurrent();
    $t->timestamp('updated_at')->nullable();
});