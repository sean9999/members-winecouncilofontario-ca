function addFood() {
	foodname_en = prompt('Enter the name of your food item in English','');
	foodname_fr = prompt('Enter the name of your food item in French','');
	location.href	= '?action=create_food&foodname_en=' + foodname_en + '&foodname_fr=' + foodname_fr;
}

function addWine() {
	wn = prompt('Enter the name of the wine','');
	wc = prompt('Enter the colour of the wine','');
	location.href	= '?action=add_wine&wn=' + wn + '&wc=' + wc;
}