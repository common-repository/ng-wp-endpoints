# ng-wp-rest
Rest enpoints for WordPress sidebars, menus and widgets

+ Contributors: Anthony Allen
+ Donate link:
+ Tags:
+ Requires at least: 4.0
+ Tested up to: 4.0
+ Stable tag:
+ License: GNU General Public License v3.0
+ License URI: https://github.com/uiarch/ng-wp-rest/blob/master/LICENSE

## Description

Easy to use plugin for displaying prettier json data for menus, widgets and sidebars.

## Installation

1. Upload `ng-wp-rest` to the `/wp-content/plugins/` directory.
2. That is it this plugin just defines some simple rest endpoints for you blog.

## Frequently asked questions

### How does it work?

Simply install it and visit the endpoints defined

Menus

+ http://{url}/wp-json/ng-menu-route/v2/menus/{id}
+ http://{url}/wp-json/ng-menu-route/v2/menus
+ http://{url}/wp-json/ng-menu-route/v2/menu-locations/header-menu
+ http://{url}/wp-json/ng-menu-route/v2/menu-locations

Widgets

+ http://{url}/wp-json/ng-widget-route/v2/widgets/{id}
+ http://{url}/wp-json/ng-widget-route/v2/widgets

Sidebars

+  http://{url}/wp-json/ng-sidbar-route/v2/sidebars/{id}
+  http://{url}/wp-json/ng-sidebar-route/v2/sidebars

Custom Post Types

+  http://{url}/wp-json/ng-post-type-route/v2/post-types/{name}
+  http://{url}/wp-json/ng-post-type-route/v2/post-types/

Meta Fields for sidebars shows on Post and Page default endpoints

+ `"meta-fields":
  {
    "sidebar":["Right Sidebar"]
  }
  `

### Changelog

+ 1.0
  + 02-21-2018
  + Initial release

+ 1.2.1
  + 02-24-2018
  + Updates to endpoints and small bug fix

+ 1.2.2
  + 02-24-2018
  + Custom post types bug fix

+ 1.5.0
  + 03-26-2018
  + Custom post types fix
  + Separated Code into more classes

### Upgrade Notice

+ 1.0
  + 02-21-2018
  + Initial release


## I've got an idea/fix for the template

If you would like to contribute to this template then please fork it and send a pull request. I'll merge the request if it fits into the goals for the template
