<?php
/* 入力内容確認 */
$log1 = '';
$log2 = '';
$seatTypes = array();
$seatTypesName = array();
$anySeat = '';
$seatTypes_output = '';

if (isset($_POST['members'])) {
	$membersCount = (int)filter_input(INPUT_POST, 'members');
	if ($membersCount <= 0 || $membersCount > 50) {
		$log1 = '<p class="alert">！1から50の整数で入力してください。</p>'."\n";
	}
}

if (isset($_POST['counterSet'])) { $seatTypes[] = "カウンター"; $seatTypesName[] = 'counter'; }
if (isset($_POST['tableSet'])) { $seatTypes[] = "テーブル席"; $seatTypesName[] = 'table'; }
if (isset($_POST['tatamiSet'])) { $seatTypes[] = "座敷席"; $seatTypesName[] = 'tatami'; }
if (isset($_POST['anySeatSet'])) { $anySeat = "anySeat"; }

if ($anySeat == '' && $seatTypes == false) {
	$log2 = '<p class="alert">！座席の種類を選択してください。</p>';
}
?>

<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>確認画面 -Booking Seats-</title>
<style type="text/css">
.normal {
		font-size: 18px;
		font-weight: normal;
}
.alert {
		font-size: 24px;
		font-weight: bold;
		color: #a00;
}
</style>
</head>
<body>
<div id="confirm-wrapper">
<?php 
if ($log1 == '') {
	echo '<form action="inquiry.php" method="post">';
	echo '<h3>人数：</h3>'."\n".'<p class="normal">'.$membersCount.'名様</p>'."\n".'<input type="hidden" name="members" value="'.$membersCount.'" />'."\n";
} else {
	echo $log1;
}

if ($log2 == '') {
	if ($anySeat == '') {
		echo '<h3>座席の種類：<h3>'."\n";
		for ($i = 0; $i < count($seatTypes); $i++) {
			echo '<p class="normal">'.$seatTypes[$i]."</p>\n".'<input type="hidden" name="'.$seatTypesName[$i].'" value="'.$seatTypes[$i].'" />'."\n";
		}
	} elseif ($seatTypes == false) {
		echo '<h3>座席の種類：</h3>'."\n";
		echo '<p class="normal">不問'."</p>\n".'<input type="hidden" name="'.$anySeat.'" value="'.$anySeat.'" />'."\n";
	}
	echo '<input type="submit" name="confirmdBtn" value="この内容で空席確認する" />'."\n";
	echo '</form>';
} else {
	echo $log2;
}
?>
</div>
</body>
</html>