function selectStyle(smthng, titolo, strt, fnsh){
  smthng.style.borderRadius = "25px";
  smthng.style.backgroundImage ="linear-gradient(62deg, #8EC5FC 0%, #E0C3FC 100%)";
  smthng.style.padding="5px";
  smthng.style.outline="none";
  smthng.style.marginBottom ="1em";
  
  
  addEventListener("focus",()=>{
    smthng.style.border="3px solid grey";
  })

  option = document.createElement('option');
  option.textContent = titolo;
  option.value = "-1";
  smthng.appendChild(option);

  for (var i = strt; i <= fnsh; i++) {
    option = document.createElement('option');
    option.textContent = i<10 ? '0'+i : i ;
    option.value = i;
    option.style.backgroundColor = "#8EC5FC";
    smthng.appendChild(option);
  }


}
  var d= new Date();
 var giorno = document.getElementById('day');
 var oggi=d.getDate() < 25 ? d.getDate() : 0; 
 selectStyle(giorno,'Giorno',oggi,31);	
 
 var mese = document.getElementById('month');
 
var month=d.getMonth()+1;
 selectStyle(mese,'Mese',month,12);
	
var anno = document.getElementById('year');
selectStyle(anno,'Anno',2020,2021);
 
 var ore=document.getElementById('hour');
 selectStyle(ore,'Ore',8,18);
 
 var minuti=document.getElementById('minute');
 selectStyle(minuti,'Minuti',0,59);
 
  