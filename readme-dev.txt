=== Read me for developers  ===
Are you a dev?
You can contribute on github -> https://github.com/Sagenda/sagenda-calendar-wp
But remember : “Always code as if the guy who ends up maintaining your code will be a violent psychopath who knows where you live.”

Need doc ? Generated it with Doxygen (http://www.stack.nl/~dimitri/doxygen/download.html#srcbin) using the doxygen file on root folder.

== Views ==
Views are rendered with TWIG template engine (http://twig.sensiolabs.org)
Responsiveness is manage with Twitter bootstrap (http://getbootstrap.com/).


== Culture / i18n / Date format... ==
You can contribute to text file there : http://osp7icw.oneskyapp.com/admin/projects
The datepicker is a separate project, you can add translations in assets/vendor/pickadate/lib/translations.
Don't hesitate to send us your new translations, we will add it in the next release and this will avoid update conflict for your later on.

== Special changes on vendors package ==

UNIREST
--> Many developer using PHP environment on Windows (such as WAMP) reported problem :
Fatal error: Uncaught exception 'Exception' with message 'SSL certificate problem: unable to get local issuer certificate' in \Unirest\Request.php on line 475

Some dev environment can't manage SSL verfication, so we turned off the SSL verifier of Unirest.

File modified is : assets\vendor\mashape\unirest-php\src\Unirest\Request.php
Around line 442 :
changed :
//CURLOPT_SSL_VERIFYPEER => self::$verifyPeer,
by:
CURLOPT_SSL_VERIFYPEER => false,
