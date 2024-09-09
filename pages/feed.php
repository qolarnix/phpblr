<?php

declare(strict_types=1);

echo $view->render('header');

$posts = get_tag_posts(tag_id: 4);
foreach($posts as $p) {
    print_r($p);
}
echo '<br><br>';

$tags = list_tags(post_id: 8);
foreach($tags as $t) {
    print_r($t);
}
?>

<section class="py-12 px-6">
    <div class="mx-auto max-w-7xl">

    </div>
</section>

<?php
echo $view->render('footer');