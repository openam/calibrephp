# CalibrePHP

CalibrePHP provides a simple web interface to access a database created by the [Calibre](http://calibre-ebook.com) application. CalibrePHP was written using [CakePHP](http://cakephp.org).

## Requirements

The master branch has the following requirements:

* HTTP Server. For example: Apache. mod_rewrite is preferred, but by no means required.
* PHP 5.3.0 or greater.
* PHP Sqlite 3 support.
* ImageMagick.

## Installation

* Copy/Clone the repository to your webserver.
* Copy/Rename `app/Config/database.php.default` to `app/Config/database.php`.
	* change `$default['database']` to match the location of your calibre database.
* Copy/Rename `app/Config/settings.php.default` to `app/Config/settings.php`.
	* change `$config['Settings']['Default']['CalibrePath']` to match the location of your calibre database.
* Copy/Rename `app/Config/core.php.default` to `app/Config/core.php`.
	* change `Security.salt` from the default.
	* change `Security.cipherSeed` from the default.
	* change `debug` to the desired level.

## Screenshot

![CalibrePHP](https://raw.github.com/openam/calibrephp/gh-pages/images/screenshot.png)

## Reporting issues

If you have an issues with CalibrePHP please open an issue on github https://github.com/openam/calibrephp/issues.

## Contributing

If you'd like to contribute to CalibrePHP, review the [Roadmap](https://github.com/openam/calibrephp/wiki/Roadmap) for planned features.  You can fork the project add features and send pull requests, or open issues on github.
