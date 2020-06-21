let control=document.getElementById('control');
let year=document.getElementById('year');
let month=document.getElementById('month');
let day=document.getElementById('day');
let hour=document.getElementById('hour');
let minute=document.getElementById('minute');

let objSended;
let prenota;

function showDispo(contenitore,contenuto) {
     
    if (objSended =='') {
       document.getElementById('err').innerText="Seleziona la data";
    }
    else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
                prenota=document.getElementById('prenota');
            }
        };
        xmlhttp.open("GET", "backEnd/dbUtility/select.php?" + contenitore +"=" + contenuto, true);
        xmlhttp.send();
    }
}



control.addEventListener('click',() => {
    
    if (year.value!=0 && month.value!=0 && day.value!=0 && hour.value!=0 && minute.value!=0 ) {
        objSended=[year.value,month.value,day.value,hour.value,minute.value];
        showDispo('q', objSended);
        document.getElementById('err').innerText="";
        
    }else{
        document.getElementById('err').innerText="Seleziona la data";
    }
});

function clear(){
    document.getElementById('err').innerText="";
}
year.addEventListener('change',clear);
month.addEventListener('change',clear);
day.addEventListener('change',clear);
hour.addEventListener('change',clear);
minute.addEventListener('change',clear);
