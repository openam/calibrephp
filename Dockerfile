FROM openam/cakephp
MAINTAINER Michael Tuttle <openam@gmail.com>

RUN cp /var/www/html/app/Config/email.php.default /var/www/html/app/Config/email.php \
	&& cp /var/www/html/app/Config/settings.php.default /var/www/html/app/Config/settings.php \
	&& chown www-data:www-data /var/www/html/app/Config -R
