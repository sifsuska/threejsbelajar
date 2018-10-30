<?php
include_once('conf/koneksi.php');
$query = mysql_query("select id_artikel,judul_artikel from profil");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Beranda - 3DChem</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
		<link rel="stylesheet" href="assets/css/w3.css">
		<link rel="stylesheet" href="assets/css/test.css">
		<style>

			@font-face {
				font-family: 'inconsolata';
				src: url('files/inconsolata.woff') format('woff');
				font-weight: normal;
				font-style: normal;
			}

			* {
				box-sizing: border-box;
			}

			html {
				height: 100%;
			}

			body {
				background-color: #ffffff;
				margin: 0px;
				height: 100%;
				color: #555;
				font-family: 'inconsolata';
				font-size: 15px;
				line-height: 18px;
				overflow: hidden;
			}

			h1 {
				margin-top: 20px;
				margin-bottom: 20px;
				margin-left: 20px;
				font-size: 25px;
				font-weight: normal;
			}

			h2 {
				font-size: 20px;
				font-weight: normal;
			}

			a {
				font-family: 'Segoe UI';
				font-size: 15px;
				text-decoration: none;
			}

			#panel {
				position: fixed;
				left: 0px;
				width: 310px;
				height: 100%;
				overflow: auto;
				background: #fafafa;
			}

			#panel #content {
				/*padding: 0px 20px 20px 20px;*/
				/*padding: 0 18px;*/
				
				max-height: 0;
    			background-color: white;
    			overflow: hidden;
    			transition: max-height 0.2s ease-out;

			}

			#panel #content .link {
				color: #2194CE;
				text-decoration: none;
				cursor: pointer;
				display: block;
			}

			#panel #content .selected {
				color: #ff0000;
			}

			#panel #content .link:hover {
				text-decoration: underline;
			}

			#viewer {
				position: absolute;
				border: 0px;
				left: 310px;
				width: calc(100% - 310px);
				height: 100%;
				overflow: auto;
			}

			#viewSrcButton {
				position: fixed;
				bottom: 20px;
				right: 20px;
				padding: 8px;
				color: #fff;
				background-color: #555;
				opacity: 0.7;
			}

			#viewSrcButton:hover {
				cursor: pointer;
				opacity: 1;
			}

			.filterBlock{
				margin: 20px;
				position: relative;
			}

			.filterBlock p {
				margin: 0;
			}

			#filterInput {
				width: 100%;
				padding: 5px;
				font-family: inherit;
				font-size: 15px;
				outline: none;
				border: 1px solid #dedede;
			}

			#filterInput:focus{
				border: 1px solid #2194CE;
			}

			#clearFilterButton {
				position: absolute;
				right: 6px;
				top: 50%;
				margin-top: -8px;
				width: 16px;
				height: 16px;
				font-size: 14px;
				color: grey;
				text-align: center;
				line-height: 0;
				padding-top: 7px;
				opacity: .5;
			}

			#clearFilterButton:hover {
				opacity: 1;
			}

			.filtered {
				display: none !important;
			}

			#panel li b {
				font-weight: bold;
			}

			/*overlay*/

			.overlay {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0, 0.9);
    overflow-x: hidden;
    transition: 0.5s;
}

.overlay-content {
    position: relative;
    top: 25%;
    width: 100%;
    text-align: center;
    margin-top: 30px;
}

.overlay a {
    padding: 8px;
    text-decoration: none;
    font-size: 36px;
    color: #818181;
    display: block;
    transition: 0.3s;
}

.overlay a:hover, .overlay a:focus {
    color: #f1f1f1;
}

.overlay .closebtn {
    position: absolute;
    top: 20px;
    right: 45px;
    font-size: 60px;
}

@media screen and (max-height: 450px) {
  .overlay a {font-size: 20px}
  .overlay .closebtn {
    font-size: 40px;
    top: 15px;
    right: 35px;
  }

			/* mobile */

			#expandButton {
				display: none;
				position: absolute;
				right: 20px;
				top: 12px;
				width: 32px;
				height: 32px;
			}

			#expandButton span {
				height: 2px;
				background-color: #2194CE;
				width: 16px;
				position: absolute;
				left: 8px;
				top: 10px;
			}

			#expandButton span:nth-child(1) {
				top: 16px;
			}

			#expandButton span:nth-child(2) {
				top: 22px;
			}

			@media all and ( max-width: 640px ) {
				h1{
					margin-top: 20px;
					margin-bottom: 20px;
				}
				#panel{
					position: absolute;
					left: 0;
					top: 0;
					height: 480px;
					width: 100%;
					right: 0;
					z-index: 100;
					overflow: hidden;
					border-bottom: 1px solid #dedede;
				}
				#content{
					position: absolute;
					left: 0;
					top: 90px;
					right: 0;
					bottom: 0;
					font-size: 17px;
					line-height: 22px;
					overflow: auto;
				}
				#viewer{
					position: absolute;
					left: 0;
					top: 56px;
					width: 100%;
					height: calc(100% - 56px);
				}
				#expandButton{
					display: block;
				}
				#panel.collapsed{
					height: 56px;
				}
			}

		</style>
	</head>
	<body>

		<header>
		<a href="index.php"><img src="logo.jpg"></a>
		</header>

		<div class="topnav">
  		<a class="active" href="index.php">Beranda</a>
  		<a href="materi.php">Materi</a>
  		<a href="latihan.php">Latihan</a>
  		<div class="dropdown">
    	<button class="dropbtn">Tentang</button>
    	<div class="dropdown-content">
    	<?php
  			while($row=mysql_fetch_assoc($query)) { ?>
            <a href="profil.php?id=<?= $row['id_artikel'] ?>"><?= $row['judul_artikel'] ?></a>
        <?php } ?>      
    	</div>
  	</div> 
  		<a style="float:right" href="modul/login.php">Login</a>
		</div>

		<div id="panel">
			<div id="myNav" class="overlay">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <div class="overlay-content">
    <h1 style="color:white;">Oksigen</h1><img src="assets/images/oksigen.PNG" alt="Oksigen" width="100" height="100">
    <h1 style="color:white;">Karbon</h1><img src="assets/images/karbon.PNG" alt="Oksigen" width="100" height="100">
    <h1 style="color:white;">Hidrogen</h1><img src="assets/images/hidrogen.PNG" alt="Oksigen" width="100" height="100">
  </div>
</div>

			<h1>Visualisasi 3D</a></h1>
			<a id="expandButton" href="#">
				<span></span>
				<span></span>
				<span></span>
			</a>
			<button class="accordion">Alkanol</button>
			<div id="content">
			<a button class="accordtab" href="file/model/Etanol/etanol.html" target="iframe_a">Etanol</a><br>
			<a button class="accordtab" href="file/model/Propanol/propanol.html" target="iframe_a">Propanol</a><br>
			</div>
			<button class="accordion">Alkoksialkana</button>
			<div id="content">
			<a button class="accordtab" href="file/model/Metoksimetana/metoksimetana.html" target="iframe_a">Metoksimetana</a><br>
			<a button class="accordtab" href="file/model/Etoksimetana/etoksimetana.html" target="iframe_a">Etoksietana</a><br>
			</div>
			<button class="accordion">Alkanal</button>
			<div id="content">
			<a button class="accordtab" href="file/model/Butanal/butanal.html" target="iframe_a">Butanal</a><br>
			<a button class="accordtab" href="file/model/Pentanal/pentanal.html" target="iframe_a">Pentanal</a><br>
			</div>
			<button class="accordion">Alkanon</button>
			<div id="content">
			<a button class="accordtab" href="file/model/Butanon/butanon.html" target="iframe_a">Butanon</a><br>
			<a button class="accordtab" href="file/model/Propanon/propanon.html" target="iframe_a">Propanon</a><br>
			</div>
			<button class="accordion">Asam Alkanoat</button>
			<div id="content">
			<a button class="accordtab" href="file/model/Asam_metanoat/asammetanoat.html" target="iframe_a">Asam Metanoat</a><br>
			<a button class="accordtab" href="file/model/Asam_etanoat/asametanoat.html" target="iframe_a">Asam Etanoat</a><br>
			</div>
			<button class="accordion">Alkil Alkanoat</button>
			<div id="content">
			<a button class="accordtab" href="file/model/Metil_etanoat/metiletanoat.html" target="iframe_a">Metil Etanoat</a><br>
			</div>
			<h3 style="font-size:20px; padding:18px; font-family:Segoe UI;background-color:#5188c8; margin-top:0px; color:black; width:100%; cursor:pointer" onclick="openNav()">&#9776; Tips</h3>
		</div>
		<iframe id="viewer" name="iframe_a" allowfullscreen allowvr onmousewheel=""></iframe>

		<script>

		function openNav() {
  document.getElementById("myNav").style.width = "19.5%";
}

function closeNav() {
  document.getElementById("myNav").style.width = "0%";
}	

		var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}


		//////////////////bawaan//////////////////////////////////////////////////////

		function extractQuery() {
			var p = window.location.search.indexOf( '?q=' );
			if( p !== -1 ) {
				return window.location.search.substr( 3 );
			}
			return ''
		}

		var panel = document.getElementById( 'panel' );
		var content = document.getElementById( 'content' );
		var viewer = document.getElementById( 'viewer' );

		var filterInput = document.getElementById( 'filterInput' );
		var clearFilterButton = document.getElementById( 'clearFilterButton' );

		var expandButton = document.getElementById( 'expandButton' );
		expandButton.addEventListener( 'click', function ( event ) {
			event.preventDefault();
			panel.classList.toggle( 'collapsed' );
		} );

		// iOS iframe auto-resize workaround

		if ( /(iPad|iPhone|iPod)/g.test( navigator.userAgent ) ) {

			viewer.style.width = getComputedStyle( viewer ).width;
			viewer.style.height = getComputedStyle( viewer ).height;
			viewer.setAttribute( 'scrolling', 'no' );

		}

		var container = document.createElement( 'div' );
		content.appendChild( container );

		var viewSrcButton = document.createElement( 'a' );
		viewSrcButton.id = 'viewSrcButton';
		viewSrcButton.target = '_blank';
		viewSrcButton.textContent = 'View source';
		viewSrcButton.style.display = 'none';
		document.body.appendChild( viewSrcButton );

		var links = {};
		var selected = null;

		function createLink( file ) {

			var link = document.createElement( 'a' );
			link.className = 'link';
			link.href = file + '.html';
			link.textContent = getName( file );
			link.setAttribute( 'target', 'viewer' );
			link.addEventListener( 'click', function ( event ) {

				if ( event.button === 0 ) {

					selectFile( file );

				}

			} );

			return link;

		}

		for ( var key in files ) {

			var section = files[ key ];

			var header = document.createElement( 'h2' );
			header.textContent = key;
			header.setAttribute( 'data-category', key );
			container.appendChild( header );

			for ( var i = 0; i < section.length; i ++ ) {

				var file = section[ i ];

				var link = createLink( file );
				container.appendChild( link );

				links[ file ] = link;

			}

		}

		function loadFile( file ) {

			selectFile( file );
			viewer.src = file + '.html';

		}

		function selectFile( file ) {

			if ( selected !== null ) links[ selected ].classList.remove( 'selected' );

			links[ file ].classList.add( 'selected' );

			window.location.hash = file;
			viewer.focus();

			panel.classList.add( 'collapsed' );

			selected = file;

			// Reveal "View source" button and set attributes to this example
			viewSrcButton.style.display = '';
			viewSrcButton.href = 'https://github.com/mrdoob/three.js/blob/master/examples/' + selected + '.html';
			viewSrcButton.title = 'View source code for ' + getName(selected) + ' on GitHub';

		}

		if ( window.location.hash !== '' ) {

			loadFile( window.location.hash.substring( 1 ) );

		}

		// filter

		filterInput.addEventListener( 'input', function( e ) {

			updateFilter();

		} );

		clearFilterButton.addEventListener( 'click', function( e ) {

			filterInput.value = '';
			updateFilter();
			e.preventDefault();

		} );

		function updateFilter() {

			var v = filterInput.value;
			if( v !== '' ) {
				window.history.replaceState( {} , '', '?q=' + v + window.location.hash );
			} else {
				window.history.replaceState( {} , '', window.location.pathname + window.location.hash );
			}

			var exp = new RegExp( v, 'gi' );

			for ( var key in files ) {

				var section = files[ key ];

				for ( var i = 0; i < section.length; i ++ ) {

					filterExample( section[ i ], exp );

				}

			}

			layoutList();

		}

		function filterExample( file, exp ){

			var link = links[ file ];
			var name = getName( file );
			var res = file.match( exp );
			var text;

			if ( res && res.length > 0 ) {

				link.classList.remove( 'filtered' );

				for( var i = 0; i < res.length; i++ ) {
					text = name.replace( res[ i ], '<b>' + res[ i ] + '</b>' );
				}

				link.innerHTML = text;

			} else {

				link.classList.add( 'filtered' );
				link.innerHTML = name;

			}
		}

		function getName( file ) {

			var name = file.split( '_' );
			name.shift();
			return name.join( ' / ' );

		}

		function layoutList() {

			for ( var key in files ) {

				var collapsed = true;

				var section = files[ key ];

				for ( var i = 0; i < section.length; i ++ ) {

					var file = section[ i ];

					if( !links[ file ].classList.contains( 'filtered' ) ){

						collapsed = false;
						break;

					}

				}

				var element = document.querySelector( 'h2[data-category="' + key + '"]' );

				if( collapsed ){

					element.classList.add( 'filtered' );

				} else {

					element.classList.remove( 'filtered' );

				}

			}

		}

		filterInput.value = extractQuery();
		updateFilter();

		</script>

	</body>
</html>
