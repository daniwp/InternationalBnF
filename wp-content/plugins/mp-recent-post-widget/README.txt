=== MP Recent Post Widget ===
Contributors: MediumPixel
Tags: post, widget, recent post widget, thumbnail, post meta
Requires at least: 4.4
Tested up to: 4.5.3
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Recent Post Widget with date, author and post thumbnail

== Description ==
Recent Post Widget with date, author and post thumbnail. Its highly customizable for every theme developer to make change as his / her need.

= Links =
* [Github](https://github.com/MediumPixel/mp-recent-post-widget/?utm_medium=referral&utm_source=wordpress.org&utm_campaign=Recent+Post+Widget+ReadMe&utm_content=Repo+Link)

== Installation ==

### Automatic Install From WordPress Dashboard

1. Login to your the admin panel
2. Navigate to Plugins -> Add New
3. Search **MP Recent Post Widget**
4. Click install and activate respectively.

### Manual Install From WordPress Dashboard

If your server is not connected to the Internet, then you can use this method-

1. Download the plugin by clicking on the red button above. A ZIP file will be downloaded.
2. Login to your site's admin panel and navigate to Plugins -> Add New -> Upload.
3. Click choose file, select the plugin file and click install

### Install Using FTP

If you are unable to use any of the methods due to internet connectivity and file permission issues, then you can use this method-

1. Download the plugin by clicking on the red button above. A ZIP file will be downloaded.
2. Unzip the file.
3. Launch your favorite FTP client. Such as FileZilla, FireFTP, CyberDuck etc. If you are a more advanced user, then you can use SSH too.
4. Upload the folder to wp-content/plugins/
5. Log in to your WordPress dashboard.
6. Navigate to Plugins -> Installed
7. Activate the plugin

== Screenshots ==

1. Settings Panel
2. Widget Settings
3. Widget Output

== Frequently Asked Questions ==

= How to change thumbnail size =

- Login to WordPress admin panel
- Goto **Settings => MP Recent Post** and change your image thumbnail size.
- Then Regenerate Image Thumbnail
- If you are a theme developer you can change sizes by `mp_recent_post_widget_thumbnail_size` filter.

= How to change layout =

- Make a directory named `mp-widgets` on your theme directory.
- Just copy `mp-recent-post-widget.php` file from `templates` directory and copy it to `mp-widgets` directory.
- Make changes as your need.

= How to disable loading current css file =

- If you are a theme developer you can just `wp_deregister_style('mp-recent-post-widget')`

= How to modify widget fields =

- Just use `mp_recent_post_widget_form_fields` filter to change fields

== Changelog ==

= 1.0.0 =

Initial release