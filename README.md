# software.wikimedia.de website

[![Build Status](https://travis-ci.org/wmde/software.wikimedia.de.svg)](https://travis-ci.org/wmde/software.wikimedia.de)

This repo contains the resources of the [software.wikimedia.de website](https://software.wikimedia.de).

The website uses the [Silex](http://silex.sensiolabs.org/) PHP micro-framework. It requires PHP 7.0 or later.

## Development

After cloning the repo, run `composer install` in the root directory.

For running the application, execute `php -S 0:8000 -t web` in the root directory. No need to have a real server set up.

There are a few smoke tests that can be run with `vendor/bin/phpunit`

### I'm a UX and allergic to PHP

The HTML can be found in `app/templates`. The [Twig](http://twig.sensiolabs.org/) template engine is used.

* `layout.html` contains the non-page-specific stuff such as menu, footer and JS/CSS loading
* `pages/` contains one file per page, matching URL structure (plus `.html`)
* `sections/` contains page sections used on multiple pages via the Twig `include` thing

Resources such as JS, CSS and images can be found in `web/`

The stuff is based on Twitter Bootstrap and uses structure borrowed from the
[Modern Business bootstrap template](https://startbootstrap.com/template-overviews/modern-business/).

