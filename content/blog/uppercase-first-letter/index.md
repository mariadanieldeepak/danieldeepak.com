---
title: Uppercase First Letter
date: "2020-05-04T15:49:46Z"
description: "A very useful trick that you can use."
---

One of the common operations with strings is to capitalize the first letter of every word especially when writing titles.
Whether you use a server-side language or Javascript to pull your data, you can leverage CSS to 
achieve this. All you need is the [text-transform](text-transform) property.

~~~css
h1 {
  text-transform: capitalize;
}
~~~

[GitHub Gist](https://gist.github.com/mariadanieldeepak/358af2765c01914c1783dc92de89b206)