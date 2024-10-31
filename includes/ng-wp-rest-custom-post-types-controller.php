<?php
/**
 * NGWPRestCustomPostTypes Endpoints Controller Class for Custom Post Types
 *
 * Creates and registers the endpoints for menus data.
 *
 * @since 1.2.1
 * @package NGWP Endpoints
 */

include_once 'ng-wp-interface.php';
include_once 'ng-wp-abstract.php';

/**
 * NGWPRestCustomPostTypes
 * Json rest api custom post type endpoints.
 *
 */
class NGWPRestCustomPostTypes extends NGWPAbstract implements NGWPInterface
{

    /**
     * Class constructor.
     *
     * When class is instantiated WP REST API routes are registered.
     */
    public function __construct()
    {
        add_action('ng_wp_rest_register_endpoints', array($this, 'registerRoutes'));
    }

    /**
     * Registers all of our menu rest enpoints.
     *
     * @return void
     */
    public function registerRoutes()
    {
        register_rest_route(self::NG_WP_POST_TYPE_NAMESPACE, '/custom-post-types', array(
            array(
                'methods' => WP_REST_Server::READABLE,
                'callback' => array($this, 'getList'),
            ),
        ));

        register_rest_route(self::NG_WP_POST_TYPE_NAMESPACE, '/custom-post-types/(?P<taxonomy_name>[a-zA-Z0-9_-]+)', array(
            array(
                'methods' => WP_REST_Server::READABLE,
                'callback' => array($this, 'get'),
            ),
        ));

        register_rest_field('post-types', 'path',
            array(
                'get_callback' => array($this, 'getPostPath'),
                'update_callback' => array($this, 'getPostPath'),
                'schema' => null,
            )
        );
    }

    /**
     * Return single custom post type and it's children.
     *
     * @param array $request
     * @return array $restResponse
     */
    public function get($request)
    {
        global $wp_post_types;

        $post_type_name = $request['taxonomy_name'];
        $restResponse = $restResponse = new WP_Error('rest_custom_types_not_found', 'Post Type Not Found', array('status' => 404));
        $rest_post_types = array();

        if (isset($wp_post_types[$post_type_name])) {
            $wp_post_types[$post_type_name]->show_in_rest = true;
            $rest_post_type = $wp_post_types[$post_type_name];
            if (array_key_exists('path', parse_url(get_post_type_archive_link($post_type_name))) && parse_url(get_post_type_archive_link($post_type_name))['path'] !== '') {
                $rest_post_type->path = rtrim(ltrim(parse_url(get_post_type_archive_link($post_type_name))['path'], '/'), '/');
            } else {
                $rest_post_type->path = $post_type_name;
            }
            $rest_post_type->children = $this->getChildren(array('post_type' => $post_type_name));

            $restResponse = new WP_REST_Response($rest_post_type, 200);
        }

        return $restResponse;
    }

    /**
     * Get list of custom post types and their children
     *
     * @return array $restResponse
     */
    public function getList()
    {
        $restResponse = $restResponse = new WP_Error('rest_custom_types_not_found', 'Post Types Not Found', array('status' => 404));

        $args = array(
            'public' => true,
            '_builtin' => false,
        );
        // 'names' or 'objects' (default: 'names')
        $output = 'objects';
        // 'and' or 'or' (default: 'and')
        $operator = 'and';

        $wp_post_types = get_post_types($args, $output, $operator);
        $rest_post_types = [];
        $i = 0;

        if ($wp_post_types) {
            foreach ($wp_post_types as $wp_post_type) {
                $menu = (array) $wp_post_type;
                $rest_post_types[$i]['name'] = $menu['name'];
                $rest_post_types[$i]['description'] = $menu['description'];
                $rest_post_types[$i]['menu_position'] = $menu['menu_position'];
                $rest_post_types[$i]['menu_icon'] = $menu['menu_icon'];
                $rest_post_types[$i]['capability_type'] = $menu['capability_type'];

                if (array_key_exists('path', parse_url(get_post_type_archive_link($menu['name']))) && parse_url(get_post_type_archive_link($menu['name']))['path'] !== '') {
                    $rest_post_types[$i]['path'] = rtrim(ltrim(parse_url(get_post_type_archive_link($menu['name']))['path'], '/'), '/');
                } else {
                    $rest_post_types[$i]['path'] = $menu['name'];
                }

                $rest_post_types[$i]['children'] = $this->getChildren(array('post_type' => $menu['name']));

                $i++;
            }
            $restResponse = new WP_REST_Response($rest_post_types, 200);
        }

        return $restResponse;

    }

    /**
     * Format children for response and get childrens children
     *
     * @param array $childrenArgs
     * @return array $rest_post_children
     */
    public function getChildren(array $childrenArgs)
    {
        $children = get_children($childrenArgs);
        $rest_post_children = [];
        foreach ($children as $childId => $child) {
            $childArray = (array) $children[$childId];

            $rest_post_children[$childId]["ID"] = $childArray["ID"];
            $rest_post_children[$childId]["post_author"] = $childArray["post_author"];
            $rest_post_children[$childId]["post_date"] = $childArray["post_date"];
            $rest_post_children[$childId]["post_date_gmt"] = $childArray["post_date_gmt"];
            $rest_post_children[$childId]["post_content"] = $childArray["post_content"];
            $rest_post_children[$childId]["post_title"] = $childArray["post_title"];
            $rest_post_children[$childId]["post_excerpt"] = $childArray["post_excerpt"];
            $rest_post_children[$childId]["post_status"] = $childArray["post_status"];
            $rest_post_children[$childId]["comment_status"] = $childArray["comment_status"];
            $rest_post_children[$childId]["post_name"] = $childArray["post_name"];
            $rest_post_children[$childId]["post_modified"] = $childArray["post_modified"];
            $rest_post_children[$childId]["post_modified_gmt"] = $childArray["post_modified_gmt"];
            $rest_post_children[$childId]["post_content_filtered"] = $childArray["post_content_filtered"];
            $rest_post_children[$childId]["post_parent"] = $childArray["post_parent"];
            $rest_post_children[$childId]["menu_order"] = $childArray["menu_order"];
            $rest_post_children[$childId]["post_type"] = $childArray["post_type"];
            $rest_post_children[$childId]["post_mime_type"] = $childArray["post_mime_type"];
            $rest_post_children[$childId]["comment_count"] = $childArray["comment_count"];

            // var_dump($child);

            if (array_key_exists('path', parse_url(get_permalink($child)))) {
                $rest_post_children[$childId]['path'] = rtrim(ltrim(parse_url(get_permalink($child))['path'], '/'), '/');
            }

            if (array_key_exists('ID', $childArray)) {
                $args = array(
                    'post_type' => $childrenArgs['post_type'],
                    'post_parent' => $childArray["ID"],
                    'order' => 'ASC',
                    'orderby' => 'menu_order',
                );
                $rest_post_children[$childId]['children'] = $this->getChildren($args);
            } else {
                $rest_post_children[$childId]['children'] = $this->getChildren(array('post_type' => $childArray['post_name']));
            }
        }

        return $rest_post_children;
    }

}
