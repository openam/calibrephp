# CalibrePHP

This is a simple [HTML](http://en.wikipedia.org/wiki/HTML) and [OPDS](http://en.wikipedia.org/wiki/OPDS) web server to access a database created by the [Calibre](http://calibre-ebook.com) application. CalibrePHP was written using [CakePHP](http://cakephp.org).

## Docker
This application is also available as a docker container. You can run this application and expose your local Calibre library into the docker container using the following command:

```bash
docker run -d --name calibrephp \
	-p 8888:80 \
	-v <path-to-your-calibre-library>:/library \
	openam/calibrephp
```

This will make the application available on port 8888 on the dockerhost. You can then change the `Alternate book path` setting to `/library/metadata.db` which will use the library volume provided to the container.

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

## Docs and Demo

Please see the [documentation](http://openam.github.io/calibrephp/) for additional information, or visit the [demo](http://calibre.fakewaffle.com/demo) to see it in action.
