<?php

declare(strict_types=1);

echo $view->render('header');

$posts = get_tag_posts(tag_id: 4);
echo 'get all posts with a tag id of 4 <br>';
foreach($posts as $p) {
    print_r($p);
}
echo '<br><br>';

$tags = list_tags(post_id: 8);
echo 'get all tags from a post with id 8 <br>';
foreach($tags as $t) {
    $tag = get_tag($t->tag_id);
    
    echo '<pre>';
    print_r($tag);
    echo '</pre>';
}
?>

<section class="py-12 px-6">
    <div class="mx-auto max-w-7xl">

    </div>
</section>

<?php
echo $view->render('footer');