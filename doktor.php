<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Kod Doktora</title>
</head>
<body>	

<?php
class Doktor
{
	private $ime, $prezime, $specijalnost;
	
	public function zakaziPregled(Pacijent $pacijent, Pregled $pregled)
}

class Pacijent
{
	private $ime, $prezime, $jmbg, $bzk;
	private $doktor = null;
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
?>

</body>
</html>
	