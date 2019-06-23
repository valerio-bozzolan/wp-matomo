# WP-Matomo &ndash; Suckless WordPress-Matomo integration

Features:
* **NOT SUITABLE FOR END-USER PEOPLE, MUST BE INSTALLED BY A DEVELOPER**
* No crapware
* No adware
* It's **absolutely blazing fast** plugin
* Absolutely secure (there is no interaction with any user, even administrators)
* No database options (use your `wp-config.php`)

## Installation

1. Install Matomo somehow (you must know how)
2. Put this plugin in your `/wp-content/plugins`. You must know how.
3. Edit your `wp-config.php` and put there this:

```
define( 'MATOMO_PATH', 'http://your-matomo-installation/' );
define( 'MATOMO_SITE', 1 );
```

Know you can activate your plugin.
