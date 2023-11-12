/*	Modificateur de l'index */
(
	function (){
		document.addEventListener('DOMContentLoaded', chargementDOM_Index, false);

		function chargementDOM_Index() {
			//	Variables Global
			var cont11 = document.getElementById('cont11'),
                cont12 = document.getElementById('cont12'),
                cont21 = document.getElementById('cont21'),
                cont22 = document.getElementById('cont22'),
                cont31 = document.getElementById('cont31'),
                cont32 = document.getElementById('cont32'),
                about_as = document.getElementById('about_as'),
                event_as = document.getElementById('event_as'),
                lien_as = document.getElementById('lien_as'),
                cont_as = document.getElementById('cont_as'),
                btnup_as = document.getElementById('btnup_as'),
                numupas = 2;

            //	Appelle des Fonctions d'affichage des Paragraphes
            cont11.addEventListener('click', viewcont12, false);
            cont21.addEventListener('click', viewcont22, false);
            cont31.addEventListener('click', viewcont32, false);

            //  Change le contenue de l'Aside
            about_as.addEventListener('click', ChangeAbout, false);
            event_as.addEventListener('click', ChangeEvent, false);
            lien_as.addEventListener('click', ChangeLiens, false);

            //	Appelle de la fonction view and show de l'aside
            btnup_as.addEventListener('click', BtnUpAsClick, false);

            //  Afficher le premier Aside
            ChangeAside(0);

            //	Affichages des Paragraphes
            function viewcont12 () {
                showAll();
                cont11.classList.toggle('p_show');
                cont12.classList.toggle('p_show');
            }

            function viewcont22() {
                showAll();
                cont21.classList.toggle('p_show');
                cont22.classList.toggle('p_show');
            }

            function viewcont32() {
                showAll();
                cont31.classList.toggle('p_show');
                cont32.classList.toggle('p_show');
            }

            function showAll() {
                cont11.classList.remove('p_show');
                cont12.classList.add('p_show');
                cont21.classList.remove('p_show');
                cont22.classList.add('p_show');
                cont31.classList.remove('p_show');
                cont32.classList.add('p_show');
            }

            //  Change les Onglets
            function ChangeAbout() {
                //  Mets tous les Onglets en noSel
                ChangeOnglets();

                about_as.classList.remove('nosel_as');
                about_as.classList.add('sel_as');

                ChangeAside(0);
            }

            function ChangeEvent() {
                ChangeOnglets();

                event_as.classList.remove('nosel_as');
                event_as.classList.add('sel_as');

                ChangeAside(1);
            }

            function ChangeLiens() {
                ChangeOnglets();

                lien_as.classList.remove('nosel_as');
                lien_as.classList.add('sel_as');

                ChangeAside(2);
            }

            function ChangeOnglets() {
                about_as.classList.remove('sel_as');
                event_as.classList.remove('sel_as');
                lien_as.classList.remove('sel_as');

                about_as.classList.add('nosel_as');
                event_as.classList.add('nosel_as');
                lien_as.classList.add('nosel_as');
            }

            //  Change le contenue de l'Aside
            function ChangeAside(AsShow) {
                var TxtAs;

                switch(AsShow) {
                    case 0: //  About
                        TxtAs = "<h2>Á PROPOS DE L'AUTEUR</h2>";
                        TxtAs += '<div id="profil"><img src="images/zozoraside.png" alt="mon profil" /></div>';
                        TxtAs += "<p>Laisse-moi le temps de me présenter : je m'appelle Zozor, je suis né un 23 Novembre 2005</p>";
                        TxtAs += "<p>Bien maigre, n'est-ce pas ? C'est pourquoi, aujourd'hui, j'ai décidé d'écrire ma biographie (ou zBiographie, comme vous voulez !) afin que tous le monde sachent enfin quu je suis réellement.</p>";
                        break;
                    case 1: //  Evénments
                        TxtAs = '<h2>Événements</h2>';
                        TxtAs += '<div id="cadreevcm">';
                        TxtAs += '<h3>Mardi 3 Février 2016</h3>';
                        TxtAs += '<ul>';
                        TxtAs += 'Bla bla bla    <strong>à 11H30</strong><br />';
                        TxtAs += 'Parlement Bla bla bla    <strong>à 15H45</strong><br />';
                        TxtAs += 'Bla bla bla    <strong>à 17H00</strong>';
                        TxtAs += '</ul>';
                        TxtAs += '<div id="separeas"><img src="images/ico/separation.png" alt=""></div>'
                        TxtAs += '<h3>Samedi 20 Février 2016</h3>';
                        TxtAs += '<ul>';
                        TxtAs += 'Bla bla bla    <strong>à 09H53</strong><br />';
                        TxtAs += 'Bla bla bla    <strong>à 12H30</strong><br />';
                        TxtAs += 'Bla bla bla    <strong>à 15H25</strong><br />';
                        TxtAs += 'Consert de Garou Zénith Toulouse  <strong>à 20H00</strong>';
                        TxtAs += '</ul>';
                        TxtAs += '<div id="separeas"><img src="images/ico/separation.png" alt=""></div>'
                        TxtAs += '<h3>Dimanche 20 Mars 2016</h3>';
                        TxtAs += '<ul>';
                        TxtAs += 'Bla bla bla    <strong>à 09H53</strong><br />';
                        TxtAs += 'Bla bla bla    <strong>à 12H30</strong><br />';
                        TxtAs += 'Printemps    <strong>à 21H15</strong>';
                        TxtAs += '</ul>';
                        TxtAs += '</div>';
                        break;
                    case 2: //  Commentaires
                        TxtAs = '<h2>Commentaires</h2>';
                        TxtAs += '<div id="cadreevcm">';
                        TxtAs += '<h3>Jean Edmond <strong>27-01-16 à 17H00</strong></h3>';
                        TxtAs += '<ul>';
                        TxtAs += 'Bla bla bla<br />';
                        TxtAs += 'Site Bla bla bla Bla bla bla<br />'
                        TxtAs += "<em>J'aime</em>";
                        TxtAs += '</ul>';
                        TxtAs += '<div id="separeas"><img src="images/ico/separation.png" alt=""></div>'
                        TxtAs += '<h3>Eric Jhon <strong>27-01-16 à 19H56</strong></h3>';
                        TxtAs += '<ul>';
                        TxtAs += 'Bla bla bla<br />';
                        TxtAs += 'Site Bla bla bla Bla bla bla<br />'
                        TxtAs += 'Bla bla bla<br />';
                        TxtAs += "<em>J'aime</em>";
                        TxtAs += '</ul>';
                        TxtAs += '<div id="separeas"><img src="images/ico/separation.png" alt=""></div>'
                        TxtAs += '<h3>Jack Gala <strong>29-01-16 à 9H00</strong></h3>';
                        TxtAs += '<ul>';
                        TxtAs += 'Bla bla bla<br />';
                        TxtAs += 'Site Bla bla bla Bla bla bla<br />'
                        TxtAs += "<em>J'aime pas</em>";
                        TxtAs += '</ul>';
                        TxtAs += '</div>'
                        break;
                }

                cont_as.innerHTML = TxtAs;
            }
            //	View & Show Aside
            function BtnUpAsClick() {
                btnup_as.innerHTML = '<img src="images/ico/btnup'+numupas+'.png" alt="view Aside">';
                numupas++;
                if (numupas>4) { numupas = 1; }
                setTimeout(wait, 500);
            }

            function wait() {
                btnup_as.innerHTML = '<img src="images/ico/btnup'+numupas+'.png" alt="view Aside">';
                numupas++;
                if (numupas>4) { numupas = 1; }

                cont_as.classList.toggle('cont_asview');
            }
		}
	}
)();