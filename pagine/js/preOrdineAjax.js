

let nome=document.getElementById('nome');


function booking(contenitore,contenuto){
    var xmlhttp = new XMLHttpRequest();
        
    xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
                
                
            }
    };
    
    xmlhttp.open("GET", "backEnd/preOridne.php?" + contenitore +"=" + contenuto, true);
    xmlhttp.send();
}

function book(){
    
    if (year.value!=0 && month.value!=0 && day.value!=0 && hour.value!=0 && minute.value!=0 && nome.value!="" && email.value!="" ) {
        objSended=[year.value,month.value,day.value,hour.value,minute.value,nome.value,email.value];
        booking('q', objSended);
        
    }else{
        document.getElementById('err1').innerText="Per favore, compila tutti i campi";
    }
};