let lookupbtn;
let srch;

window.onload=function(){

    let httpRequest1;
    let httpRequest2;
    lookup_Countrybtn=document.getElementById("lookup");
    lookup_Countrybtn.addEventListener("click", function(element){
        element.preventDefault();
        
        httpRequest1= new XMLHttpRequest();

        srch=document.getElementById("country").value;
        //let lookup_file1="world.php?country=" + srch;
        //console.log(lookup_file);
        httpRequest1.onreadystatechange= loadCountry;
        httpRequest1.open('GET',"world.php?country=" + srch);
        httpRequest1.send();

    });

    lookup_Citybtn=document.getElementById("lookup_City");
    lookup_Citybtn.addEventListener("click", function(element){
        element.preventDefault();

        httpRequest2= new XMLHttpRequest();

        srch=document.getElementById("country").value;
        //let lookup_file2="world.php?country="+srch+"&lookup=cities";
        //console.log(lookup_file);
        httpRequest2.onreadystatechange= loadCity;
        httpRequest2.open('GET',"world.php?country="+srch+"&lookup=cities");
        httpRequest2.send();

    });

    function loadCountry(){

        if (httpRequest1.readyState === XMLHttpRequest.DONE){
            if(httpRequest1.status ===200){
                let response= httpRequest1.responseText;
                let result = document.querySelector('#result');
                result.innerHTML=response;
            } else{
                alert('There was a problem with the request.');
            }
        }
    }

    function loadCity(){

        if (httpRequest2.readyState === XMLHttpRequest.DONE){
            if(httpRequest2.status ===200){
                let response= httpRequest2.responseText;
                let result = document.querySelector('#result');
                result.innerHTML=response;
            } else{
                alert('There was a problem with the request.');
            }
        }
    }

}