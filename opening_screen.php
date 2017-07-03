<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>空席照会（予約）トップ -Bookin Seats-</title>
<link rel="stylesheet" href="styles/default.css" />
<script src="scripts/main.js"></script>
</head>
<body>
	<section id="main">
		<p id="opening-message">ようこそ当店へ！<br />
		お手数ですが、本システムをご利用頂き、空席がある場合はクルーがご案内致します。<br />
		残念ながら空席が無い場合は、ご予約を承ります。</p>
		<span>　　※ご利用方法については、<a href="#" id="main-howto">こちら</a>をクリックして下さい。</span>
		<div class="clear"></div>
		<form name="dInput" action="confirm.php" method="post" id="data-input">
			<label>人数<input type="text" name="members" id="members" maxlength="3" placeholder="1〜50" /></label>
			<input type="button" value="カウンター" name="counter" id="counter" class="seat-type-btn btn" onclick="toggleBtn(0)" />
			<input type="hidden" id="set-counter" class="anySeatClearance" name="" />
			<input type="button" value="テーブル席" name="table" id="table" class="seat-type-btn btn" onclick="toggleBtn(1)" />
			<input type="hidden" id="set-table" class="anySeatClearance" name="" />
			<input type="button" value="座敷席" name="tatami" id="tatami" class="seat-type-btn btn" onclick="toggleBtn(2)" />
			<input type="hidden" id="set-tatami" class="anySeatClearance" name="" />
			<input type="button" value="不問" name="anySeat" id="any-seat" class="any-seat-btn btn" onclick="anySeatBtn()" />
			<input type="hidden" id="set-anySeat" name="" />
			<p id="btn-notice">※不問以外、複数選択可能です。</p>
			<input type="submit" value="入力確認" name="inputConfirm" id="input-confirm" class="btn" />
			
			<input type="submit" value="入力チェック" id="submit-btn" class="btn" />
		</form>
	</section>
</body>
</html>