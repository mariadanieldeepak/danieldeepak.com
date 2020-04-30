---
title: "[How To] Checkout Tag On Git Submodules"
date: "2019-11-20T03:30:00Z"
description: "Recently I had to checkout a tag on git repo and all of its submodules. Checking out a repo using a tag is no different from checking out a repo using the branch name. In this post, I'll be explaining how I checked out a tag in a repo and its submodules."
tags: ["php"]
---

To checkout, a tag on repo and all of its submodules, use the following commands.

~~~bash
# List available Tags
git tag

# Checkout a tag in the main repo.
git checkout <tagname>

# Initialize any uninitialized submodule and recursivesly update the Submodules.
git submodule update --init --recursive
~~~

[GitHub Gist](https://gist.github.com/mariadanieldeepak/a8bac3c92cf756ddec16284859614074)