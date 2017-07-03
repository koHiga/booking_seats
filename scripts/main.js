/* メイン画面 */	
function toggleBtn (num){
	var seatTypeBtn = document.getElementsByClassName("seat-type-btn");
	var idsToSet = "set-" + seatTypeBtn[num].name;
	var seatTypeBtnName = seatTypeBtn[num].name + "Set";
	var anySeatBtn = document.getElementById("any-seat");
	
	if (seatTypeBtn[num].classList.contains("active")){
		seatTypeBtn[num].classList.remove("active");
		document.getElementById(idsToSet).name = "";
	} else {
		seatTypeBtn[num].classList.add("active");
		anySeatBtn.classList.remove("active");
		document.getElementById(idsToSet).name = seatTypeBtnName;
		document.getElementById("set-anySeat").name = "";
	};
}
function anySeatBtn (){
	var anySeatId = document.getElementById("any-seat");
	var seatTypeBtnClass = document.getElementsByClassName("seat-type-btn");
	var idsToSet = "set-" + seatTypeBtnClass.name;
	var nameClearance = document.getElementsByClassName("anySeatClearance");
		
	if (anySeatId.classList.contains("active")){
		anySeatId.classList.remove("active");
	} else {
		anySeatId.classList.add("active");
		document.getElementById("set-anySeat").name = anySeatId.name + "Set";
		for (var i = 0; i < seatTypeBtnClass.length; i++){
			seatTypeBtnClass[i].classList.remove("active");
		};
		for (var i = 0; i < nameClearance.length; i++){
			nameClearance[i].name = "";
		}
	};
}
