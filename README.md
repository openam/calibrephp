# CalibrePHP

This is a simple [HTML](http://en.wikipedia.org/wiki/HTML) and [OPDS](http://en.wikipedia.org/wiki/OPDS) web server to access a database created by the [Calibre](http://calibre-ebook.com) application. CalibrePHP was written using [CakePHP](http://cakephp.org).

## History
* Added reading epub and pdf in browser
* Added user management
  * Enable authentication by changing the auth option in configuration section
  * Default account `username:password` setups:
    * `admin:password`
    * `user:password`
    * `children:password`
* Added support for multiple languages
* Added Russian language
* Added configuration section

## Todo
* [ ] Dockerize the application
* [x] Multiple language support
* [x] Reading epub and pdf in browser
* [ ] Synology spk package
* [x] User management

## Docs and Demo

Please see the [documentation](http://openam.github.io/calibrephp/) for additional information, or visit the [demo](http://calibre.fakewaffle.com/demo) to see it in action.
