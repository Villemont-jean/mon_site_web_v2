/* Modificateur de Menu */
(
	function() {

		document.addEventListener('DOMContentLoaded', chargementDOM_Menu, false);

		function chargementDOM_Menu() {
			var menu = document.getElementById('menu'),
				btnmobile = document.getElementById('btn_menu'),
				cadre = document.getElementById('cadre'),
				trait01 = document.getElementById('trait01'),
                trait02 = document.getElementById('trait02'),
                trait03 = document.getElementById('trait03'),
                activity = false,
				Mns_Txt = ['Accueil', 'Galerie', 'Produits', 'Contacts'];

			//	Création de Menu
			function SetMenu(Mns_Type) {
				
				var Accueil = '<li><a href="index.html"',
					Blog = '<li><a href="blog.html"',
					cv = '<li><a href="cv.html"',
					Contacts = '<li><a href="contacts.html"',
					Sel = ' id="SelectMenu"',
					Txt;
				
				switch(Mns_Type) {
					case 0:
						Accueil += Sel;
						break;
					case 1:
						Blog += Sel;
						break;
					case 2:
						cv += Sel;
						break;
					case 3:
						Contacts += Sel;
						break;
				}

				Txt = '<ul>';
				Txt += Accueil + '>Accueil</a></li';
				Txt += '>' + Blog + '>Blog</a></li';
				Txt += '>' + cv + '>cv</a></li';
				Txt += '>' + Contacts + '>Contacts</a></li>';
				Txt += '</ul>';

				menu.innerHTML = Txt;
			}

			//	Afficher le Menu Personnalier pour Chaque page
			SetMenu(Mns);
			
			//	Affichage du Menu selon l'action du Button
			btnmobile.addEventListener('click', affichercacher, false);

			function affichercacher() {
				menu.classList.toggle('inactive');

				cadre.classList.toggle('actived');
                
                if (!activity) {
	                trait01.style.marginTop = '2em';
                	trait03.style.marginTop = '2em';
                	trait02.style.marginBottom = '-2em';
                	activity = true;
                }else{
                	trait01.style.marginTop = '0';
                	trait03.style.marginTop = '0';
                	trait02.style.marginBottom = '0';
                	activity = false;
                }

                trait01.classList.toggle('trait04');
                trait03.classList.toggle('trait04');
                trait02.classList.toggle('trait04');
			}
		}
	}
)();