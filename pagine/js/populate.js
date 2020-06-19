var hourSelect = document.getElementById('hour');
	hourSelect.style.borderRadius = "25px";
	hourSelect.style.backgroundImage ="linear-gradient(62deg, #8EC5FC 0%, #E0C3FC 100%)";
	hourSelect.style.padding="5px";
	hourSelect.style.outline="none";
	
var option = document.createElement('option');
    option.textContent = "Giorno";
    option.value = "";
    hourSelect.appendChild(option);
	
	for(var i = 1; i <= 31; i++) {
	    var option = document.createElement('option');
	    option.textContent = i;
	    option.value = i;
	    option.style.backgroundColor ="#8EC5FC";
	    hourSelect.appendChild(option);
  }
  
 var minuteSelect = document.getElementById('minute');
  for(var i = 0; i <= 59; i++) {
    var option = document.createElement('option');
    option.textContent = (i < 10) ? ("0" + i) : i;
    option.value = i;
    minuteSelect.appendChild(option);
  }