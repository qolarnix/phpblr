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

function get_tag_sample(array $tag_ids, int $num_posts): object {
    $posts = Manager::table('tagJoins')
        ->whereIn('tag_id', $tag_ids)
        ->select('tag_id', 'post_id')
        ->get();

    $grouped_posts = $posts->groupBy('tag_id');

    $limit_posts = $grouped_posts->map(function($p) use($num_posts) {
        return $p->take($num_posts);
    });

    return $limit_posts;
}

function get_tag(int $tag_id) {
    $tag = Manager::table('tags')->where('id', $tag_id)->get()->first();

    if(is_null($tag)) {
        error_log('Unable to find tag with given id: ' . $tag_id);
        return false;
    }

    return tag_transformer($tag);
}

function tag_transformer(object $args): array {
    $tag_data = [
        'id' => $args->id,
        'name' => $args->name,
    ];
    return $tag_data;
}