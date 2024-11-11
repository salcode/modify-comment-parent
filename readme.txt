=== Modify Comment Parent ===
Contributors: salcode
Tags: comment
Requires at least: 3.6
Tested up to: 4.7
Stable tag: trunk
License: Apache License, Version 2.0
License URI: http://www.apache.org/licenses/LICENSE-2.0

Add a "Parent Comment ID" field to the backend comment edit page.

== Description ==

Sometimes when replying to a comment, I fail to reply and instead create a new
comment. This prevents the comment thread from displaying properly.  In the
past, I've fixed this directly in the database.  This plugin, allows me to fix
it from the backend comment edit screen.

There are other plugins with similar functionality, however they either worked differently than I prefer or included additional functionality. One of these other plugins may meet your needs better.

- [Change Comment Parent](https://wordpress.org/plugins/change-comment-parent/) allows you to modify the parent comment by clicking on the comments on the front-end.
- [Yoast Comment Hacks](https://wordpress.org/plugins/yoast-comment-hacks/) includes many different pieces of comment related functionality, this is one of them.

= Image Credit =

[Pixabay](https://pixabay.com/en/speech-bubbles-dialog-comments-talk-305824/)

= Author =

Built by [Sal Ferrarello](http://salferrarello.com/) / [@salcode](http://twitter.com/salcode)

== Installation ==

1. Install plugin from WordPress plugin repository http://wordpress.org/plugins/
2. Activate Stop Emails through the 'Plugins' menu in WordPress.

= Manual Installation =

1. Upload the entire `stop-emails` directory to the `/wp-content/plugins/` directory.
2. Activate Stop Emails through the 'Plugins' menu in WordPress.

= mu-plugin Installation =

1.  If the directory `wp-content/mu-plugins/` does not exist, create it.
2.  Upload the single file `modify-comment-parent.php` to the  `wp-content/mu-plugins/` directory

== Frequently Asked Questions ==

= What if I assign a parent ID that does not exist? =

The comment will not appear.

= What if I assign a parent ID for a comment on another post? =

The comment will not appear.

= How do I remove the parent ID? =

You can either delete the parent ID entirely or set it to zero.

= Where can I report a bug? =

Please report bugs at https://github.com/salcode/modify-comment-parent/issues

== Screenshots ==

1. The backend comment edit page.
1. The new Comment Parent field.

== Changelog ==

= Unreleased =
* Replace `FILTER_SANITIZE_STRING` with `FILTER_UNSAFE_RAW` ([#2](https://github.com/salcode/modify-comment-parent/issues/2))

= 1.0.1 =
* Increase text input box width. Previously, it was too narrow for large numbers.

= 1.0.0 =
* Initial release.
