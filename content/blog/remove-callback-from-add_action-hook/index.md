---
title: How To Remove The Callback From The add_action Hook?
date: "2018-09-27T03:30:26Z"
description: "In this post, we shall learn about removing the callback from the add_action WordPress hook."
---

WordPress callback function attached to the `add_action()` hook can be removed using 
`remove_action()`. Refer [WordPress Codex](https://developer.wordpress.org/reference/functions/remove_action/) for details.

~~~php
<?php
// @see https://developer.wordpress.org/reference/functions/remove_action/
remove_action( string $tag, callable $function_to_remove, int $priority = 10 );
~~~

[GitHub Gist](https://gist.github.com/mariadanieldeepak/70abd06d9f3db2c0f469e46f6f8db3df)

Let us look at a real world example. I wanted to remove the Breadcrumb added by WooCommerce in one of the projects in my day job. WooCommerce attaches the `woocommerce_breadcrumb()` callback to the `woocommerce_before_main_content` hook.

~~~php
<?php

/**
 * Breadcrumbs.
 *
 * @see woocommerce_breadcrumb()
 */
add_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
~~~

[GitHub Gist](https://gist.github.com/mariadanieldeepak/478ccde55c48cdd6770ea14b69758153)

And to remove the callback, all I've to do is the following. Remember the `$function_to_remove` and the `$priority` must match in order the remove the callback function.

~~~php
<?php

// To remove a hook, the $function_to_remove and $priority arguments must match with the hook when added.
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
 ~~~
[GitHub Gist](https://gist.github.com/mariadanieldeepak/42d6bde32f5befc6b5bb69259e6ddc0f)