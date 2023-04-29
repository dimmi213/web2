<?php 
class dbconnect{
    function connect(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $DB = "data_web2";
        // Create connection
        $conn = new mysqli($servername, $username, $password,$DB);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
        // echo "Connected successfully";
    }
    function select($query,$conn){
        $result = mysqli_query($conn, $query);
        return $result;
    }
    function insert($query,$conn){
        if ($query->execute()===True) {
            header("Location:".$_SERVER["HTTP_REFERER"]);
        } else {
           echo "Error: " . $query . "<br>" . $conn->error;
        }
        $conn->close();
    }
    function delete($query,$conn){
        if (mysqli_query($conn, $query)) {
            header("Location:".$_SERVER["HTTP_REFERER"]);
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
} 
 ?>