<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Kod Doktora</title>
</head>
<body>	

<?php
class Logovanje
{
	protected $details;
	public function trenutno() {
		date_default_timezone_set("Europe/Belgrade");
		$note = date("[d.m.Y h:i:s]")." ".$this->details."\r\n";
		error_log($note, 3, "izlazi.log");
	}
}

class Doktor extends Logovanje
{
	private $ime, $prezime, $specijalnost;
	private $ispis;
	private static $zakazanPregled = false;

	public function __construct($ime, $prezime, $specijalnost) {
		$this->ime = $ime;
		$this->prezime = $prezime;
		$this->specijalnost = $specijalnost;
		$this->details = "Kreiran doktor ".$this->ime;
		$this->ispis = $this->trenutno();
		echo $this->details."<br>"; 
	}
	public function getIme() {
		return $this->ime;
	}
	public function zakazujePregled(Pregled $pregled, Pacijent $pacijent) {
		if ($pacijent->izabranLekar() == true) {
			echo "Doktor ".$this->ime." zakazuje pregled za ".$pregled->getIme()." za pacijenta ".$pacijent->getIme()."<br>";
			self::$zakazanPregled = true;
		} else {
			echo "Pacijent ".$pacijent->getIme()." nije izabrao doktora ".$this->ime.". Nema zakazivanja pregleda.<br>";
		}
	}
	public static function zakazanPregled() {
		if(self::$zakazanPregled == true) {
			return true;
		} else {
			return false;
		}
	}
}

class Pacijent extends Logovanje
{
	private $ime, $prezime, $jmbg, $bzk;
	private $ispis;
	private $doc = null;
	private $izabranLekar = false;
	//private $pregled = null;
	public function __construct($ime, $prezime, $jmbg, $bzk) {
		$this->ime = $ime;
		$this->prezime = $prezime;
		$this->jmbg = $jmbg;
		$this->bzk = $bzk;
		$this->details = "Kreiran pacijent ".$this->ime;
		$this->ispis = $this->trenutno();
		echo $this->details."<br>";
	}
	public function biraLekara(Doktor $doktor) {
		if ($this->doc == null) {
			$this->doc = $doktor->getIme();
			$this->izabranLekar = true;
			$this->details = "Pacijent ".$this->ime." bira doktora ".$doktor->getIme() ;
			$this->ispis = $this->trenutno();
			echo $this->details."<br>";
		} else {
			echo "Pacijent ".$this->ime." vec ima izabranog lekara<br>";
		}	
	}
	public function izabranLekar() {
		if($this->izabranLekar == true) {
			return true;
		} else {
			return false;
		}
	}

	public function obavljaPregled(Pregled $pregled) {
		if (Doktor::zakazanPregled() == true) {
			$this->details = "Pacijent ".$this->ime." obavlja laboratorijski pregled za ".$pregled->getIme() ;
			$this->ispis = $this->trenutno();
			echo $this->details."<br>";
			echo "Rezultati<br>";
		} else {
			echo "Pacijent ".$this->ime." nema zakazan laboratorijski pregled za ".$pregled->getIme()."<br>";
		}

	}
	public function getIme() {
		return $this->ime;
	}
}

abstract class Pregled
{
	protected $datum, $vreme;
	
	public function setTermin($datum, $vreme){
		$this->datum = $datum;
		$this->vreme = $vreme;
	}
	
	//// moramo definisati rezultate pre metoda infoPregleda
	public function infoPregleda(){
		echo "Datum pregleda: $this->datum, vreme: $this->vreme.<br>";
	}
	
	abstract public function getIme();
}

class KrvniPritisak extends Pregled {
	private $gornjaVrednost, $donjaVrednost, $puls;
	
	public function getIme() {
		return "merenje krvnog pritiska";
	}

}
class SecerUKrvi extends Pregled {
	private $vrednost, $vremePoslObroka;
	
	public function getIme() {
		return "merenje nivoa secera u krvi";
	}
}
class HolesterolUKrvi extends Pregled {
	private $vrednost, $vremePoslObroka;
	
	public function getIme() {
		return "merenje nivoa holesterola u krvi";
	}
}

$doktor_1 = new Doktor("Milan", "Markovic", "sve i svasta");
$pacijent_1 = new Pacijent("Dragan", "Petrovic", "1232343458787", "344898");
$pacijent_1->biraLekara($doktor_1);

$pregled_secerUkrvi_1 = new SecerUKrvi();
$pregled_krvniPritisak_1 = new KrvniPritisak();

$doktor_1->zakazujePregled($pregled_secerUkrvi_1, $pacijent_1);
$doktor_1->zakazujePregled($pregled_krvniPritisak_1, $pacijent_1);

$pacijent_1->obavljaPregled($pregled_secerUkrvi_1);


$doktor_2 = new Doktor("Snezana", "Kovacevic", "kardiolog");

$pacijent_2 = new Pacijent("Goran", "Kovac", "4324343243243", "576998");
$pacijent_2->biraLekara($doktor_1);
$pacijent_2->biraLekara($doktor_2);
$pacijent_2->biraLekara($doktor_1);
?>

</body>
</html>
	