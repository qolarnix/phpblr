<?php declare(strict_types=1);

global $template;

$router->get('/', function() use($template) {
    echo $template->render('feed');
});

$router->get('/upload', function() use($template) {
    echo $template->render('upload');
});