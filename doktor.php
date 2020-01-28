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
	
}

class Doktor
{
	private $ime, $prezime, $specijalnost;
	public function construct() {log}
	public function zakaziPregled(Pacijent $pacijent, Pregled $pregled) {}
}

class Pacijent
{
	private $ime, $prezime, $jmbg, $bzk;
	private $doktor = null;
	public function __construct() {log}
	public function izaberiLekara(Doktor $doktor) {log}
	public function obaviPregled(Pregled $pregled) {log}
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

$doktor_1 = new Doktor();
$pacijent_1 = new Pacijent();

?>

</body>
</html>
	