<div>
	<h1>Faire mon premier Hello World moi même</h1>
	Venus Framework est relativement simple à installer. Prenez la package téléchargé et copiez/collez le dans le répertoire désiré. Pour
	notre explication, nous avons considéré que nous avons copié le package dans <i>/var/www/venus/<i>.<br/>
	<br/>
	A présent, la première chose à faire est de créer votre premier package. Dans le package téléchargé, vous avez déjà le package Demo
	d'installé avec une partie dans <i>/var/www/venus/public/Demo<i> et <i>/var/www/venus/private/src/Demo<i>. Si vous voulez créer un
	nouveau package, on va créer nous même les dossiers (un script permet de le faire mais on vera cela après). On va donc créer notre
	premier package appelé <b>Test</b> à la main.<br/>
	<br/>
	Dans public qui sera le dossier accessible de partout, nosu allons créer pour la forme les dossiers ci-dessous :<br/>
	> mkdir /var/www/venus/public/Test<br/>
	> mkdir /var/www/venus/public/Test/css<br/>
	> mkdir /var/www/venus/public/Test/img<br/>
	> mkdir /var/www/venus/public/Test/js<br/>
	<br/>
	Nous allons à présent créer notre BootStrap où seul la définition du package est importante :<br/>
	> vi /var/www/venus/public/Test/index.php<br/>
	<br/>
	<?php<br/>
	/**<br/>
	 * bootstrap of the framework<br/>
	 *<br/>
	 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com><br/>
	 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)<br/>
	 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com<br/>
	 * @version   	Release: 1.0.0<br/>
	 * @filesource	http://www.iscreenway.com/framework/download.php<br/>
	 * @link      	http://www.iscreenway.com<br/>
	 * @since     	1.0<br/>
	 */<br/>
	 <br/>
	 const PORTAIL = 'Test';<br/>
	<br/>
	set_include_path(get_include_path().PATH_SEPARATOR.str_replace('public'.DIRECTORY_SEPARATOR.PORTAIL, 'private', __DIR__));<br/>
	<br/>
	require 'conf/AutoLoad.php';<br/>
	<br/>
	$oRouter = new \Venus\core\Router();<br/>
	$oRouter->run();<br/>
	<br/>
	Afin d'amener tous les appels de notre site vers ce fichier index.php que l'on appelle le Bootstrap de l'application, nous allons créer
	un .htaccess permettant de ramener tous les appels vers ce fichier, si le fichier demandé n'existe pas dans la partie public.<br/>
	> vi vi /var/www/venus/public/Test/.htaccess<br/>
	<br/>
	RewriteEngine on<br/>
	RewriteCond %{REQUEST_FILENAME} !-f<br/>
	RewriteRule ^.*$ /index.php [NC,L]<br/>
	<br/>
	Vous pouvez également importer cela directement dans votre Virtual host Apache.<br/>
	<br/>
	Nous allons à présent créer notre partie privée qui est le coeur de votre site (ou application). Nous allons donc créer successivement
	les dossiers ci-dessous :<br/>
	> mkdir /var/www/venus/private/src/Test<br/>
	> mkdir /var/www/venus/private/src/Test/Business<br/>
	> mkdir /var/www/venus/private/src/Test/common<br/>
	> mkdir /var/www/venus/private/src/Test/conf<br/>
	> mkdir /var/www/venus/private/src/Test/Controller<br/>
	> mkdir /var/www/venus/private/src/Test/Entity<br/>
	> mkdir /var/www/venus/private/src/Test/Model<br/>
	> mkdir /var/www/venus/private/src/Test/View<br/>
	<br/>
	Pour faire juste un Hello World très simpliste, nous allons donc créer un premier Controller dans lequel on va insérer une action
	(représentée par une simple méthode de classe).<br/>
	> vi /var/www/venus/private/src/Test/Controller/HelloWorld.php<br/>
	<br/>
	<?php<br/>
	<br/>
	/**<br/>
	 * Controller to HelloWorld<br/>
	 *<br/>
	 * @category  	src<br/>
	 * @package   	src\Test\Controller<br/>
	 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com><br/>
	 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)<br/>
	 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com<br/>
	 * @version   	Release: 1.0.0<br/>
	 * @filesource	http://www.iscreenway.com/framework/download.php<br/>
	 * @link      	http://www.iscreenway.com<br/>
	 * @since     	1.0<br/>
	 */<br/>
	<br/>
	namespace Venus\src\Test\Controller;<br/>
	<br/>
	use \Venus\core\Controller as Controller;<br/>
	<br/>
	/**<br/>
	 * Controller to HelloWorld<br/>
	 *<br/>
	 * @category  	src<br/>
	 * @package   	src\Test\Controller<br/>
	 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com><br/>
	 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)<br/>
	 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com<br/>
	 * @version   	Release: 1.0.0<br/>
	 * @filesource	http://www.iscreenway.com/framework/download.php<br/>
	 * @link      	http://www.iscreenway.com<br/>
	 * @since     	1.0<br/>
	 */<br/>
	<br/>
	class HelloWord extends Controller {<br/>
	<br/>
		/**<br/>
		 * show at screen Hello World<br/>
		 *<br/>
		 * @access public<br/>
		 * @return void<br/>
		 */<br/>
	<br/>
		public function show() {<br/>
	<br/>
			echo 'Hello World';<br/>
		}<br/>
	<br/>
	Comme tout bon framework, nous allons déclarer notre action show du controller HelloWord pour qu'elle soit accessible à l'extérieur car
	par sécurité, aucune action n'est accessible sans déclaration.<br/>
	<br/>
	Nous allons créer notre fichier Route qui a le rôle de déclarer ceci :<br/>
	> vi /var/www/venus/private/src/Test/conf/Route.conf<br/>
	<br/>
	{<br/>
		"localhost" : {<br/>
			"routes": {<br/>
				"home": {<br/>
					"route": "/",<br/>
					"controller" : "\\Venus\\src\\Test\\Controller\\HelloWord",<br/>
					"action": "show",<br/>
					"cache": {<br/>
						"max_age": 600<br/>
					}<br/>
				}<br/>
			}<br/>
		}<br/>
	}<br/>
	<br/>
	Maintenant que les accès sont configurés, il ne reste plus qu'à créer notre Virtual Host dans Apache pour que notre première page
	fonctionne.<br/>
	> vi /etc/apache2/sites-enables/localhost<br/>
	<br/>
		&lt;VirtualHost *:80&gt;<br/>
     	ServerName localhost<br/>
     	DocumentRoot /var/www/venus/public/Test/<br/>
	 	SetEnv DEV 1<br/>
     	&lt;Directory /var/www/venus/public/Test/&gt;<br/>
         	DirectoryIndex index.php<br/>
         	AllowOverride All<br/>
         	Order allow,deny<br/>
			Allow from all<br/>
		&lt;/Directory&gt;<br/>
	&lt;/VirtualHost&gt;<br/>
	<br/>
	Il suffit de relancer Apache et de tenter de mettre http://localhost/ et votre Hello World s'affiche.<br/>
	<br/>
	le framework est nettement plus complexe mais cela permet de se mettre dans le bain. Nous allons donc se lancer plus sérieusement dans
	le framework qui propose des possibilités bien plus grandes.<br/>
	<br/>
	<a href="">[Page Suivante]</a>
</div>