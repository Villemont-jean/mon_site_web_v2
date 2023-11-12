<?php
class Viewer{
    private $home;
    private $about;
    private $galery;
    private $contact;

    private $bntActivate = 'class="btn-active"';
    private $footerActivate = 'class="footer-active"';
    /*  *********************************** */
    /*  ******** Affichage du Head ******** */
    /*  *********************************** */
    public function ViewHead($Title){
        echo '
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>>WLKJ 3000 [ '. $Title .' ]</title>
    
            <link rel="stylesheet" href="include/style.css">
        </head>';
    }

    /*  ************************************* */
    /*  ******** Affichage du Header ******** */
    /*  ************************************* */
    public function ViewHeader($Menu){
        switch($Menu){
            case 'Home':
                $this -> home = $this -> bntActivate;
                break;
                
            case 'About':
                $this -> about = $this -> bntActivate;
                break;

            case 'Galery':
                $this -> galery = $this -> bntActivate;
                break;

            case 'Contact':
                $this -> contact = $this -> bntActivate;
                break;
            
        }

        echo '
        <header>
            <div class="wallpaper">
                <a href=""><section id="logo">
                    <img id="img-logo" src="img/ui-menu/Logo.png" alt="Logo du Site">
                    <div id="wlkj">
                        <div id="wlkjTitle">
                            <h1>WLKJ 3000 <strong>Developeur Front-End</strong> & <strong>Back-End
                            </strong> ... <strong>Web</strong> & <strong>Game Desing</strong> ... <strong>
                            Animateur 3D</strong> WLKJ 3000</h1>
                        </div>
                        <p>Tous mon savoir<br>faire pour vous !</p>
                    </div>
                </section></a>

                <nav>
                    <ul id="ul-menu">
                        <li '.$this -> home.'id="btn1"><a href="index.php">accueil</a></li>
                        <li '.$this -> about.'id="btn2"><a href="about.php">à propos</a></li>
                        <li '.$this -> galery.'id="btn3"><a href="galery.php">Galerie</a></li>
                        <li '.$this -> contact.'id="btn4"><a href="contact.php">Contact</a></li>
                    </ul>
                </nav>
            </div>

            <div id="menuNav">
                <svg xmlns="http://www.w3.org/2000/svg" width="80px" height="80px" viewBox="0 0 100 100">
                    <path id="top" d="M30.11,39.2h40c20,0,20,35-10,45a40,40,0,0,1-40-65l60,60" transform="translate(-9.82 -13.03)"/>
                    <path id="middle" d="M30.11,49.2h40" transform="translate(-9.82 -13.03)"/>
                    <path id="bottom" d="M70.11,59.2h-40c-20,0-20-40,10-45,21.7-3.9,42.6,9.7,46.7,30.3S76.71,85,55,88.9a41.82,41.82,0,0,1-34.9-9.7l60-60" transform="translate(-9.82 -13.03)"/>
                </svg>
            </div>
        </header>';
    }

    /*  ************************************* */
    /*  ******** Affichage du Footer ******** */
    /*  ************************************* */
    public function ViewFooter($Menu){
        switch($Menu){
            case 'Home':
                $this -> home = $this -> footerActivate;
                break;

            case 'About':
                $this -> about = $this -> footerActivate;
                break;
                
            case 'Galery':
                $this -> galery = $this -> footerActivate;
                break;

            case 'Contact':
                $this -> contact = $this -> footerActivate;
                break;
        }
        
        echo '
        <footer>
            <div class="wallpaper">
                <div id="content-footer">
                    <nav>
                        <ul id="ul-footer">
                            <li '.$this -> home.'id="footer-btn1"><a href="index.php">accueil</a></li>
                            <li '.$this -> about.'id="footer-btn2"><a href="about.php">à propos</a></li>
                            <li '.$this -> galery.'id="footer-btn3"><a href="galery.php">Galerie</a></li>
                            <li '.$this -> contact.'id="footer-btn4"><a href="contact.php">Contact</a></li>
                        </ul>
                    </nav>

                    <div id="friends">
                        <h2>Friends</h2>
                        <a href="tuto.com">Tuto.com</a>
                    </div>
                </div>

                <h3>Copyright &copy; 2023 &copysr;</h3>
            </div>
        </footer>';
    }
}