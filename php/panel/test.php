<?PHP
	ob_start();


	$tarih = new DateTime();

	echo "Önümüzdeki 20 Gün:\n";

	for ($i = 0; $i <= 20; $i++) {
		// Her döngüde tarihe 1 gün ekle
		$tarih->modify('+1 day');
		
		// İstediğin formatta ekrana yazdır (Gün.Ay.Yıl)
		echo $i . ". Gün: " . $tarih->format('d.m.Y') . "\n";
	}

?>