# Shiftable Configs

### This package is a work in progress and won't be considered production ready until I've used it to upgrade a bunch of sites to Laravel 8 this fall

As [JMac](https://twitter.com/gonedark) points out in [Base Laravel](https://baselaravel.com/), new major versions of Laravel often come with new values in the default configuration files. If those values are missing post-upgrade it can lead to errors and sometimes those errors are tough to track down.
 
The best way to avoid this is to leave Laravel's core configurations in their default state and just using environment variables. That way when you upgrade, whether using [Laravel Shift](https://laravelshift.com/) or by hand, you can confidently pull in the new configuration files without worrying about losing any of your own settings. 

This mostly works, but it does have its limitations. We have to deviate from this practice in the following situations:

* We have to add database connections, which requires editing config/databases.php

* We have to register aliases or providers manually, which requires editing config/app.php

My personal approach is to do absolutely everything I possibly can outside the core configuration files, leaving myself with just this tiny list of times when I have to break the rules. Then I use this package to make sure my customizations survive an upgrade.

### Installation

```shell script
composer require grosv/shiftable-configs
```

### How Shiftable Configs Helps

Shiftable Configs is a package that provides a command `php artisan make:shiftable-configs` that compares your configuration with the default configuration for your Laravel version (as determined by the requirement in your composer.json) and wherever the two are different, your customizations are saved to a new configuration file. No changes are made to your original configuration files.

Then the Shiftable Configs service provider merges the values in this default configuration file into your site's configuration in the boot method. This means that if you were to reset all the core configuration files in your site to their default state, all your settings would be preserved.

So an upgrade using Laravel shift would go something like this:

1. Run `php artisan make:shiftable-configs`

2. Do your shift

3. Run `php artisan make:shiftable-configs` again

4. Test and deploy your site.



### Linting and Testing

```shell script
composer test:unit # Runs PHPUnit
composer lint # Runs php-cs-fixer to fix your coding style
composer test # Runs lint and then test:unit 
```
