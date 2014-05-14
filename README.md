VENUS FRAMEWORK PHP
===================

Venus Framework

===================
Français
===================

Nouveau framework PHP basé sur un concept MVC solide et très malléable.

Pour afficher Hello World, voici le Vhost apache Type à mettre en place :

<pre>
&lt;VirtualHost *:80&gt;
     ServerName localhost
     DocumentRoot E:/venus/public/Demo/
     &lt;Directory E:/venus/public/Demo/&gt;
         DirectoryIndex index.php
         AllowOverride All
         Order allow,deny
         Allow from all
     &lt;/Directory&gt;
&lt;/VirtualHost&gt;
</pre>

===================
Anglais
===================

New PHP framework based on a strong MVC concept and very malleable

To display Hello World in your browser, there is Vhost apache to write in your apache2.conf (or http.conf) :

<pre>
&lt;VirtualHost *:80&gt;
     ServerName localhost
     DocumentRoot E:/venus/public/Demo/
     &lt;Directory E:/venus/public/Demo/&gt;
         DirectoryIndex index.php
         AllowOverride All
         Order allow,deny
         Allow from all
     &lt;/Directory&gt;
&lt;/VirtualHost&gt;
</pre>
