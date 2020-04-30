---
title: Should You Unit Test Private Methods Of A Class?
date: "2016-09-01T03:30:43Z"
description: "Have you wondered if you have to write unit tests for private methods of a class? In this post, I'll answer that question for you."
---

This question is answered with the context of WordPress in mind. But this serves as a general rule, irrespective of the language.

I fell in love, once again, with WordPress so much that I started contributing to few open source projects.

I began [my contribution](/blog/first-pull-request/) by fixing small bugs. Lately, when I was writing test cases for a 
WordPress plugin, I had this question, "Should we write unit test case(s) for the private methods of a class?"

I didn't have an answer for a moment, but then I figured that the private methods are used by the public methods. By writing test cases for the public methods of a class, we cover testing the functionality of the private methods. So the answer my question is 'No, we don't have to write unit tests for private methods of a class'.

### What Should You Do If A Private Method Warrants Testing?

Even after covering the public method that uses the private method, if your private method warrants test to cover, then you should probably think of breaking the private method into smaller units. The basic rule is that a function must do only one specific thing.

In order to verify my understanding, I did a quick Google search and found that Brian, a software
 developer, had mentioned the same in his [blog](https://myadventuresincoding.wordpress.com/2008/03/05/unit-testing-private-methods/).