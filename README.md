# CalibrePHP

This is a simple [HTML](http://en.wikipedia.org/wiki/HTML) and [OPDS](http://en.wikipedia.org/wiki/OPDS) web server to access a database created by the [Calibre](http://calibre-ebook.com) application. CalibrePHP was written using [CakePHP](http://cakephp.org).

## Docker
This application is also available as a docker container. You can run this application and expose your local Calibre library into the docker container using the following command:

```bash
docker run -d --name calibrephp \
  -p 8888:80 \
  -e BASE_URL=default \
  --restart="always" \
  -v <path-to-your-calibre-library>:/library \
  openam/calibrephp
```

This will make the application available on port 8888 on the dockerhost. You can then change the `Alternate book path` setting to `/library/metadata.db` which will use the library volume provided to the container.

The `BASE_URL` is optional, but allows you to access your files via `http://dockerhost:8888/default`

## Manual Setup
### Requirements
CalibrePHP has the following Requirements:
* HTTP Server. e.g. Apache with mod_rewrite
* PHP 5.3.0 or greater
* PHP Sqlite 3 support
* GD Image library
* Calibre library and sub-directories need to be readable and executable by the webserver.

### Installation
* Clone the repository to your webserver.
* Copy `app/Config/email.php.default` to `app/Config/email.php`
  * Update the settings as needed, This is needed if you're going to use the send feature below.
* Copy `app/Config/settings.php.default` to `app/Config/settings.php`
  * Configure the email setting want to be sent, or set as an empty array() to disable.
* Update `app/Config/core.php` to modify the following if desired.
  * Change `Security.salt` from the default.
  * Change `Security.cipherSeed` from the default.
  * Change `debug` to the desired level.

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
* [x] Dockerize the application
* [x] Multiple language support
* [x] Reading epub and pdf in browser
* [ ] Synology spk package
* [x] User management

## Reporting issues
If you have any issues with with the application please open an issue on [GitHub](https://github.com/openam/calibrephp/issues).

## Contributing
If you'd like to contribute, review the [Roadmap](https://github.com/openam/calibrephp/wiki/Roadmap) for planned features. You can fork the project add features and send pull requests.

## Demo and Screenshots

Please see the [documentation](http://openam.github.io/calibrephp/) for additional information, or visit the [demo](http://calibre.fakewaffle.com/demo) to see it in action.
