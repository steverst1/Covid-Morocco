<!DOCTYPE html>
<html>
<head>
	<title>Covid-Morocco</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

</body>
</html>
<?php

require "Cases.php";

$data_url = "https://m.le360.ma/covidmaroc/";

$covidmaroc = file_get_contents($data_url);
$cases = new DOMDocument();
@$cases->loadHTML($covidmaroc);
$index=0;

$pattern = "/(\d{2}-\d{2}-\d{4})/";
preg_match($pattern, 
	$cases->getElementsByTagName("small")[0]->nodeValue, $date);
echo "<div class='danger Date'>".$date[0]."</div>";

echo "<div class='container'>";
foreach($cases->getElementsByTagName("small") as $case):
	switch ($index) {
		case Cases::Confirmed:
			echo "<span class='danger Confirmed'>".$case->nodeValue."</span>";
			break;
		case Cases::Healed:
			echo "<span class='danger Healed'>".$case->nodeValue."</span>";
			break;
		case Cases::Death:
			echo "<span class='danger Death'>".$case->nodeValue."</span>";
			break;
		default:
			# later on ...
			break;
	}
	$index++;
endforeach;
echo "</div>";
?>