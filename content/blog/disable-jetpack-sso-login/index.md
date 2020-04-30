---
title: "[How To] Disable JetPack SSO In Local/Staging Site?"
date: "2017-01-06T03:30:35Z"
description: "Are you unable to login while setting up a development environment from a production site that uses Jetpack's Single Sign On(SSO)? "
---

I was trying to set up a local (development) site for my personal blog. Since I enabled Jetpack's SSO, the local site redirected to SSO page and took me to my live blog's Dashboard page. So, I was looking for a way to disable Jetpack's SSO.

Here is how to disable Jetpack SSO and login to your local/staging Admin dashboard.

**Step 01: Disable the Jetpack plugin**

You can rename the Jetpack plugin folder and this will disable the plugin without logging into the Admin dashboard.

**Step 02: Access the login page**

Once you disable Jetpack plugin, you can access the /wp-login.php (login page) of your local site.
