<?php
class DateAjout {
    //  Variable de la date
    private $lastTime;

    private $lastJour;
    private $lastMois;
    private $lastAnnee; 
    private $lastHour;
    private $lastMinute;
    private $lastSec;

    private $JourSemaine = array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');
    
    private $Mois = array(null, "Janvier", "Février", "Mars", "Avril", "Mai", "Juin",
                    "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre");

    //  Contructeur
    public function __construct($AjoutDay){
        $this -> setAjoutDay($AjoutDay);
    }

    
    //  Getter
    private function getLastTime(){
        return $this -> lastTime;
    }

    public function getLastDay($Day){
        $lastday = '';
        if ($Day){
            $lastday = $this -> JourSemaine[date('w', $this -> getLastTime())];
        }
        return $lastday.' '. date('d', $this -> getLastTime());
    }

    public function getLastMonth($Month){
        $lastMonth = date('m', $this -> getLastTime());
        if ($Month){
            $lastMonth = $this -> Mois[intval($lastMonth)];
        }
        return $lastMonth; 
    }

    public function getLastYear(){
        return date('Y', $this -> getLastTime());
    }

    public function getLastHour(){
        return date("H", $this -> getLastTime());
    }

    public function getLastMinute(){
        return date('i', $this -> getLastTime());
    }

    public function getLastSec(){
        return date('s', $this -> getLastTime());
    }


    //  setter
    private function setAjoutDay($Day){
        $this -> lastTime = strtotime($Day);
    }
}