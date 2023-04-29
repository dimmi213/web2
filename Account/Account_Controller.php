<?php
if (!isset($_GET["action"]))
    echo "404";
else {
    $action = $_GET["action"];
    include_once("../dbconnect.php");
    $dbcon = new dbconnect();
    $conn = $dbcon->connect();
    if ($action == "insert" || $action == "update") {
        if (isset($_GET["ID"]))
            $ID = $_GET["ID"];
            $Username = $_GET['Username'];
            $Name = $_GET['Name'];
            $Phone = $_GET['Phone'];
            $Address = $_GET['Address'];
            $Password = $_GET['Password'];
            $Type = $_GET['Type'];
        if ($action == "insert") { //insert
            $sql = "INSERT INTO myuser(Username,Name,Phone,Address,Password,Type,Status) VALUES (?,?,?,?,?,?,0)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssssss', $Username, $Name, $Phone, $Address, $Password, $Type);
        } else { //update
            $sql = "Update myuser set Username=?, Name=?, Phone=?, Address=?, Password=?, Type=? Where ID =?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sssssss', $Username, $Name, $Phone, $Address, $Password, $Type, $ID);
        }
        $dbcon->insert($stmt, $conn);
    } else { //delete
        $sql = "DELETE FROM myuser WHERE ID='" . $_GET["ID"] . "'";
        $dbcon->delete($sql, $conn);
    }
}
