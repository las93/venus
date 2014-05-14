<div>
	<h1>Afficher une liste de films</h1>
	pour bien comprendre l'ensemble des éléments, nous allons tenter d'utiliser toutes les briques furtivement pour comprendre la philosophie
	de ce Framework dans sa généralité. Il faut bien comprendre que cela sera un premier apperçu rapide et que le framework vous permettra
	d'aller beaucoup plus loin à la suite.<br/>
	<br/>
	Dans Venus Framework, vous avez du voir un package Batch qui n'a d'ailleurs pas de partie publique. C'est normal, car ce package a pour
	but de lancer des scripts en ligne de commandes. Sans rentrer dans le détail, nous allons l'utiliser pour créer une entité et un modèle
	correspondant à une table SQL.<br/>
	<br/>
	nous commençons donc par créer une nouvelle table dans MySQL comme ceci :<br/>
	CREATE TABLE movies (id INT(11) UNSIGNED NOT NULL auto_increment, name VARCHAR(50) NOT NULL, PRIMARY KEY (id));<br/>
	INERT INTO movies (id, name) VALUES (null, 'Terminator');<br/>
	INERT INTO movies (id, name) VALUES (null, 'Robocop');<br/>
	INERT INTO movies (id, name) VALUES (null, 'Batman');<br/>
	INERT INTO movies (id, name) VALUES (null, 'Superman');
	<br/>
	A partir de cette table, nous allons donc créer la configuration de nos modèles en créant un nouveau fichier de configuration :<br/>
	> vi /var/www/venus/private/src/Test/conf/Db.conf<br/>
	<br/>
	{<br/>
    "configuration": {<br/>
        "iscreenway": {<br/>
            "type": "mysql",<br/>
            "host": "localhost",<br/>
            "db": "cinema",<br/>
            "user": "root",<br/>
            "password": "****",<br/>
            "tables": {<br/>
                "movies": {<br/>
                    "fields": {<br/>
                        "id": {<br/>
                            "type": "int",<br/>
                            "key": "primary",<br/>
                            "null": false,<br/>
                            "undefined": true,<br/>
                            "autoincrement": true<br/>
                        },<br/>
                        "name": {<br/>
                            "type": "varchar",<br/>
                            "null": false<br/>
                        }<br/>
                	}<br/>
               	}<br/>
         	}<br/>
     	}<br/>
	}<br/>
	<br/>
	A partir de ce fichier où l'on configure la connexion et la déclaration de notre table, nous allons lancer notre script qui va créer le
	modèle et l'entité correspondants.<br/>
	> php /var/www/venus/private/launch.php scaffolding -p Test<br/>
	<br/>
	/!\ pour info, la route du script est définit dans le fichier /var/www/venus/private/conf/Route.conf qui est le ficheir de configuration
	général qui se charge tout le temps et non pas seulement dans un package particulier. Le Route.conf du package est prioritaire sur
	celui-ci et le surchage en cas de présence d'une même configuration de présente.<br/>
	<br/>
	Lorsque le script est terminé, nous avons deux nouveaux fichiers dans notre projet : /var/www/venus/private/src/Test/Entity/movies.php et
	/var/www/venus/private/src/Test/Model/movies.php.<br/>
	<br/>
	Pour les novices, une entité est une représentation très simpliste de notre table soit une classe avec des getteurs et des setteurs sur
	les éléments de notre table. Notre entité "films" est une classe avec en paramètre id et name et qui a quatre fonctions getid(), setid(),
	getname() et setname().<br/>
	<br/>
	Un modèle est une classe qui permet d'obtenir 1 ou des éléments de cette entité selon des critères plus ou moins complexes. Nous pouvons
	d'ailleurs rajouter nous même des méthodes lorsque les méthodes de bases ne comble pas tous les besoins.<br/>
	<br/>
	Si tout n'est pas clair, nous allons utiliser ces éléments afin de mieux comprendre comment les utiliser. Nous allons donc définir une
	nouvelle action dans notre Route.conf comme ceci :<br/>
	<br/>
	"home": {<br/>
		"route": "/",<br/>
		"controller" : "\\Venus\\src\\Test\\Controller\\HelloWord",<br/>
		"action": "showMovies",<br/>
		"cache": {<br/>
			"max_age": 600<br/>
		}<br/>
	}<br/>
</div>