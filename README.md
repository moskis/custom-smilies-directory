=== Custom Smilies Directory ===
Contributors: moskis
Tags: smilies, emoticons, smiley, pack, smilies pack, smiley pack, emoticon pack
Requires at least: 2.8
Tested up to: 3.3
Stable tag: 1.1
License: GPL/MIT

Light plugin that tells WordPress to load Smilies from your theme's directory. This allows you to use custom Smilies without loosing them when you update WordPress.


== Description ==

Custom Smilies Directory is a plugin that tells WordPress to load Smilies from your theme's directory. This allows you to use custom Smilies without loosing them when you update WordPress.

Since version 1.1 plugin will check that the smilies folder exists in the active theme. If it doesn't, it will load the default WordPress smilies and show an error notice in the admin panel letting the user know he has to upload the smilies to the theme directory.


= Where do i find smiley packs? =

You can find many pack in the Internet, by googling for them or searching on sites like deviantArt.com. You can also check out two packs i made a some time ago: [Pack #1](http://josepardilla.com/freebies/moskis-smilies-pack-1/) - [Pack #2](http://josepardilla.com/freebies/moskis-smilies-pack-2/).


== Changelog ==

This changelog is for the WordPress plugin. For the Fancybox main changelog go to its [home page](http://fancybox.net/changelog/).

= 1.1 =
* Plugin now checks that the smilies folder exists in the active theme. If it doesn't, it loads the default WordPress smilies and shows an error notice in the admin panel letting the user know he has to upload the smilies to the theme directory.

= 1.0 =
* Initial release.


== Installation ==

1. Upload the `custom-smilies-directory` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Create a smilies folder in your current theme directory and put your smilies there. files have to match those on `/wp-includes/images/smilies/`
4. You can now have your custom smilies and update WordPress without loosing them.