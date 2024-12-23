<style>
    .dbresult, .dbresult td, .dbresult th {
        border: 1px solid black;
        border-collapse: collapse;
        padding: 8px;
    }

    .dbresult {
        width: 800px;
        margin: auto;
    }

    .dbresult tr:nth-child(odd) {
        background-color: #b2d0d6;
    }

    .dbresult tr:nth-child(even) {
        background-color: lightcyan;
    }
</style>

<?php

    // $con = mysqli_connect('localhost', 'root', '', 'test');

    // if(!$con) {
    //     die('Connection Error ' . mysqli_connect_error());
    // }

    // echo 'Connection Success';

    // $con = new mysqli('localhost', 'root', '', 'test');

    // if($con->connect_error){
    //     die('Connect Error: ' . $con->connect_error);
    // }

    // echo 'Connection Success';







    // $link = mysqli_connect('localhost', 'root', '', 'test');

    // if(!$link) {
    //     die('Connection Error: '.mysqli_connect_error());
    // } else {
    //     echo 'Connection Successfully';
    // }

    // $link = new mysqli('localhost', 'root', '', 'test');

    // if($link->connect_error){
    //     die('Connection Error: '.$link->connect_error);
    // } else {
    //     echo 'Connection Successfully!';
    // }

        // Fetch Record //
    /*
        1.DB Connection,
        2.Write Query,
        3.Execute Query,
        4.Display Result,
        5.Html Design.
    */

    $link = mysqli_connect('localhost', 'root', '', 'test');

    if(!$link) {
        die('Connection Error: '.mysqli_connect_error());
    }

    $query = 'SELECT id,name1,mobile,age FROM tbl_users';

    $result = mysqli_query($link, $query);

    // print_r($result);

    $numrow = mysqli_num_rows($result);

    if($numrow > 0) {
        // echo 'Records Found'. $numrow ; 
        // $row = mysqli_fetch_assoc($result);
        echo '<table class="dbresult">';
        echo '<tr><th colspan="4"><a href="form-data.php">Go Back</a></th></tr>';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Name</th>';
        echo '<th>Mobile</th>';
        echo '<th>Age</th>';
        echo '</tr>';
        while ($row = mysqli_fetch_assoc($result)) {
            // echo '<pre>';
            // // print_r($row);
            // echo $row['id'];
            // echo $row['name1'];
            // echo $row['mobile'];
            // echo $row['age'];
            // echo '</pre>';
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['name1'] . '</td>';
            echo '<td>' . $row['mobile'] . '</td>';
            echo '<td>' . $row['age'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo 'Records Not Found';
    }

    // Insert Record //

    /* 
        1.DB Connection,
        2.Check table & Its field are created,
        3.Write Query,
        4.Execute Query,
        5.Display Success Message.
    */
    
    // print_r($_GET);

    if(isset($_GET['submitvalue'])){
        $name1 = $_GET['name1'];
        $mobile = $_GET['mobile'];
        $age = $_GET['age'];

        $qry = "INSERT INTO tbl_users(name1,mobile,age) VALUES('$name1','$mobile',$age)";

        $res = mysqli_query($link, $qry);

        if($res) {
            // echo 'Successfully Saved';
            header('location: form-data.php');
        } else {
            echo 'Error while inserting record';
        }
    }

?>