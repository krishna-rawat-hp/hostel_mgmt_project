 <?php

 function getRoomDetailByNo($roomno){
        $recs = Array();
        $con = getConnection();
        $result = $con->query("select * from rooms where room_no='$roomno';");
        while($rec = $result->fetch_assoc()){
            $recs[] = $rec;
        }
        $con->close();
        return $recs;
    }
?>