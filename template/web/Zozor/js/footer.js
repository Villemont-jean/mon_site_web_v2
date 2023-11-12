/*	Modificateur du footer */
(
	function () {
		document.addEventListener('DOMContentLoaded', chargementDOM_Footer, false);

		function chargementDOM_Footer() {
			//	Variables Global 1
			var footer = document.getElementById('footer'),
                txtfoot;

            function ViewFooter(IdView) {
            	txtfoot = "<div id='sepfoot'><img src='images/ico/footer_separator.png' alt=''></div>";
            	txtfoot += "<div id='footup'><a href='#''><img src='images/ico/ico_top.png' alt=''></a></div>";
            	if (IdView) {
            		txtfoot += "<div id='tweet'>";
            		txtfoot += "<h1 id='tweeth1'>mon drenier tweet</h1>";
            		txtfoot += "<div id='viewtweet' class='decal footshow'>";
            		txtfoot += "<p>Hii haaaaaan !</p>";
            		txtfoot += "<p>le 12 mai à 23h12</p>";
            		txtfoot += "</div>";
            		txtfoot += "</div";
            		txtfoot += "><div id='photos'>";
            		txtfoot += "<h1 id='photoh1'>mes photos</h1>";
            		txtfoot += "<div id='viewphotos' class='decal footshow'>";
            		txtfoot += "<div id='photo01' class='photofooter'><a href='#'><img src='images/miniatures/photo1.jpg' alt='photo01' title='Photo 01'></a></div";
            		txtfoot += "><div id='photo02' class='photofooter'><a href='#'><img src='images/miniatures/photo2.jpg' alt='photo02' title='Photo 02'></a></div";
            		txtfoot += "><div id='photo03' class='photofooter'><a href='#'><img src='images/miniatures/photo3.jpg' alt='photo03' title='Photo 03'></a></div";
            		txtfoot += "><div id='photo04' class='photofooter'><a href='#'><img src='images/miniatures/photo4.jpg' alt='photo04' title='Photo 04'></a></div>";
            		txtfoot += "</div>";
            		txtfoot += "</div";
            		txtfoot += "><div id='friends'>";
            		txtfoot += "<h1 id='friendsh1'>mes amis</h1>";
            		txtfoot += "<div id='viewfriends' class='decal footshow'>";
            		txtfoot += "<ul>";
            		txtfoot += "<li><a href='#'>Pupi le lapin</a></li>";
            		txtfoot += "<li><a href='#'>Mr Baobab</a></li>";
            		txtfoot += "<li><a href='#'>Kaiwaii</a></li>";
            		txtfoot += "<li><a href='#'>Perceval.eu</a></li>";
            		txtfoot += "</ul";
            		txtfoot += "><ul>";
            		txtfoot += "<li><a href='#'>Belette</a></li>";
            		txtfoot += "<li><a href='#'>Le concombre masqué</a></li>";
            		txtfoot += "<li><a href='#'>P'tit prince</a></li>";
            		txtfoot += "<li><a href='#'>Mr Fan</a></li>";
            		txtfoot += "</ul>";
            		txtfoot += "</div>";
            		txtfoot += "</div>";
            	}
            	txtfoot += "<div id='mentions'><a href='mention_legal.html' title='Mention Légal'>&copy; Copyright 2016</a></div>";
            	
            	footer.innerHTML = txtfoot;
            }

            //	Afficher le Footer
            ViewFooter(IdFooterView);

            //	Variables Global 2
            var tweeth1 = document.getElementById('tweeth1'),
                viewtweet = document.getElementById('viewtweet'),
                photoh1 = document.getElementById('photoh1'),
                viewphotos = document.getElementById('viewphotos'),
                friendsh1 = document.getElementById('friendsh1'),
                viewfriends = document.getElementById('viewfriends');

            tweeth1.addEventListener('click', TweetShow, false);
            photoh1.addEventListener('click', PhotoShow, false);
            friendsh1.addEventListener('click', FriendsShow, false);
            function TweetShow () {
                AllFooterShow(1);
                viewtweet.classList.toggle('footshow');
            }

            function PhotoShow () {
                AllFooterShow(2);
                viewphotos.classList.toggle('footshow');
            }

            function FriendsShow () {
                AllFooterShow(3);
                viewfriends.classList.toggle('footshow');
            }

            function AllFooterShow(edFooter) {
                switch (edFooter){
                    case 1:
                        viewphotos.classList.add('footshow');
                        viewfriends.classList.add('footshow');
                        break;
                    case 2:
                        viewtweet.classList.add('footshow');
                        viewfriends.classList.add('footshow');
                        break;
                    case 3:
                        viewtweet.classList.add('footshow');
                        viewphotos.classList.add('footshow');
                        break;
                }
            }
		}
	}
)();