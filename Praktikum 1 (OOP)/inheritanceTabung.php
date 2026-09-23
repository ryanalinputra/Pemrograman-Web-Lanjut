<?php
class Lingkaran {
    public $jariJari;
    private $phi = 3.14;

    function luasLingkaran()
    {
        $hitung = $this->phi * $this->jariJari * $this->jariJari;
        return $hitung;
    }

    function kelilingLingkaran()
    {
        $hitung = 2 * $this->phi * $this->jariJari;
        return $hitung;
    }
}

class Tabung extends Lingkaran {
    public $tinggi;

    function volumeTabung()
    {
        $hitung = $this->luasLingkaran() * $this->tinggi;
        // $hitung = $this->phi * $this->jariJari * $this->jariJari;
        return $hitung;
    }

    function luasPermukaanTabung()
    {
        $hitung = (2 * $this->luasLingkaran()) + ($this->kelilingLingkaran() * $this->tinggi);
        // $hitung = (2 * $this->phi * $this->jariJari * $this->jariJari) + (2 * $this->phi * $this->jariJari * $this->tinggi);
        return $hitung;
    }
}

$tabung = new Tabung();

$tabung->jariJari = 7;
$tabung->tinggi = 10;

echo "<b>Tabung</b><br/><br/>";
echo "Jari-jari = " . $tabung->jariJari . "<br/>";
echo "Tinggi = " . $tabung->tinggi . "<br/><br/>";
echo "Luas Lingkaran = " . $tabung->luasLingkaran() . "<br/>";
echo "Keliling Lingkaran = " . $tabung->kelilingLingkaran() . "<br/>";
echo "Volume Tabung = " . $tabung->volumeTabung() . "<br/><br/>";
echo "Luas Permukaan Tabung = " . $tabung->luasPermukaanTabung();
?>