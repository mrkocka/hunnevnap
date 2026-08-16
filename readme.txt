=== HunNévnap ===
Contributors: mrkocka
Tags: elementor, name day, date, clock, hungarian
Requires at least: 6.5
Tested up to: 7.0
Requires PHP: 7.2
Stable tag: 2.1.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Display Hungarian name days, the date, and a live clock in a customizable Elementor widget.

== Description ==

HunNévnap is an Elementor widget for websites that want to display Hungarian name days together with the current date and time.

The date, time, and name-day list can be enabled or disabled independently. Each part has separate color and typography controls. The widget supports responsive vertical and horizontal layouts, alignment, and adjustable spacing for desktop, tablet, and mobile views.

The clock updates every second and follows the time zone configured in WordPress. The date follows the site's date-format setting. Hungarian name-day data is bundled locally with the plugin, so no external API or service is required.

HunNévnap does not collect, store, or transmit personal data. It does not add tracking code or contact external servers.

Features:

* Native Elementor widget.
* Independently configurable date, time, and name-day sections.
* Responsive vertical or horizontal layout.
* Separate typography and color controls.
* Uses the WordPress time zone and date format.
* Locally bundled Hungarian name-day data.
* No external API, tracking, or data collection.

Learn more at [hunnevnap.hu](https://hunnevnap.hu).

== Installation ==

1. Install and activate Elementor 3.5.0 or newer.
2. Upload the `hun-nevnap` folder to `/wp-content/plugins/`, or install the plugin ZIP from the WordPress Plugins screen.
3. Activate HunNévnap.
4. Open a page in Elementor and search for the "HunNévnap" widget in the General category.
5. Add the widget and customize its content and appearance controls.

== Frequently Asked Questions ==

= Does the plugin require Elementor? =

Yes. Elementor 3.5.0 or newer must be installed and activated.

= Does the plugin use an external name-day API? =

No. The Hungarian name-day data is included in the plugin.

= Does the plugin collect personal data? =

No. HunNévnap does not collect, store, or transmit personal data and does not contact external servers.

= Which time zone does the clock use? =

The clock follows the time zone configured under Settings > General in WordPress.

= Can the date, time, and name days be styled separately? =

Yes. Each section has individual color and typography controls in Elementor.

== Changelog ==

= 2.1.0 =
* Added separate style controls for the date, time, and name-day sections.
* Added responsive vertical and horizontal layouts.
* Added responsive spacing between widget items.
* Prepared the plugin for WordPress.org distribution and translation.

= 2.0.1 =
* Fixed a JavaScript observer loop that could freeze the Elementor editor.

= 2.0.0 =
* Replaced the shortcode with a native Elementor widget.
* Added configurable date, time, and name-day visibility.
* Added Elementor style controls.
* Added conditional JavaScript and CSS loading.
* Added Elementor dependency checks.
