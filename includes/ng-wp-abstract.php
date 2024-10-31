<?php

defined('ABSPATH') or die("Access Denied!");

abstract class NGWPAbstract
{
    /**
     * Parses url and returns relative path for post or page.
     *
     * @param object $object
     * @return string url path
     */
    public function getPostPath($object)
    {
        $path = '';

        if ($object['link']) {
            $path = rtrim(ltrim(parse_url($object['link'])['path'], '/'), '/');
        }
        return $path;
    }

    /**
     * Returns path to current URL.
     *
     * @param string $itemUrl
     * @return string
     */
    public function getURLPath(string $itemUrl)
    {
        return ltrim(parse_url($itemUrl)['path'], '/');
    }

    /**
     * Returns post meta for current page of post.
     *
     * @param object $object
     * @return mixed Will be an array if $single is false. Will be value of meta data
     *               field if $single is true.
     */
    public function getPostMeta($object)
    {
        return get_post_meta($object['id']);
    }
}
