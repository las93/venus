<!DOCTYPE html>
<html>
    <head>
        <script type="text/javascript" src="/js/jquery.js"></script>
        <script type="text/javascript" src="/js/cookie.js"></script>
        <link rel="stylesheet" href="/css/styleMobile.css"/>
	   	<link type="text/css" rel="stylesheet" media="all" href="/js/sliding/css/jquery.mmenu.all.css" />
	   	<style type="text/css">
			.mm-menu li.img a
			{
				font-size: 16px;
			}
			.mm-menu li.img a img
			{
				float: left;
				margin: -5px 10px -5px 0;
			}
			.mm-menu li.img a small
			{
				font-size: 12px;
			}
		</style>
		<script type="text/javascript" src="/js/sliding/js/jquery.mmenu.min.js"></script>
		<script type="text/javascript" src="/js/sliding/js/addons/jquery.mmenu.searchfield.min.js"></script>
		<script type="text/javascript" src="/js/sliding/js/addons/jquery.mmenu.header.min.js"></script>
		<script type="text/javascript" src="/js/sliding/js/addons/jquery.mmenu.labels.min.js"></script>
		<script type="text/javascript" src="/js/sliding/js/addons/jquery.mmenu.counters.min.js"></script>
		<script type="text/javascript">

			//	The menu on the left
			$(function() {
				$('nav#menu-left').mmenu();
			});


			//	The menu on the right
			$(function() {

				var $menu = $('nav#menu-right');

				$menu.mmenu({
					position	: 'right',
					classes		: 'mm-light',
					counters	: true,
					searchfield	: true,
					labels		: {
						fixed		: true
					},
					header		: {
						add			: true,
						update		: true,
						title		: 'Contacts'
					}
				});

				//	Click a menu-item
				var $confirm = $('#confirmation');
				$menu.find( 'li a' ).not( '.mm-subopen' ).not( '.mm-subclose' ).bind(
					'click.example',
					function( e )
					{
						e.preventDefault();
						$confirm.show().text( 'You clicked "' + $.trim( $(this).text() ) + '"' );
						$('#menu-right').trigger( 'close' );
					}
				);
			});
		</script>
        <title>{if isset($title)}{$title}{else}iScreenway : Cinéma, Séries TV, Stars, Vidéos et DVD{/if}</title>
        <meta name="description" content="{if isset($description)}{$description}{else}iScreenway, le site du cinéma et des séries tv ! Découvrez le programme tv de vos séries préférées, l&#39;actualité cinéma et séries, les dernières bandes-annonces, et plus encore.{/if}">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="author" content='iScreenway' />
		<meta name="country" content='Fr' />
		<meta name="geo.position" content='48.9049377;2.3214070999999876' />
		<meta name="geo.country" content='FR' />
		<meta name="ICBM" content='48.9049377;2.3214070999999876' />
		<meta name="viewport" content="width=device-width, maximum-scale=1.0" />
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-43697315-1', 'iscreenway.com');
		  ga('send', 'pageview');

		</script>
    </head>
    <body>
    	<div id="header">
    		<a href="#menu-left"></a>
			<img src="/img/logo-mobile.png" style="border:0px;" onClick="window.location='/';" alt="logo iScreenway" title="logo iScreenway"/>
			<a href="#menu-right" class="friends right"></a>
		</div>
    	<div id="content" style="background-color:#222222;">
    	    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- mobile320x50 -->
			<ins class="adsbygoogle"
			     style="display:inline-block;width:320px;height:50px"
			     data-ad-client="ca-pub-1464093566453217"
			     data-ad-slot="3220960880"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
    		{include model}
        </div>
        <nav id="menu-left">
			<ul>
				<li><a href="index.html">Page d'accueil</a></li>
				<li><a href="{url 'actu'}">Actualités</a></li>
				<li><a href="{url 'dossier'}">Dossiers</a></li>
				<li><a href="{url 'bande-annonce'}">Bandes-annonces</a></li>
			</ul>
		</nav>
		<nav id="menu-right">

				<ul> <!--
					<li>
						<span>Friends</span>
						<ul>
							<li class="Label">A</li>
							<li class="img">
								<a href="#">
									<img src="http://lorempixel.com/50/50/people/1/" />
									Alexa<br />
									<small>Johnson</small>
								</a>
							</li>
							<li class="img Collapsed">
								<a href="#">
									<img src="http://lorempixel.com/50/50/people/2/" />
									Alexander<br />
									<small>Brown</small>
								</a>
							</li>
						</ul>
					</li>

					<li>
						<span>Family</span>
						<ul>
							<li class="Label">A</li>
							<li class="img">
								<a href="#">
									<img src="http://lorempixel.com/50/50/people/3/" />
									Adam<br />
									<small>White</small>
								</a>
							</li>
						</ul>
					</li>

					<li>
						<span>Work colleagues</span>
						<ul>
							<li class="Label">D</li>
							<li class="img">
								<a href="#">
									<img src="http://lorempixel.com/50/50/people/3/" />
									David<br />
									<small>Harris</small>
								</a>
							</li>
						</ul>
					</li> -->
				</ul>

			</nav>
    </body>
</html>