/**
 * Created by PhpStorm.
 * User: 睿
 * Date: 2017-04-27
 * Time: 15:52
 */

<VirtualHost *:80>
ServerName yiiablog.com
        DocumentRoot "E:\amp\www\www.yiiablog.com\frontend\web"

<Directory "E:\amp\www\www.yiiablog.com\frontend\web">
# use mod_rewrite for pretty URL support
RewriteEngine on
            # If a directory or a file exists, use the request directly
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteCond %{REQUEST_FILENAME} !-d
            # Otherwise forward the request to index.php
            RewriteRule . index.php

            # use index.php as index file
            DirectoryIndex index.php

            # ...other settings...
            # Apache 2.4
            Require all granted

## Apache 2.2
# Order allow,deny
# Allow from all
</Directory>
    </VirtualHost>

    <VirtualHost *:80>
ServerName admin.yiiablog.com
        DocumentRoot "E:\amp\www\www.yiiablog.com\backend\web"

<Directory "E:\amp\www\www.yiiablog.com\backend\web">
# use mod_rewrite for pretty URL support
RewriteEngine on
            # If a directory or a file exists, use the request directly
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteCond %{REQUEST_FILENAME} !-d
            # Otherwise forward the request to index.php
            RewriteRule . index.php

            # use index.php as index file
            DirectoryIndex index.php

            # ...other settings...
            # Apache 2.4
            Require all granted

## Apache 2.2
# Order allow,deny
# Allow from all
</Directory>
    </VirtualHost>