<?php
$web_static = getenv('WEB_STATIC_HOSTNAME');
$web_dynamic = getenv('WEB_DYNAMIC_HOSTNAME');
?>

<VirtualHost *:80>
        ServerName demo.api.ch

        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined

        ProxyPass "/api/icecream/" "http://<?= $web_dynamic ?>:3000"
        ProxyPassReverse "/api/icecream/" "http://<?= $web_dynamic ?>:3000"

        ProxyPass "/" "http://<?= $web_static ?>:80/"
        ProxyPassReverse "/" "http://<?= $web_static ?>:80/"

</VirtualHost>