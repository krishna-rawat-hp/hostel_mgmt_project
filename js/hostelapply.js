function addRooms(seater, fees){
    document.getElementById('seater').value = seater;
    document.getElementById('fees').value = fees;
}

function clearRooms(){
    document.getElementById('seater').innerHTML = "";
    document.getElementById('fees').innerHTML = "";   
}

function getDetails(){
    var room = document.getElementById("room").value;
    if(room != ""){
        var xmlhttp;
        if (window.XMLHttpRequest) {
            // code for modern browsers
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for old IE browsers
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } 
        
        var rooms = {
            "roomno": room
        };

        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                var roomArray = JSON.parse(xmlhttp.responseText.trim());
                clearRooms();
                    addRooms(roomArray[0].seater, roomArray[0].fees);
            }
        }
        xmlhttp.open("POST", "../scripts/get_roomdetails.php");
        xmlhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xmlhttp.send(JSON.stringify(rooms));
    }else{
        clearRooms();
        alert("please select any RoomNo");
    }
}


function radioCheck(){
    var x = document.getElementById('Yes');
    var fees = document.getElementById('fees').value;
    var a = parseInt(fees);
    if(x.checked == true){
        document.getElementById('amount').value =a+2000;
    }else{
        document.getElementById('amount').value = fees;
    }
}