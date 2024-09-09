<?php 

declare(strict_types=1);

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../bootstrap.php';

use Illuminate\Database\Capsule\Manager;

Manager::schema()->drop('tagJoins');

Manager::schema()->create('tagJoins', function($t) {
    // post id
    $t->integer('post_id')->unsigned();
    $t->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');

    // tag id
    $t->integer('tag_id')->unsigned();
    $t->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
});

$faker = Faker\Factory::create();

$joins = [];
for($i = 0; $i < 100; $i++) {
    $join = [
        'post_id' => $faker->randomDigit(),
        'tag_id' => $faker->randomDigit()
    ];
    $joins[] = $join;
}

Manager::table('tagJoins')->insert($joins);