FROM php:5.6-apache
MAINTAINER Michael Tuttle <openam@gmail.com>

COPY . /var/www/html/

RUN cp /var/www/html/app/Config/email.php.default /var/www/html/app/Config/email.php \
	&& cp /var/www/html/app/Config/settings.php.default /var/www/html/app/Config/settings.php \
	&& chown www-data:www-data /var/www/html/app/Config -R

ENV DEBIAN_FRONTEND noninteractive
RUN rm /etc/apache2/mods-available/php5.load
RUN apt-get update && \
	apt-get -yq install \
		curl \
		git \
		apache2 \
		libapache2-mod-php5 \
		php5-mysql \
		php5-sqlite \
		php5-intl \
		php5-mcrypt \
		php5-gd \
		php5-curl \
		php-pear \
		php-apc && \
	rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite

RUN chown --recursive root:www-data /var/www/html && \
	chmod -R 775 /var/www/html/app && \
	chmod +x run.sh

CMD [ "./run.sh" ]
