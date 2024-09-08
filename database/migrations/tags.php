<?php declare(strict_types=1);

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../bootstrap.php';

use Illuminate\Database\Capsule\Manager;

Manager::schema()->drop('tags');

Manager::schema()->create('tags', function($t) {
    $t->increments('id');
    $t->string('name');

    // index
    $t->index('id');
    $t->index('name');
});