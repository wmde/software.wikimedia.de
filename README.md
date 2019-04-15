The website was discontinued in April 2019. The subdomain software.wikimedia.de now redirects to [www.wikimedia.de](https://github.com/wmde/wikimedia.de).

# software.wikimedia.de website

[![Build Status](https://travis-ci.org/wmde/software.wikimedia.de.svg)](https://travis-ci.org/wmde/software.wikimedia.de)

This repo contains the resources of the [software.wikimedia.de website](https://software.wikimedia.de).

## Contributing

### Website scope and audience

This website is meant to give people not familiar with our department an idea of who we are, what we do and how we do it.
The target audience that motivated its creation is potential hires. While the site can be used to cater to other needs
as well, the hiring one should always be kept in mind.

### Who can edit and who is responsible

You can treat the website as if it where a wiki. In fact, the previous version of the site was on a wiki. Use your own
best judgement. If you are fixing a typo, just push to master. If you think it warrants a second eye or you are actively
looking for feedback, create a pull request. Everyone part of the WMDE GitHub organization can merge pull requests.

The main authors or the existing content are @samu-wmde and @JeroenDeDauw, so these are the primary suspects for feedback.

Changes to this git repo do not automatically get deployed. You can just leave your changes as they are, to be deployed
whenever the next deployment happens, or you can pester either @addshore or @JeroenDeDauw to do a deployment.

### Running the application

Running the site requires PHP 7.0 or later.

After cloning the repo, run `composer install` in the root directory.

For running the application, execute `php -S 0:8000 -t web` in the root directory. This makes the site
available at `http://localhost:8000/` in your browser. For development, you probably want to use the
development entry point `url:8000/index.dev.php`, which enables debug mode and disables HTTP caching.

To run the application from Docker (does not require having PHP installed):

    docker run --rm --interactive --tty --network="host" --volume $PWD:/app -w /app \
    	--volume ~/.composer:/composer --user $(id -u):$(id -g) composer php -S 0:8000 -t web

There are a few smoke tests that can be run with `composer ci`.

### I'm a UX and allergic to PHP

The website uses the [Silex](http://silex.sensiolabs.org/) PHP micro-framework and the
[Twig](http://twig.sensiolabs.org/) template engine. Typical modifications to the content
only require modifying the templates, which means that you can contribute to the website
without knowing any PHP.

The HTML of the website can be found in `app/templates/`. 

* `layout.html` contains the non-page-specific stuff such as menu, footer and JS/CSS loading
* `pages/` contains one file per page, matching URL structure (plus `.html`)
* `sections/` contains page sections used on multiple pages via the Twig `include` thing

Resources such as JS, CSS and images can be found in `web/`.

The layout is based on Twitter Bootstrap and uses structure borrowed from the
[Modern Business bootstrap template](https://startbootstrap.com/template-overviews/modern-business/).

