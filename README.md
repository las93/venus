VENUS FRAMEWORK PHP
===================

Venus Framework

===================
Français
===================

Nouveau framework PHP basé sur un concept MVC solide et très malléable.

Pour afficher Hello World, voici le Vhost apache Type à mettre en place :

<VirtualHost *:80>
     ServerName localhost
     DocumentRoot E:/venus/public/Demo/
     <Directory E:/venus/public/Demo/>
         DirectoryIndex index.php
         AllowOverride All
         Order allow,deny
         Allow from all
     </Directory>
</VirtualHost>

===================
Anglais
===================

New PHP framework based on a strong MVC concept and very malleable

To display Hello World in your browser, there is Vhost apache to write in your apache2.conf (or http.conf) :

<VirtualHost *:80>
     ServerName localhost
     DocumentRoot E:/venus/public/Demo/
     <Directory E:/venus/public/Demo/>
         DirectoryIndex index.php
         AllowOverride All
         Order allow,deny
         Allow from all
     </Directory>
</VirtualHost>
