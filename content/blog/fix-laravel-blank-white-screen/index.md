---
title: Does Your Laravel App Shows A Blank White Screen? Here Is What You Should Do.
date: "2018-03-29T11:30:45Z"
---

Let me guess. You developed a Laravel app and deployed it on the Server. When you hit the app's URL, boom, you can only see a blank white screen and nothing else. Frustrating isn't it?

Trust me. It is frustrating and I've been there. In this post, let me share what did I do to resolve it.

## Laravel Server Configuration

I'm using the [Server configuration](https://laravel.com/docs/5
.6/deployment#server-configuration) recommended by [Laravel.com](https://laravel.com/)

Also, my NGINX version is

~~~bash
daniel@myserver:~$ nginx -v
nginx version: nginx/1.10.3 (Ubuntu)
~~~

[GitHub Gist](https://gist.github.com/mariadanieldeepak/d000797b19ee5d983116a726da26ba16)

The configuration recommended by Laravel.com is missing the include `fastcgi.conf;` line. The line is self-explanatory. To include that configuration in the NGINX, in the version that I'm using, all I had to was to include `fastcgi-php.conf`, which contains the `include fastcgi.conf` statement. You can find both `fastcgi.conf` and `snippets/fastcgi-php.conf` configuration files under `/etc/nginx` directory.

~~~bash
location ~ \.php$ {
    // Include the fastcgi-php.conf file.
    include snippets/fastcgi-php.conf;
    fastcgi_pass unix:/run/php/php7.2-fpm.sock;
}
~~~

[GitHub Gist](https://gist.github.com/mariadanieldeepak/d000797b19ee5d983116a726da26ba16)

Once you have added the above line, you can then check the configuration and restart NGINX.

~~~bash
// Checking NGINX config file syntax
sudo nginx -t

// Restart NGINX server
sudo service nginx restart
~~~

[GitHub Gist](https://gist.github.com/mariadanieldeepak/f32c617695c738d55176b0962ae49561)