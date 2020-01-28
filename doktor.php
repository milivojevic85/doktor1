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
	public $details;
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

	public function __construct($ime, $prezime, $specijalnost) {
		$this->ime = $ime;
		$this->prezime = $prezime;
		$this->specijalnost = $specijalnost;
		$this->details = "Kreiran doktor ".$this->ime;
		$this->ispis = $this->trenutno();
	}

	public function getIme() {
		return $this->ime;
	}

	public function zakaziPregled(Pacijent $pacijent, Pregled $pregled) {}
}

class Pacijent extends Logovanje
{
	private $ime, $prezime, $jmbg, $bzk;
	private $ispis;
	private $doktor = null;
	private $pregled = null;
	public function __construct($ime, $prezime, $jmbg, $bzk) {
		$this->ime = $ime;
		$this->prezime = $prezime;
		$this->jmbg = $jmbg;
		$this->bzk = $bzk;
		$this->details = "Kreiran pacijent ".$this->ime;
		$this->ispis = $this->trenutno();
	}
	public function izaberiLekara(Doktor $doktor) {
		$this->details = $this->ime. " bira doktora ".$doktor->getIme() ;
		$this->ispis = $this->trenutno();
	}
	public function obavljaPregled(Pregled $pregled) {
		$this->details = $this->ime. " obavlja laboratorijski pregled ".$pregled->getIme() ;
		$this->ispis = $this->trenutno();
	}
}

abstract class Pregled
{
	protected $datum, $vreme;
	abstract public function getIme();
}

class KrvniPritisak extends Pregled {
	private $gornjaVrednost, $donjaVrednost, $puls;
	public function getIme() {
		return "Krvni pritisak";
	}
}
class SecerUKrvi extends Pregled {
	private $vrednost, $vremePoslObroka;
	
	public function getIme() {
		return "Secer u krvi";
	}
}
class HolesterolUKrvi extends Pregled {
	private $vrednost, $vremePoslObroka;
	public function getIme() {
		return "Holesterol u krvi";
	}
}

$doktor_1 = new Doktor("Marko", "Markovic", "sve i svasta");
$pacijent_1 = new Pacijent("Dragan", "Jovanovic", "1232343458787", "344898");
$pacijent_1->izaberiLekara($doktor_1);

$pregled_secerUkrvi_1 = new SecerUKrvi();
$pacijent_1->obavljaPregled($pregled_secerUkrvi_1);


?>

</body>
</html>
	