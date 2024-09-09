<?php

declare(strict_types=1);

use Illuminate\Database\Capsule\Manager;

/**
 * Create a tag
 */
function tag_create(array $tag_data) {
    $tag_name = $tag_data['name'];
    Manager::table('tags')->insert(['name' => $tag_name]);
}

function add_tag(int $post_id, int $tag_id) {
    Manager::table('tagJoins')->insert(
        ['post_id' => $post_id, 'tag_id' => $tag_id]
    );
}

function remove_tag(int $post_id, int $tag_id) {
    Manager::table('tagJoins')
        ->where('post_id', $post_id)
        ->where('tag_id', $tag_id)
        ->delete();
}

function list_tags(int $post_id) {
    $tags = Manager::table('tagJoins')
        ->take(-1)
        ->where('post_id', $post_id)
        ->get();

    return $tags;
}

function get_tag_posts(int $tag_id) {
    $posts = Manager::table('tagJoins')
        ->take(-1)
        ->where('tag_id', $tag_id)
        ->get();
    
    return $posts;
}