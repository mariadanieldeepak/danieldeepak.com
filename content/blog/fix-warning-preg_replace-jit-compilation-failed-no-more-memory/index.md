---
title: "Fix Warning: preg_replace(): JIT compilation failed: no more memory"
date: "2019-10-08T03:30:40Z"
description: "In this post I'll share how I resolved "JIT compilation failed: no more memory" error."
---

In my last post, I mentioned that I had to set up MAMP and downgrade Node. After setting up MAMP, I installed WordPress and clone my project to get started with work. However, I ended up with the following error.

~~~php
Warning: preg_replace(): JIT compilation failed: no more memory in 
/Applications/MAMP/htdocs/wordpress/wp-includes/formatting.php on line 2110 
Warning: preg_match(): JIT compilation failed: no more memory in 
/Applications/MAMP/htdocs/wordpress/wp-includes/functions.php on line 4947 
Warning: preg_replace(): JIT compilation failed: no more memory in 
/Applications/MAMP/htdocs/wordpress/wp-includes/functions.php on line 4843 
Warning: preg_match(): JIT compilation failed: no more memory in 
/Applications/MAMP/htdocs/wordpress/wp-includes/functions.php on line 4947 
Warning: preg_match(): JIT compilation failed: no more memory in 
/Applications/MAMP/htdocs/wordpress/wp-includes/functions.php on line 4947
~~~

[GitHub Gist](https://gist.github.com/mariadanieldeepak/79d62db6c4dca055b7125d327856db9e)

As usual StackOverflow [came to my rescue](https://wordpress.stackexchange.com/a/327568/83739).