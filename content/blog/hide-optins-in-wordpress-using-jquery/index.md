---
title: How To Hide Opt-ins In WordPress Using jQuery?
date: "2017-04-28T03:30:45Z"
description: "In this post I'll share how I managed to hide an Optin, that did not hide as expected even after changing the settings in the OptinMonster plugin."
---

I've been working on one of the WordPress projects, that uses OptinMonster a lot. If you're new to OptinMonster, then checkout OptinMonster's website to learn what it is and what you can do with it.

## What Problem Did I face?

The client wanted to show Optins only for logged-out Users yet the Optins' were popping up even for logged-in users. Normally, we can use Optin Monster's output settings to hide Optins to logged-in users. But in my case, this did not happen and the Optins continued to pop up for all users.

## How Did I Solve?

Having tried the display settings in the Optin Monster plugin, I found from their docs that I 
could use their [Javascript events API](http://optinmonster.com/docs/optinmonster-javascript-events-api/) to stop Optins from popping up. I plugged the following 
snippet only to logged-in Users using [wp\_enqueue\_script](https://developer.wordpress
.org/reference/functions/wp_enqueue_script/) function and [Conditional tags](https://codex.wordpress.org/Conditional_Tags).

~~~js
$( document ).ready(function() {
    $( document ).on("OptinMonsterBeforeShow", function(a, b, c) {
        // Remove all optins whose ID begins with 'om-'
	$( "[id^='om-']" ).remove();
    });
});
~~~

[GitHub Gist](https://gist.github.com/mariadanieldeepak/2a8569ff610e1fa7e05901aafdb2aafc)

This snippet will be handy if you happen to deal with Optins that are real monsters.