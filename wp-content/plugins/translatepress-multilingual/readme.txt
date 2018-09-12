﻿=== TranslatePress - Translate Multilingual sites ===
Contributors: cozmoslabs, razvan.mo, madalin.ungureanu, cristophor
Donate link: https://www.cozmoslabs.com/
Tags: translate, translation, multilingual, automatic translation, bilingual, front-end translation, google translate, language
Requires at least: 3.1.0
Tested up to: 4.9.8
Stable tag: 1.2.9
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Easily translate your entire site directly from the front-end and go multilingual, with full support for WooCommerce, complex themes and site builders. Integrates with Google Translate.
 
== Description ==

**Experience a better way to translate your WordPress site and go multilingual, directly from the front-end using a friendly user interface.**

The interface allows you to easily translate the entire page at once, including output from shortcodes, forms and page builders. It also works out of the box with WooCommerce.

Built the WordPress way, TranslatePress - Multilingual is a GPL and self hosted translation plugin, meaning you'll own all your translations, forever. It's the fastest way to create a bilingual or multilingual site.

https://www.youtube.com/watch?v=pUlYisvBm8g

= Multilingual & Translation Features =

* Translate all your website content directly from the front-end, in a friendly user interface (translation displayed in real-time).
* Fully compatible with all themes and plugins
* Live preview of your translated pages, as you edit your translations.
* Support for both manual and automatic translation (via Google Translate)
* Ability to translate dynamic strings (gettext) added by WordPress, plugins and themes.
* Integrates with Google Translate, allowing you to set up Automatic Translation using your own Google API key.
* Translate larger html blocks by merging strings into translation blocks.
* Select specific html blocks for translation using the css class **translation-block**. `<p class="translation-block">Translate <em>everything</em> inside</p>`
* Place language switchers anywhere using shortcode **[language-switcher]**, WP menu item or as a floating dropdown.
* Editorial control allowing you to publish your language only when all your translations are done
* Conditional display content shortcode based on language [trp_language language="en_US"] English content only [/trp_language]
* Possibility to edit gettext strings from themes and plugins from english to english, without adding another language. Basically a string-replace functionality.
* Translation Block feature in which you can translate multiple html elements together

Note: this plugin uses the Google Translation API to translate the strings on your site. This feature can be enabled or disabled according to your preferences.

Users with administrator rights have access to the following translate settings:

* select default language of the website and one translation language, for bilingual sites
* choose whether language switcher should display languages in their native names or English name
* force custom links to open in current language
* enable or disable url subdirectory for the default language
* enable automatic translation via Google Translate

= Powerful Translation Add-ons =

TranslatePress - Multilingual has a range of premium [Add-ons](https://translatepress.com/?utm_source=wp.org&utm_medium=tp-description-page&utm_campaign=TPFree) that allow you to extend the power of the translation plugin:

**Pro Add-ons** (available in the [premium versions](https://translatepress.com/pricing/?utm_source=wp.org&utm_medium=tp-description-page&utm_campaign=TPFree) only)

* [Extra Languages](https://translatepress.com/docs/addons/seo-pack/?utm_source=wp.org&utm_medium=tp-description-page&utm_campaign=TPFree) - allows you to add an unlimited number of translation languages, with the possibility to publish languages later after you complete the translation
* [SEO Pack](https://translatepress.com/docs/addons/multiple-languages/?utm_source=wp.org&utm_medium=tp-description-page&utm_campaign=TPFree) - allows you to translate meta information (like page title, description, url slug, image alt tag, Twitter and Facebook Social Graph tags & more) for boosting your website's SEO and increase traffic
* [Translator Accounts](https://translatepress.com/docs/addons/translator-accounts/?utm_source=wp.org&utm_medium=tp-description-page&utm_campaign=TPFree) - create or allow existing users to translate the site without admin rights
* [Browse as User Role](https://translatepress.com/docs/addons/browse-as-role/?utm_source=wp.org&utm_medium=tp-description-page&utm_campaign=TPFree) - view and translate content that is visible only to a particular user role
* [Navigation Based on Language](https://translatepress.com/docs/addons/navigate-based-language/?utm_source=wp.org&utm_medium=tp-description-page&utm_campaign=TPFree) - configure and display different menu items for different languages

**Free Add-ons**

* [Language by GET parameter](https://translatepress.com/docs/addons/language-get-parameter/?utm_source=wp.org&utm_medium=tp-description-page&utm_campaign=TPFree) -  enables the language in the URL to be encoded as a GET Parameter

= Website =

[translatepress.com](https://translatepress.com/?utm_source=wp.org&utm_medium=tp-description-page&utm_campaign=TPFree)

= Documentation =

[Visit our documentation page](https://translatepress.com/docs/translatepress/?utm_source=wp.org&utm_medium=tp-description-page&utm_campaign=TPFree)

= Add-ons =

[Add-ons](https://translatepress.com/docs/translatepress/?utm_source=wp.org&utm_medium=tp-description-page&utm_campaign=TPFree)

= Demo Site =

You can test out TranslatePress - Multilingual by [visiting our demo site](https://demo.translatepress.com/)

== Installation ==

1. Upload the translatepress folder to the '/wp-content/plugins/' directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to Settings -> TranslatePress and choose a translation language.
4. Open the front-end translation editor from the admin bar to translate your site.

== Frequently Asked Questions ==

= Where are my translations stored? =

All the translation are stored locally in your server's database.

= What types of content can I translate? =

TranslatePress - Multilingual works out of the box with WooCommerce, custom post types, complex themes and site builders, so you'll be able to translate any type of content.

= How is it different from other multilingual & translation plugins like WPML or Polylang? =

TranslatePress is easier to use and more intuitive altogether. No more switching between the editor, string translation interfaces or badly translated plugins. You can now translate the full page content directly from the front-end. This makes TranslatePress a great alternative to plugins like Polylang and WPML.

= How do I start to translate my site? =

After installing the plugin, select your secondary language and click "Translate Site" to start translating your entire site exactly as it looks in the front-end.

= Where can I find out more information? =

For more information please check out [TranslatePress documentation](https://translatepress.com/docs/translatepress/?utm_source=wp.org&utm_medium=tp-description-page&utm_campaign=TPFree).


== Screenshots ==
1. Front-end translation editor used to translate the entire page content
2. How to translate a Dynamic String (gettext) using TranslatePress - Multilingual
3. Translate Woocommerce Shop Page
4. Settings Page for TranslatePress - Multilingual
5. Floating Language Switcher added by TranslatePress - Multilingual
6. Menu Language Switcher

== Changelog ==
= 1.2.9 =
* Rearranged and renamed some languages in the options dropdown
* Fixed flag of Khmer language
* Added Automatic Language Detection notice and included it on add-ons page
* Fixed an issue with WooCommerce checkout and Stripe Gateway
* Fixed issues with some improper responses from the WP Remote API functions
* Fixed minor issues with ajax

= 1.2.8 =
* Added a lot of hooks in the translation manager interface so other people can insert new content there.
* We now take into account the presence of www or lack of it in custom links that might be local
* We now make sure we're not changing the locale in the backend if the language order is different.
* Fixed issue with incorrect language adding in the backend that caused notices in the front-end
* Removed obsolete function add_cookie
* Fixed trailingslashit over get_permalink in url-converter
* Removed adding cookie from php. Fixed enqueue_styles on license and add-ons tabs. Removed deprecated function.

= 1.2.7 =
* Added a warning when changing the default language that it will invalidate their existing translations
* Fixed incorrect detection of the form action language parameter
* Improved compatibility with themes and plugins that use object buffering
* Fixed some issues with image urls

= 1.2.6 =
* Refactored determining language, redirecting and cookie adding
* Removed leftover trp-gettext tags when WooCommerce is active on some pages
* Fixed get_url_for_language function that was having problems in some cases.

= 1.2.5 =
* Fixed DOM changes script not being enqueued anymore

= 1.2.4 =
* Refactor the shortcode language switcher so it's now HTML similar to the floater
* Added link to Appearance -> menus in TranslatePress settings page
* Fixed language redirect with permalinks so custom parameters are passed correctly back to the url
* Do not load dynamic string translation for IE11 and older

= 1.2.3 =
* Fixed back-end css style not being targeted only for TranslatePress Settings page
* Add filter to not remove detected dynamic strings until the ajax is finished
* Fixed data-no-translation not taken into account in some cases of Dynamic strings
* Fixed translated slug not being included in url sometimes
* Fixed issue with gettext string on non visible html attr that prevented other attr from being translated
* Fixed bug with translating dom changes not working for complex HTML hierarchy
* Corrected flag for Afrikaans.
* Fixed compatibility issues with older jQuery versions

= 1.2.2 =
* Added Translation Block feature in which you can translate multiple html elements together
* Improvement: make it possible for the SEO Addon to automatically translate page slugs using Google Translate
* Fix: using the shortcode language switcher added #trpprocessurl to the end of the url
* Fix: changing languages from a secondary language gave 404 page when the page slug was translated
* Fix: submitting a form from one page to another directed the user to the default language. Now if Force Custom Language Links is enabled the user gets directed to the correct url

= 1.2.1 =
* Extra css for the floater images so they don't brake the line in certain themes
* Fixed compatibility issue with Woocommerce cart widget
* Fix: use the siteurl when the homeurl is empty to detect the language

= 1.2.0 =
* Fix wptexturize changing characters in secondary languages
* Mini refactoring of the url_is_file() function
* Refactor get_url_for_language() to not use the global  var
* We no longer add the language path to links to actual files on the server

= 1.1.9 =
* Fix widget language switcher to take into account the new hreflang

= 1.1.8 =
* Fixed bug with Strings List appearing also in Dynamic Strings List. Also fixed bug with duplicate dynamic strings not having a pencil icon because of missing jquery_object.
* Fixed Woocommerce session storage compatibility
* Fixed language floater not opening on iPhone.
* Fixed issue with normal text nodes that were inside an element that had an atribute with gettext and did not get translated
* Replaced _ with - in hreflang and filter it
* Make force language to custom links set to yes as a default
* Remove intensive functions from inside two loops so they only happen once we detect something in js
* Decode html characters in mutation observed strings and removed stripslashes from trp-ajax.php to fix some strings added with js not being translated

= 1.1.7 =
* Compatibility fix with Elementor Page Builder
* Added translation .pot file
* Add proper encoding for mysqli connection in our trp-ajax.php file so we fixed some translation
* Fixed infinite loop related to mutation observer on javascript strings by not re-adding detected strings again if they are similar to existing ones
* Aligned text from add-ons tab.

= 1.1.6 =
* Added support for translating Contact Form 7 alert messages
* Fixed issue with some strings containing special characters not being translated (i.e. "¿¡")
* Fixed bug with switching languages in Editor when viewing as Logged out
* Fixed issue with broken homepage links in some themes
* Added support for RTL languages in translation editor

= 1.1.5 =
* Added support for translation blocks using the css class .translation-block.
* Added possibility to choose a different language as default language seen by website visitors.
* Updated add-ons settings page with the missing add-ons, added Language by GET parameter addon
* Fixed issue with the [language-switcher] in a post or page that broke saving the page when Yoast SEO plugin is active
* Added a plugin notification class and a notification for pretty permalinks
* Added WooCommerce compatibility tag
* Small css improvements

= 1.1.4 =
* Filter to allow adding new language: 'trp_wp_languages'
* Fixed issue with get_permalink() in ajax calls that was not returning the propper language
* Adapted code to allow language based on a GET parameter
* Fix some issues with language switcher and custom queries as well as take into account if subdirectory for default language is on
* Fixed issue with js translation that was trimming numbers and other characters from strings when it shouldn't

= 1.1.3 =
* Fix issue where the language switcher didn't work for BuddyPress pages
* Fixed issue with CDATA in post content that was breaking the translation
* Added a filter that can be activated and that tries to fix invalid html: trp_try_fixing_invalid_html

= 1.1.2 =
* We now make sure that all forms when submitted redirect to the correct language
* Fixed an issue with missing slash from language switcher
* Fixed an issue where we were not redirecting to the correct url slug when switching languages
* Fixed a possible notice inside the get_language_names function
* Fixed html breaking because of unescaped quotes in translated meta content
* Removed a special character from the full_trim function that was causing some strings to not be selectable for translation

= 1.1.1 =
* Fixed js error with startsWith method not being supported in IE
* Removed unnecessary files from select2 lib
* Improved the way we rewrite urls to remove certain bugs

= 1.1.0 =
* Implemented View As "Logged out user" functionality so you can translate strings that show only for logged out users
* Allow slug edit for default language
* Fixed an issue with the dropdown of translation strings when there were unsaved changes and the dropdown disconected from the textarea
* Prevent translate editor icon pencil to exit the translation iframe
* Fixed translating via the next/prev buttons that reset the position in the translation string list
* Refactor the way we are generating the language url for the language switcher when we don't have a variable available

= 1.0.9 =
* We now flush permalinks when saving the settings page to avoid getting 404 and 500 errors
* Added the current language as a class on the body tag. Ex: translatepress-en_US
* Small readme changes

= 1.0.8 =
* We now allow HTML in normal strings translations.
* Changed the way we get the default language permalinks in Woocommerce rewrites
* Fixed issues with date_i18n function
* Fixed a warning generated when there are no rewrite rules
* Fixed dynamic strings not updating the translation dropdown list.
* Fixed issues with hidden space characters that were breaking some translations
* Make sure we don't loose the trp-edit-translation=preview from url after a WordPress redirect

= 1.0.7 =
* Fixed a small bug in js regarding the translation editor sidebar with
* Fixed Language Switcher for Woocommerce product categories and product tags going to 404 pages
* Fixed issues with Woocommerce and permalinks when the default language was not english
* Excluded more functions from getting gettext wraps

= 1.0.6 =
* Added filter on capabilities to allow other roles to edit translations:'trp_translating_capability'
* Don't show php errors and notices when we are storing strings in the database
* Fixed issues with attributes that contain json content, for instance in woocommerce variations
* We no longer wrap gettext inside the wptexturize function
* We no longer wrap gettexts that appear in the bloginfo function

= 1.0.5 =
* Added possibility to edit gettext strings from themes and plugins from english to english, without adding another language. Basically, string-replace functionality.
* We now can translate text input placeholders
* We have a way of translating emails using the conditional language shortcode [trp_language language="en_US"] English only content [/trp_language]
* Fixed issues with some elements that contained new lines and \u00a0 at the start of the strings

= 1.0.4 =
* Fixed issues with the pencil select icon in the translation editor not showing up in certain cases on the button element
* Fixed issues with the pencil select icon in the translation editor not showing up in certain cases because of overflow hidden
* Fixed a issue that was sometimes causing javascript errors with certain plugins

= 1.0.3 =
* Added a conditional language shortcode: [trp_language language="en_US"] English only content [/trp_language]
* Create link to test out Google API key.
* Improvements to Woocommerce compatibility
* Fixed json_encode error that was causing js errors
* Changed 'template_include' hook priority to improve compatibility with some themes

= 1.0.2 =
* Translation interface improvements
* Fixed issues with strings loaded with ajax
* Added an addon page
* Fixed bug with gettext node accidentally wrapping another string too.

= 1.0.1 =
* Fixed incorrect blog prefix name for Multisite subsites on admin_bar gettext hook.
* Fixed Translate Page admin bar button sometimes not having the correct url for entering TP Editor Mode
* Skipped dynamic strings that have only numbers and special characters.
* Fixed order of categories in Editor dropdown. (Meta Information, String List..)
* Fixed JS error Uncaught Error: Syntax error, unrecognized expression

= 1.0.0 =
* Initial release.