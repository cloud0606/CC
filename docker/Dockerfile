FROM tutum/lamp
RUN rm -rf /var/www/html/*
COPY config/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY schema.sql schema.sql
COPY privileges.sql privileges.sql
COPY mysql-setup.sh mysql-setup.sh
COPY --chown=www-data:www-data html /var/www/html
RUN echo "flag{test}" > /flag
RUN chmod +x /mysql-setup.sh
#ENTRYPOINT ["/mysql-setup.sh"]
CMD [ "/run.sh" ]
