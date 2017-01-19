# software.wikimedia.de website

[![Build Status](https://travis-ci.org/wmde/software.wikimedia.de.svg)](https://travis-ci.org/wmde/software.wikimedia.de)

This repo contains the resources of the [software.wikimedia.de website](https://software.wikimedia.de).

The website uses the [Silex](silex.sensiolabs.org/) PHP micro-framework.

## Development

Requires PHP 7.0+

For running the application, run `php -S 0:8000` in `web`. No need to have a real server set up.

There are a few smoke tests that can be run with `vendor/bin/phpunit`
