<?php
try {
	$pdo = new PDO(
			'mysql:dbname=php_demo;host=localhost;charset=utf8',
			'root',
			'root',
			[
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
					PDO::ATTR_EMULATE_PREPARES => false,
			]);
} catch (Exception $e) {
	alert('データベース接続に失敗しました。'.$e->getMessage());
}

$sql = $pdo->query(
		'SELECT *
		FROM booking_seats'
		);
$remain_results = $sql->fetchAll(PDO::FETCH_ASSOC);

$cntr_remain = $remain_results[0]["capacity"];
$tbl2p_remain = $remain_results[1]["capacity"];
$tbl4p_remain = $remain_results[2]["capacity"];
$ttm_remain = $remain_results[3]["capacity"];

$tbl2p_amount = $tbl2p_remain * 2;
$tbl4p_amount = $tbl4p_remain * 4;
$ttm_amount = $ttm_remain * 6;


if (isset($_POST['confirmdBtn'])) {
	$members = (int)filter_input(INPUT_POST, 'members');
	if (isset($_POST['counter'])) { $counter = (string)filter_input(INPUT_POST, 'counter'); }
	if (isset($_POST['table'])) { $table = (string)filter_input(INPUT_POST, 'table'); }
	if (isset($_POST['tatami'])) { $tatami = (string)filter_input(INPUT_POST, 'tatami'); }
	if (isset($_POST['anySeat'])) { $anySeat = (string)filter_input(INPUT_POST, 'anySeat'); }
}


function mbrsDivider($m) {
	switch ($m) {
		case 1;
		case 2;
		$mbrsDiv2 = 1;
		$mbrsDiv4 = 1;
		$mbrsDiv6 = 1;
		break;
		case 3;
		case 4;
		$mbrsDiv2 = 2;
		$mbrsDiv4 = 1;
		$mbrsDiv6 = 1;
		break;
		case 5;
		case 6;
		$mbrsDiv2 = 3;
		$mbrsDiv4 = 2;
		$mbrsDiv6 = 1;
		break;
		case ($m >= 7):
			if ($m % 2 !== 0) {
				$mbrsDiv2 = floor($m / 2) + 1;
			} else {
				$mbrsDiv2 = floor($m / 2);
			}
			if ($m % 4 !== 0) {
				if ($m % 4 <= 2) {
					$mbrsDiv4and2 = floor($m / 4).'and2';
				} elseif ($m % 4 > 2 && $m % 4 <= 4) {
					$mbrsDiv4 = floor($m / 4) + 1;
				}
			} else {
				$mbrsDiv4 = floor($m / 4);
			}
			if ($m % 6 !== 0) {
				$mbrsDiv6 = floor($m % 6) + 1;
			} else {
				$mbrsDiv6 = floor($m / 6);
			}
			break;
		default:
			;
			break;
	}
}


//ここから空席判断
if ($counter != null) {
	if ($members <= $cntr_remain) {
		echo 'カウンターに空席があります。';
	} else {
		echo 'カウンターに空席はありません。';
	};
};

if ($table != null) {
	if ($members <= 2) {
		if ($tbl2p_remain >= 1 && $tbl4p_remain >= 1) {
			echo '2名と4名テーブル席の両方に空席があります。';
		} elseif ($tbl2p_remain < 1 && $tbl4p_remain >= 1) {
			echo '4名テーブル席に空席があります。';
		} elseif ($tbl2p_remain >= 1 && $tbl4p_remain < 1) {
			echo '2名テーブル席に空席があります。';
		} else {
			echo 'テーブル席に空席はありません。';
		}
	} elseif ($members > 2 && $members <= 4) {
		if ($tbl4p_remain >= 1) {
			echo '4名テーブル席に空席があります。';
		} else {
			echo 'テーブル席に空席はありません。';
		}
	} elseif ($members > 4) {
		mbrsDivider($members);
		var_dump($mbrsDiv4);
	}
}

if ($tatami != null) {
	if ($members <= $ttm_amount) {
		echo '座敷席に空席があります。';
	} else {
		echo '座席席に空席はありません。';
	}
}




function cntrVacancyCheck($cntr_remain, $m) {
	if ($cntr_remain >= $m) {
		echo 'カウンターに空席あり<br />';
	}
}

$seatTypes = array(
		0 => array($cntr_remain => 'カウンター'),
		1 => array($tbl2p_remain => '2名テーブル席'),
		2 => array($tbl4p_remain => '4名テーブル席'),
		3 => array($ttm_remain => '座敷席')
);

if ($anySeat != null) {
	switch ($members) {
		case 1:
			for ($i = 0; $i <= 3; $i++) {
				foreach ($seatTypes[$i] as $key => $value) {
					if ($key >= 1) {
						echo $value.'に空席あり<br />';
					};
				};
			}
			break;
			
		case 2:
			cntrVacancyCheck(2);
			for ($i = 1; $i <= 3; $i++) {
				foreach ($seatTypes[$i] as $key => $value) {
					if ($key >= 1) {
						echo $value.'に空席あり<br />';
					}
				}
			}
			break;
			
		case 3:
			cntrVacancyCheck(3);
			if ($tbl2p_remain >= 2) {
				echo '2名テーブル席に空席あり<br />';
			}
			for ($i = 2; $i <= 3; $i++) {
				foreach ($seatTypes[$i] as $key => $value) {
					if ($key >= 1) {
						echo $value.'に空席あり<br />';
					}
				}
			}
			break;
			
		case 4:
			cntrVacancyCheck(4);
			if ($tbl2p_remain >= 2) {
				echo '別々の2名テーブル席に空席あり<br />';
			}
			for ($i = 2; $i <= 3; $i++) {
				foreach ($seatTypes[$i] as $key => $value) {
					if ($key >= 1) {
						echo $value.'に空席あり<br />';
					}
				}
			}
			break;
		case 5:
			mbrsDivider($members);
			var_dump($mbrsDiv2);
		default:
			;
		break;
	};
}

?>

<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>結果照会 -Booking Seats-</title>
<style type="text/css"></style>
</head>
<body>
<?php

?>

</body>
</html>
