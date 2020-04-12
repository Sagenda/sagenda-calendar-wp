=== Sagenda - Free booking calendar  ===
Contributors: sagenda
Donate link: http://www.sagenda.com/community/
Tags: booking, appointment, scheduling, availability, reservation, rental, free, accommodation, booking form, calendar
Requires at least: 3.0
Requires PHP: 5.6
Tested up to: 5.4
Stable tag: 2.0.0 beta
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin is the new mobile calendar (and list) view of Sagenda
📅 Sagenda is a free online booking / scheduling / reservation module that helps your clients fix appointments at absolutely NO COST!

== Description ==

📅 Sagenda is an online booking software that helps your clients fix appointments and meetings with you online. Sagenda is available at absolutely NO COST for you or your clients! And the best thing about it is that you may have an unlimited number of bookings and/or customers. Our users always come first; that’s why Sagenda doesn’t display ads!

[Contact & Support](http://www.sagenda.com/#contact "We love hearing from you!") | [YouTube Chanel](http://www.youtube.com/sagenda "Get a look at our tutorials!") | [Open an account](https://sagenda.net/Accounts/Register "Open a free account now!")

This is an “Online Booking System” which gives customers the opportunity to choose the date and the time of an appointment according to one's own preferences and the booking can now be done online.

Using this WP plugin is a better way to display your booking on your WP frontend than using an iFrame. Using this Plugin will required a free Sagenda's account. To **create an account** please visit: [https://sagenda.net/Accounts/Register](https://sagenda.net/Accounts/Register)

You can use PayPal as payment gateway to make your customers pay for bookings. They can pay via PayPal account but also via direct credit card payment (without creating a PayPal account). Following cards are accepted : Visa, MasterCard, American Express, Discover, JCB, Diner's Club, EnRoute...

**NOTE: You need to register an account on the Sagenda site and then you will get an authentication code which you will use to validate your Sagenda plugin.**

**Shortcode**
You can use Sagenda as shortcode in any page or plugin :
`[sagenda-calendar-wp]`

You can force the Calendar to display only one bookable item. Please then use the shortcode like this :
`[sagenda-calendar-wp fixedbookableitem="x"]`
where x is the "id" of your bookable item. To know the id of your bookable item, you can just go to your bookable item list :  [https://sagenda.net/BookableItems/List](https://sagenda.net/BookableItems/List) and select "edit". You can then copy the ID with the copy button. 
You can also use this feature with URL query parameter such as adding ?fixedbookableitem="x" to your URL. Please don't use both shortcode and query parameter "fixedbookableitem" in the same time. 

You can choose the default view 
`[sagenda-calendar-wp defaultView="x"]`
where x is the "month", "week" or "day".

You can unactivate view(s)
`[sagenda-calendar-wp removeMonthViewButton="true" removeWeekViewButton="true" removeDayViewButton="true"]`
This will simply remove the corresponding button to switch from a view to another one.


**Prerequisites**
SAGENDA WP PLUGIN REQUIRE ⚠️ PHP 5.6 or 7.x  !
⚠️ FOR YOUR OWN SAFETY DON'T USE PHP VERSION OLDER THAN 7.2 THERE IS NO SECURITY PATCH ⚠️
[http://php.net/supported-versions.php](http://php.net/supported-versions.php)

Sagenda WP plugin require the PHP "Curl extension" to be activated on your hosting to call web services.

== Installation  ==

How to install this booking plugin into my WordPress website?

[youtube https://www.youtube.com/watch?v=_pdbEgqJxoQ]

How to create a Sagenda’s account in video?

[youtube https://www.youtube.com/watch?v=T-NXXxPSTQs]

Follow these steps to install Sagenda:

1. Download the booking plugin into the **/wp-content/plugins/** folder and activate the plugin.
2. Create a free account on https://sagenda.net/Accounts/Register (setup your “bookable items” and events).
3. Copy your token (from the backend of sagenda.net Settings / account settings) to your WordPress installation (backend of wp / Settings / Sagenda).
4. Use the shortcode `[sagenda-calendar-wp]` in a page or an article.


SUPPORT THIPS : any error message? try to update to the last version of WordPress and use PHP 7 or higher !

**Calendar view settings**
Sagenda's calendar view will read your WordPress Settings : myURL/wp-admin/options-general.php
The language of the calendar will match "Site Language" parameter.
The Date and time format will match "Date Format" / "Time Format" parameters.
The calendar will start on "Week Starts On" parameter.

**Known issues**
Problem with our plugin? are you using a caching system? Try to remove "w3 Total Cache" and use "Super Cache" or "WP Rocket".



= LANGUAGE / TRANSLATIONS =

We are translated in many languages. Want more languages? Help us :

Calendar public views :
[https://osp7icw.oneskyapp.com/admin/project/dashboard/project/142348](https://osp7icw.oneskyapp.com/admin/project/dashboard/project/142348)

WordPress plugin txt :
[http://osp7icw.oneskyapp.com/admin/project/dashboard/project/101655](http://osp7icw.oneskyapp.com/admin/project/dashboard/project/101655)

We will add your translations in the next release!

== Screenshots ==
1. Yes a nice (monthly) calendar view that is mobile friendly!
2. Oh yes, you can display week also.
3. Guess what... yes day view!
4. For sure, Agenda view! Ok you can call it list view also.
5. Ok almost the same view but you can have event with more than one seat to be booked.
6. Yes this form can be editer from your Sagenda.net account.
7. How to identify my Sagenda account in WordPress? Copy the authentication code (token) from your Sagenda account and paste it into your WordPress installation

composer update
== Upgrade Notice ==
= 2.0.0-BETA-1 =
BETA VERSION : DO NOT USE FOR PROD!
* DEBUG : Oh... so much mess cleaned ;-)


== Changelog ==

= 2.0.0-ALPHA-3 =
ALPHA VERSION : DO NOT USE FOR PROD!
* DEBUG : Add event title of the event pattern to the frontend when asked by the Sagenda's account owner.
* UPDATED : Updated to Angular 9.1


= 2.0.0-ALPHA-2 =
ALPHA VERSION : DO NOT USE FOR PROD!
* DEBUG : Correct multiple reservation bug.
* DEBUG : Improve date and time formatting when a date is over several days but without hours (all day event).
* DEBUG : Remove "reservation title" if there's no reservation to display.


= 2.0.0-ALPHA-1 =
ALPHA VERSION : DO NOT USE FOR PROD!
* ADDED : New calendar with Agenda view.
* ADDED : You can now display bookings in public view (optional).
* TESTED : PHP 7.4.x
* TESTED : WordPress 5.4
* UPDATED : Updated composer package (phpunit-bridge) to solve security advisory GHSA-w2fr-65vp-mxw3 (moderate severity).
* LIMITATION : This version can't manage "Agenda" view for default nor activation/desactivation feature.

= 1.5.0 =
* ADDED : improved support for customization edition form.
* FIXED : A bug when adding another member for multiple booking and when not having customized fields.
* FIXED : A bug when starting the week view with monday instead of sunday, the date displayed on the header where not updated.
* TESTED : tested WordPress 5.3.

= 1.4.0 =
* ADDED : First support for customization edition form.

= 1.3.1 =
* FIXED : An error message if PayPal module not activated even if there's not paid event.

= 1.3.0 =
* ADDED : Event title (when checked "display in frontend") can be now displayed also in the calendar view. Was only in list view until today.
* ADDED : Coupon code. If your customers book a paid event, they can now enter coupon code (aka : discount code).
* IMPROVED : if there's a paid event and the payment module isn't activated we display an error message.
* IMPROVED : registration form layout is better (again).

= 1.2.0 =
* ADDED : Support for right to left languages.
* FIXED : A bug displaying the bookable item's location and description twice.
* IMPROVED : registration form layout.

= 1.1.0 =
* ADDED : You can now choose the default view: month, week or day by using a shortcode.
* ADDED : You can now remove views: "month, week or day" by using a shortcode.
* ADDED : Translations.

= 1.0.0 =
* ADDED : we can now select a fixed bookable item by shortcode or URL query.
* IMPROVED : List of events on the registration view are grouped by bookable items.
* TESTED : tested WordPress 5.2.

= 0.9.0 =
* ADDED : As user I'm not authorised to book less / more than quota defined in Sagenda's account by admin.
* ADDED : As admin I can define Taxes and Fees for online payment.
* TRANSLATIONS : Added multiple persons translations.

= 0.8.3 =
* IMPROVED : Added no index at the root of the plugin.
* TESTED : WordPress 5.1.1
* TESTED : PHP 7.3.1
* TRANSLATIONS : Updated French, Russian, Hebrew, Italian...


= 0.8.2 =
* FIXED : correct a text problem displaying payment for any event, even those without payment


= 0.8.1 =
* FIXED : layout problem with Nisarg theme.


= 0.8.0 =
* FIXED : improve layout and font rendering and avoid conflict with existing theme.


= 0.7.5 =
* FIXED : compatibility with Guttenberg and Twenty Nineteen theme.


= 0.7.4 =
* TRANSLATIONS : Updated to match the new

= 0.7.3 =
* FIXED : Bug of formatting event displayed after 23:00.
* FIXED : Bug when displaying snack bar notification making a dirty table border layout.
* TRANSLATIONS : Make 2 different translations for : pt_PT, pt_BR, instead of one (pt).

= 0.7.2 =
* IMPROVED : Time format in the left margin of the week and day view is also customizable.

= 0.7.1 =
* IMPROVED : Messaging.
* IMPROVED : Display a message if it's not allowed to add more member to the booking.
* TRANSLATIONS : Added Latvian translations, improved : arabic, romanian and more...

= 0.7.0 =
* ADDED : Add new feature : multi person booking. You can now enter the name of several persons when booking a reservation.
* FIXED : Enable multi-booking by default.

= 0.6.1 =
* FIXED : Bug of date time format with Safari on macOSX and iOS.

= 0.6.0 =
* ADDED : Range selection for Multi booking option.
* FIXED : Bug when loading the default bookable item.

= 0.5.1 =
* FIXED : don't let user book paid events using different currencies, what isn't allowed by PayPal.

= 0.5.0 =
* ADDED : Multi booking option.
* IMPROVED : translations.

= 0.4.2 =
* IMPROVED : it is not possible to put on the same page : several Sagenda lists and one Sagenda calendar (not several due to Angular restrictions).
* FIXED : a bug making conflict with the website "base href".
* TRANSLATIONS : Lots of new translations.

= 0.4.1 =
* FIXED : a bug when the frontend customization module wasn't activated.

= 0.4.0 =
* IMPROVED : displaying date and time in a better way.
* IMPROVED : displaying events of several days.
* UPDATED : moved to Angular 6.0.0.

= 0.3.0 =
* IMPROVED : token communication.
* ADDED : You can now customize the button background color.
* TRANSLATIONS : Added Catalan and 🇫🇮 Finish translations.

= 0.2.0 =
* FIXED : A problem when displaying "all day" events in the week view.
* ADDED : You can now customise also some text color from your sagenda's account.
* TRANSLATIONS : Added Dutch & Italian translations.
* TESTED : WordPress 4.9.5.

= 0.1.0 =
🚀 Shoot for the moon ! 🌝 and help us with translations : [https://osp7icw.oneskyapp.com/admin/project/dashboard/project/142348](https://osp7icw.oneskyapp.com/admin/project/dashboard/project/142348)
* ADDED : You can now customise the button text color from your sagenda's account.
* IMPROVED : Give notification in case the user didn't entered the token, didn't created bookable items or can't display any event.
* TRANSLATIONS : Added 🇷🇺 Russian, 🇺🇦 Ukrainian and 🇪🇸 Spanish translations.

= 0.0.2 - ALPHA version =
HELP US WITH TRANSLATIONS OF NEW CALENDAR VIEWS : [https://osp7icw.oneskyapp.com/admin/project/dashboard/project/142348](https://osp7icw.oneskyapp.com/admin/project/dashboard/project/142348)
* FIXED : Correct a problem of saving "courtesy" value.
* FIXED : Date rendering.
* TRANSLATIONS : Added Slovak translations (thanks to danielberta).

= 0.0.1 - ALPHA version =
HELP US WITH TRANSLATIONS OF NEW CALENDAR VIEWS : [https://osp7icw.oneskyapp.com/admin/project/dashboard/project/142348](https://osp7icw.oneskyapp.com/admin/project/dashboard/project/142348)
* IMPROVED : Split the new JavaScript Calendar view as another plugin for compatibility reason.


== Frequently Asked Questions ==


**Can I get a general overview?**
Yes, please read : [Introducing Sagenda](http://www.sagenda.com/introducing-sagenda/)

**Can I change the date / time format?**
You can change the way sagenda display date and time by changing the settings of your WP website under : "Settings / General / Date Format + Time Format". This is only valid for the WP plugin (not the iframe integration).

**How can I integrate it in on my WordPress website?**

1. By using iFrame, please read [http://www.sagenda.com/add-booking-system-website/](http://www.sagenda.com/add-booking-system-website/).
2. By using the native WordPress plugin, please read : [http://www.sagenda.com/add-booking-system-website/add-booking-plugin-wordpress-website/](http://www.sagenda.com/add-booking-system-website/add-booking-plugin-wordpress-website/)


**Do I need to create a new website for my patients to book online appointments with me?**
No. You don’t need a separate, new website; "Sagenda" can be integrated into any website, as a new page or in a new space. This online appointment scheduler fits very well into any kind of website using iframe or specific modules for CMS.
Please read : [How to add a booking system to my website?](http://www.sagenda.com/add-booking-system-website/)


**How does my client know of the status of his/her booking request?**
The online appointment scheduler sends personalised emails to all people concerned at every step of booking, confirmation or cancelling. You can also subscribe for [SMS notifications and reminders](https://sagenda.net/ModuleCenter).


**But the services I offer are very different from those offered by other businesses.**
Whatever your services are, our online appointment scheduler can be configured in a manner that they can be easily displayed to your customers as a list of items. Try it, it's free!


**What if I have some feedback to improve your system?**
[Write to us NOW!](http://www.sagenda.com/#contact-us) Our online appointment scheduler is continually evolving, and your feedback is taken into account during every update.


**What about its compatibility of the booking system with my device?**
This brilliant online appointment scheduler works on PC, Mac, iPhone and Android. Whether your favorite browser is Firefox, Safari, Opera, Chrome or Internet Explorer, you will get optimum performance from the tool.


**Is that really free? And if yes, how are you making money then?**
Yes, this is really free. We make profit because some big customers ask us customised versions of our booking tool and additional software development or module.


**What is a "Bookable Item"?**
Bookable items represent the service or business that is available to customers for booking, renting or sharing online. For more information on please read our tutorial about [Bookable items](http://www.sagenda.com/introducing-sagenda/sagenda-bookable-items-can-clients-book/).


**How to setup event, schedule and repetition?**
This can be solved with "Events". For more information on please read our tutorial about [Events](http://www.sagenda.com/introducing-sagenda/sagenda-events-service-available-clients/).


**How to manage reservation (booking)?**
Once bookable items and events saved, you can brows your event in the [Booking screen](https://sagenda.net/Bookings/List). The dashboard will give you an overview of your account. For more information please read our tutorial about [dashboard](http://www.sagenda.com/introducing-sagenda/sagenda-dashboard-manage-clients/).


**How to configure my account?**
For more information please read our tutorial about [settings](http://www.sagenda.com/introducing-sagenda/sagenda-account-settings-integration/).

**About Calendar View**
If you want to change the day the calendar starts the week on, just change it under your WordPress settings : "Settings / General / Week Starts On".
If you want to change the language of the calendar, just change it under your WordPress settings : "Settings / General / Site Language".

More on :
[Sagenda Home](http://www.sagenda.com/)
