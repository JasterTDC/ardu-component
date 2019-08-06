FROM "richarvey/nginx-php-fpm"

ADD /conf/ardu-component.conf /etc/nginx/sites-available/ardu-component.conf

RUN mkdir /srv/www/
RUN mkdir /LOGS/

RUN mv /usr/local/etc/php-fpm.d/www.conf /usr/local/etc/php-fpm.d/www.conf.back
ADD /conf/www.conf /usr/local/etc/php-fpm.d/www.conf

RUN ln -s /etc/nginx/sites-available/ardu-component.conf /etc/nginx/sites-enabled/ardu-component.conf
RUN rm /etc/nginx/sites-enabled/default.conf

CMD ["/start.sh"]
