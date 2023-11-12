/* Modificateur de Menu */
(
	function() {

		document.addEventListener('DOMContentLoaded', chargementDOM_Header, false);
		
		function chargementDOM_Header() {
			var header_site = document.getElementById('haut_page'),
				header_txt;

			//	Création de Haut de Page
			function SetHeader() {
				//	Afficher le header de la Page
				header_txt = "<div id='logo'>";
				header_txt += "<img src='images/ico/logo.png' alt='Logo'>";
				header_txt += "<h1>Zozor</h1>";
				header_txt += "<h2>Carnets de voyage</h2>";
				header_txt += "</div";
				header_txt += "><div id='btn_menu'>"
				header_txt += "<div id='cadre' title='Affichage du Menu'>";
				header_txt += "<div class='trait' id='trait01'></div";
				header_txt += "><div class='trait' id='trait02'></div";
				header_txt += "><div class='trait' id='trait03'></div>";
				header_txt += "</div>";
				header_txt += "</div>";

				header_site.innerHTML = header_txt;
			}

			//	Afficher le Header
			SetHeader();
		}
	}
)();