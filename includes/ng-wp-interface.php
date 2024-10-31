<?php

defined('ABSPATH') or die("Access Denied!");

/**
 * NG-WP Plugin interface
 *
 * ** Required Methods **
 *
 * - @method get(string $request)
 * - @method getList()
 * - @method registerRoutes()
 */
interface NGWPInterface
{
    const NG_WP_API_NAMESPACE = 'wp/v2';
    const NG_WP_MENU_NAMESPACE = 'ng-menu-route/v2';
    const NG_WP_WIDGET_NAMESPACE = 'ng-widget-route/v2';
    const NG_WP_SIDEBAR_NAMESPACE = 'ng-sidebar-route/v2';
    const NG_WP_POST_TYPE_NAMESPACE = 'ng-custom-post-type-route/v2';

    /**
     * Get method for returning single item.
     *
     * @param object $request
     * @return void
     */
    public function get($request);

    /**
     * Get list method for returning multiple items.
     *
     * @return void
     */
    public function getList();

    /**
     * Registers endpoints for current object.
     *
     * @return void
     */
    public function registerRoutes();
}
