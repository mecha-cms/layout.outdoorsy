<?php

if (isset($state->x->tag)) {
    $tags = [];
    $tags_found = [];
    foreach (g($folder = LOT . D . 'page' . ($route ?? $state->routeBlog), 'page') as $k => $v) {
        $page = new Page($k);
        $v = (array) ($page->kind ?? []);
        $v && ($tags_found = array_merge($tags_found, $v));
    }
    foreach (array_count_values($tags_found) as $k => $v) {
        if ($n = To::tag($k)) {
            if (is_file($f = LOT . D . 'tag' . D . $n . '.page')) {
                $tag = new Tag($f);
                if ($page = exist([
                    $folder . '.archive',
                    $folder . '.page'
                ], 1)) {
                    $tag->parent = new Page($page);
                }
                $tags[$tag->link] = $tag->title . ' <span class="count">' . $v . '</span>';
            }
        }
    }
    asort($tags);
    echo $tags ? self::widget('list', [
        'title' => $title ?? i('Tags'),
        'lot' => $tags
    ]) : self::widget([
        'title' => $title ?? i('Tags'),
        'content' => '<p>' . i('No %s yet.', ['tags']) . '</p>'
    ]);
} else {
    echo self::widget([
        'title' => $title ?? i('Tags'),
        'content' => '<p>' . i('Missing %s extension.', ['<a href="https://mecha-cms.com/store/extension/tag" target="_blank">tag</a>']) . '</p>'
    ]);
}