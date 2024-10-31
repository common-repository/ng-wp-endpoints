<?php
/**
 * NGWPRestAddFields Endpoints Controller Class for adding data to endpoints
 *
 * Creates and adds the fields to existing endpoints.
 *
 * @since 1.0.0
 * @package NGWP Endpoints
 */

include_once 'ng-wp-abstract.php';

/**
 * NGWPRestAddFields
 *
 */
class NGWPRestAddFields extends NGWPAbstract
{

    /**
     * Class constructor.
     *
     * When class is instantiated WP REST API routes are registered.
     */
    public function __construct()
    {
        add_action('rest_api_init', array($this, 'createApiFields'));
    }

    /**
     * Adds post meta fields to api output for post and pages.
     *
     * @return void
     */
    public function createApiFields()
    {
        register_rest_field('page', 'meta-fields',
            array(
                'get_callback' => array($this, 'getPostMeta'),
                'update_callback' => array($this, 'getPostMeta'),
                'schema' => null,
            )
        );
        register_rest_field('post', 'meta-fields',
            array(
                'get_callback' => array($this, 'getPostMeta'),
                'update_callback' => array($this, 'getPostMeta'),
                'schema' => null,
            )
        );
        register_rest_field('page', 'path',
            array(
                'get_callback' => array($this, 'getPostPath'),
                'update_callback' => array($this, 'getPostPath'),
                'schema' => null,
            )
        );
        register_rest_field('post', 'path',
            array(
                'get_callback' => array($this, 'getPostPath'),
                'update_callback' => array($this, 'getPostPath'),
                'schema' => null,
            )
        );
        register_rest_field('category', 'path',
            array(
                'get_callback' => array($this, 'getPostPath'),
                'update_callback' => array($this, 'getPostPath'),
                'schema' => null,
            )
        );
    }

}
