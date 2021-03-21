<?php
session_start();
$sender=$_SESSION['nam'];
$sid=$_SESSION['id'];
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'customers');
/* Attempt to connect to MySQL database */
$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if(isset($_POST['submit']))
{
$receiver=$_POST['receiver'];
$amount=$_POST['amount'];
$v="select * from customer where name='$sender'";
$va=mysqli_query($con,$v);
$rr=mysqli_fetch_array($va);

if($amount > $rr['currentbalance']){
    
    echo("<script>alert('Insufficient balance in senders account');</script>");
   
    
}
else{
$e="select *from customer where name='$receiver'";
    $o=mysqli_query($con,$e);
    $l=mysqli_fetch_array($o);
    $rid=$l['id'];
$transfer="INSERT INTO `transfer` (`tid`,`sender`,`receiver`,`amount`) VALUES ('','$sender', '$receiver', '$amount')";
if(mysqli_query($con,$transfer))
{
    echo "<script>alert('TRANSACTION SUCCESSFUL!PLEASE CHECK THE TRANSACTION OVERVIEW');</script>";
    
    $s="update customer set currentbalance=currentbalance-'$amount' where id=".$sid;
    $j="update customer set currentbalance=currentbalance+'$amount' where id=".$rid;
    $n=mysqli_query($con,$s);
    $m=mysqli_query($con,$j);
   
}
else{
    
}
}
$t="select * from transfer";
$tt=mysqli_query($con,$t);
}
?>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
     <link rel="icon" href="favicon (3).ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Abel&display=swap" rel="stylesheet">
   
    </head>
    <style>
      .styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 30px rgba(0, 0, 0, 0.25);
}
.styled-table thead tr {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
}
.styled-table th,
.styled-table td {
    padding: 12px 15px;
}
.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}
.styled-table tbody tr:nth-of-type(odd) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}
a.mbtn {
    padding:0.6em 2em;
    border-radius: 25px;
    width: 10cm;
    height: 1.5cm;;
    color:white;
    background-color:#009879;
    font-size:1.1em;
    border:0;
    cursor:pointer;
    margin:1em;
  }
    </style>
    <body style="background-color:#cfdac8;" >
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark ">
      <a class="navbar-brand" href="#" style="padding-left: 30px;;">
          Sparks Bank
      </a>
      <ul class="navbar-nav" style="padding-left: 700px;">
        <li class="nav-item">
          <a class="nav-link" href="index.html">HOME</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="view.php">VIEW CUSTOMERS</a>
        </li>
      </ul>
  </nav>
   
        <table class="table table-hover styled-table" style="width:75%;height:50%;margin-left:200px;">
        <thead>
        <tr>
          <th scope="col">TRANSACTION  ID</th> 
          <th scope="col">SENDER</th>
          <th scope="col">RECEIVER</th>
          <TH scope="col">AMOUNT</TH>
          <TH scope="col"></TH>
        </tr>
        </thead>
        <tbody>
        <?php
        
        while($row=mysqli_fetch_array($tt)){
        echo "<tr><td>".$row['tid']."</td><td>".$row['sender']."</td><td>".$row['receiver']."</td><td>".$row['amount'].
        "</td></tr>";
        }
        ?>
        </tbody>
        </table>
        <a class="btn  btn-primary mbtn"href="view.php" style="margin-left:280px;">Make an other transaction</a>
    </body>
</html>