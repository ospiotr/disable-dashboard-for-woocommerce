=== Disable WooCommerce Bloat ===
Contributors: ospiotr
Tags: woocommerce,remove dashboard,disable woocommerce admin,disable analytics,remove woocommerce bloat,remove woocommerce dashboard, skyverge
Stable tag: trunk
Requires at least: 5.0
Tested up to: 5.6
Requires PHP: 5.6
WC requires at least: 4.0
WC tested up to: 5.2
Donate link: https://www.paypal.com/donate?hosted_button_id=VHFM47MRPMTYG
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html

== Disable unnecessary WooCommerce features ==

Disable unnecessary WooCommerce features and make your shop <strong>faster</strong> and <strong>cleaner</strong>. If you don't like or don't need the new bloatware features, use this plugin and forget about them forever.

It may be a good idea for small shops to disable the features that are slowing your page down. Simplify your WooCommerce admin panel. Use <strong>good, old, clean, fast</strong> WooCommerce!


== Disable WooCommerce Bloat  ==

Disable bloatware features introduced in WooCommerce 4.0 and later:

- WooCommerce Admin (Dashboard)
- Analytics (New reports view)
- Notification bar
- Marketing Hub
- Home screen

== Clean Admin interface ==

Make your admin panel faster and cleaner:

- Disable WooCommerce.com notice (`Connect your store to WooCommerce.com to receive extensions updates and support.`)
- Disable WooCommerce Status Meta Box
- Disable Marketplace Suggestions
- Disable WooCommerce Extensions submenu

== Increase your site performance ==

Disable these options to make your shop faster:

- Password Strength Meter
- WooCommerce scripts and styles
- WooCommerce Cart Fragments
- WooCommerce Widgets

Declutter your WordPress admin panel by removing third-party bloat:

- SkyVerge Dashboard (only if you are using SkyVerge plugins)
- Jetpack promotions (Jetpack-related notices that promote services like the backup services VaultPress or WordPress Apps. only if your are using Jetpack)
- Elementor Dashboard overview widget (only if you are using Elementor)

== USAGE ==
Go to configuration page: <strong>WooCommerce -> Settings -> Advanced -> Disable WooCommerce Bloat</strong>.
<i>Please remember to reload the page after saving changes to see the results.</i>

== Advanced ==
If you want to completely get rid of WooCommerce Admin and make your database smoother, don't forget to manually remove these tables from your database:

- wp_wc_admin_notes	
- wp_wc_admin_note_actions	
- wp_wc_category_lookup	 	
- wp_wc_customer_lookup
- wp_wc_order_coupon_lookup
- wp_wc_order_product_lookup
- wp_wc_order_stats
- wp_wc_order_tax_lookup

== Installation ==

1. Upload the entire `disable-dashboard-for-woocommerce` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. WooCommerce Admin will be disabled by default
4. Go to configuration page: WooCommerce -> Settings -> Advanced -> Disable WooCommerce Bloat

== Screenshots ==
 
1. This plugin disables the WooCommerce Admin package in WooCommerce.
2. Disable WooCommerce Analytics and deactivate WC Admin
3. Disable WooCommerce Admin and Marketing Hub
4. Disable WooCommerce.com notice and WooCommerce Status Meta Box
5. Disable other WooCommerce features that affect performance
6. Disable third-party bloat like SkyVerge Dashboard and Jetpack promotions


== Changelog ==

= 2.4.4 =
- Fixed conflict with AutomateWoo

= 2.4.3 =
- Fixed error upon activation in WooCommerce 5.0

= 2.4.2 =
- Fixed fatal error on Reports page in WooCommerce 5.0

= 2.4.1 =
- Added compatibility with WooCommerce 5.0

= 2.4 =
- Added option to disable Elementor Dashboard widget
- Added option to disable WooCommerce Extensions admin submenu
- Fixed Cart Fragments label

= 2.3 =
- Fixed field labels
- Fixed readme
- Added donation link

= 2.2 =
- Fixed warning
- Added option to disable Jetpack promotions

= 2.1 =
- Added third-party section
- Added option to disable SkyVerge Dashboard
- Added option to disable Marketplace Suggestions
- Changed fields' description and plugin readme 

= 2.0 =
- Added Settings page
- Added options to disable: WooCommerce Status Meta Box, Password Strength Meter, WooCommerce scripts and styles, WooCommerce Cart Fragmentation, WooCommerce Widgets

= 1.1 =
- Added filter to remove Marketing hub introduced in WooCommerce 4.1
- Added filter to remove `Connect your store to WooCommerce.com to receive extensions updates and support.` message for WooCommerce.com plugins

= 1.0.1 =
- Added multisite compability
- Added support for all user roles

= 1.0 =
- First release