Installation instructions
-------------------------

### Install through Composer

Use Composer to install the extension:

```
composer require netgen/nginfocollector:^1.0
```

### Activate extension

Activate the extension by using the admin interface ( Setup -> Extensions ) or by
prepending `nginfocollector` to `ActiveExtensions[]` in `ezpublish_legacy/settings/override/site.ini.append.php`:

```ini
[ExtensionSettings]
ActiveExtensions[]=nginfocollector
```

### Regenerate the legacy autoload array

Run the following from your installation root folder

    php app/console ezpublish:legacy:script bin/php/ezpgenerateautoloads.php

Or go to Setup -> Extensions in admin interface and click the "Regenerate autoload arrays" button
