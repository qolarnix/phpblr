<?php declare(strict_types=1);

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../bootstrap.php';

use Illuminate\Database\Capsule\Manager;

Manager::schema()->drop('tags');

Manager::schema()->create('tags', function($t) {
    $t->increments('id');
    $t->string('name');
});

$faker = Faker\Factory::create();

$tags = [];
for($i = 0; $i < 100; $i++) {
    $tag = [
        'name' => $faker->word(),
    ];
    $tags[] = $tag;
}

Manager::table('tags')->insert($tags);