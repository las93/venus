<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  		<link rel="stylesheet" href="/js/css/ui-lightness/jquery-ui-1.10.3.custom.min.css" />
  		<script src="/js/jquery-1.10.2.min.js"></script>
  		<script src="/js/js/jquery-ui-1.10.3.custom.min.js"></script>
    	<link rel="stylesheet" href="/js/jqwidgets/styles/jqx.base.css" type="text/css" />
    	<link rel="stylesheet" href="/js/jqwidgets/styles/jqx.classic.css" type="text/css" />
    	<script type="text/javascript" src="/js/jqwidgets/jqxcore.js"></script>
    	<script type="text/javascript" src="/js/jqwidgets/jqxmenu.js"></script>
    	<script type="text/javascript" src="/js/jqwidgets/jqxvalidator.js"></script>
		<script type="text/javascript" src="/js/jqwidgets/jqxbuttons.js"></script>
        <title>{$title}</title>
        <style>
        	body{font-family:arial;font-size:12px;}
        </style>
    </head>
    <body>
		<div id='content'>
	        <script type="text/javascript">
	            $(document).ready(function () {
	                // Create a jqxMenu
	                $("#jqxMenu").jqxMenu({ width: 1000, height: 30});
	            });
	        </script>
	    	<div id='jqxWidget'>
	            <div id='jqxMenu'>
	                <ul>
	                    <li><a href="{url 'home'}">Accueil</a></li>
	                    <li><a href="{url 'liste_fiche'}">Fiches</a>
	                        <ul>
	                            <li><a href="{url 'liste_fiche'}">Liste</a></li>
	                            <li><a href="{url 'ajouter_fiche'}">Cr&eacute;er</a></li>
	                        </ul>
	                    </li>
	                    <li><a href="{url 'liste_article'}">Articles</a>
	                        <ul>
	                            <li><a href="{url 'liste_article'}">Liste</a></li>
	                            <li><a href="{url 'ajouter_article'}">Cr&eacute;er</a></li>
	                        </ul>
	                    </li>
	                    <li><a href="{url 'liste_nationalite'}">Nationalit&eacute;s</a>
	                        <ul>
	                            <li><a href="{url 'liste_nationalite'}">Liste</a></li>
	                            <li><a href="{url 'ajouter_nationalite'}">Cr&eacute;er</a></li>
	                        </ul>
	                    </li>
	                    <li><a href="{url 'liste_distributeur'}">Distributeur</a>
	                        <ul>
	                            <li><a href="{url 'liste_distributeur'}">Liste</a></li>
	                            <li><a href="{url 'ajouter_distributeur'}">Cr&eacute;er</a></li>
	                        </ul>
	                    </li>
	                    <li><a href="{url 'liste_personne'}">Personnes</a>
	                        <ul>
	                            <li><a href="{url 'liste_personne'}">Liste</a></li>
	                            <li><a href="{url 'ajouter_personne'}">Cr&eacute;er</a></li>
	                        </ul>
	                    </li>
	                    <li><a href="{url 'liste_ba'}">Bande annonce</a>
	                        <ul>
	                            <li><a href="{url 'liste_ba'}">Liste</a></li>
	                            <li><a href="{url 'ajouter_ba'}">Cr&eacute;er</a></li>
	                        </ul>
	                    </li>
	                    <li><a href="{url 'liste_mea'}">Mises en avant</a>
	                        <ul>
	                            <li><a href="{url 'liste_mea'}">Liste</a></li>
	                            <li><a href="{url 'ajouter_mea'}">Cr&eacute;er</a></li>
	                        </ul>
	                    </li>
	                    <li><a href="{url 'liste_photo'}">Photos</a>
	                        <ul>
	                            <li><a href="{url 'liste_photo'}">Liste</a></li>
	                            <li><a href="{url 'ajouter_photo'}">Cr&eacute;er</a></li>
	                        </ul>
	                    </li>
	                    <li><a href="/?deconnexion">D&eacute;connexion</a></li>
	                </ul>
	            </div>
	        </div>
        </div>
        <style>
        #contentall {
        	-webkit-border-radius: 5px;
			-moz-border-radius: 5px;
			border-radius: 5px;
			background-color:#EAEAEA;
			border:solid 1px #CCCCCC;
			margin-top:10px;
			width:990px;
			padding:5px;
		}
        table {
        	-webkit-border-radius: 5px;
			-moz-border-radius: 5px;
			border-radius: 5px;
			background-color:#DADADA;
			border:solid 1px #BBBBBB;
		}
        </style>
		<div id="contentall">
			{include model}
		</div>
    </body>
</html>