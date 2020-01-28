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

	public function zakaziPregled(Pacijent $pacijent, Pregled $pregled) {}
}

class Pacijent extends Logovanje
{
	private $ime, $prezime, $jmbg, $bzk;
	private $ispis;
	private $doktor = null;
	public function __construct($ime, $prezime, $jmbg, $bzk) {
		$this->ime = $ime;
		$this->prezime = $prezime;
		$this->jmbg = $jmbg;
		$this->bzk = $bzk;
		$this->details = "Kreiran pacijent ".$this->ime;
		$this->ispis = $this->trenutno();
	}
	public function izaberiLekara(Doktor $doktor) {
		// logovanje
	}
	public function obaviPregled(Pregled $pregled) {
		// logovanje
	}
}

abstract class Pregled
{
	protected $datum, $vreme;
}

class KrvniPritisak extends Pregled {
	private $gornjaVrednost, $donjaVrednost, $puls;
}
class SecerUKrvi extends Pregled {
	private $vrednost, $vremePoslObroka;
}
class HolesterolUKrvi extends Pregled {
	private $vrednost, $vremePoslObroka;
}

$doktor_1 = new Doktor("Milan", "Markovic", "sve i svasta");
$pacijent_1 = new Pacijent("Dragan", "Jovanovic", "1232343458787", "344898");

?>

</body>
</html>
	