<?php
session_start();
$id= $_GET['id'];
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'customers');
/* Attempt to connect to MySQL database */
$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
$ss='select * from customer where id='.$id;
$resultt = mysqli_query($con,$ss);
$roww=mysqli_fetch_array($resultt);
$t='select * from customer where id!='.$id;
$res=mysqli_query($con,$t);
$_SESSION['nam']=$roww['name'];
$_SESSION['id']=$id;
?>
<html>

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheets" href="styles.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="icon" href="favicon (3).ico">

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
    </head>
<style>

  button.mbtn {
    padding:0.6em 2em;
    border-radius: 25px;
    width: 6cm;
    height: 1.5cm;;
    color:white;
    background-color:#009879;
    font-size:1.1em;
    border:0;
    cursor:pointer;
    margin:1em;
  }
  button.mbtn:hover{
      color: black;
  }
  button.mbtn.green
  {
      background-color:#ff7b54;
  }
  a.mbtn {
    
    border-radius: 25px;
    width: 8cm;
    height: 1.5cm;;
    color:white;
    background-color:#009879;
    font-size:1.1em;
    border:0;
    cursor:pointer;
    margin:1em;
  }
</style>
     <body
     style="background-color:#cfdac8;">
     <nav class="navbar navbar-expand-sm bg-dark navbar-dark ">
            <a class="navbar-brand" href="#" style="padding-left: 30px;;">
                Spark Bank
            </a>
            <ul class="navbar-nav" style="padding-left: 700px;">
              <li class="nav-item">
                <a class="nav-link" href="index.html">HOME</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#transfer">Transfer amount</a>
              </li>
            </ul>
        </nav>
        <div class="w3-content" style="max-width:1100px">
    <table >
    <tr>
      <td>
    <div class="w3-row w3-padding-64" id="profile">
    <div class="w3-col m6 w3-padding-large">
     <div class="card text-center" style="width: 18rem;">
        <img class="card-img-top" src="profile1.png" alt="Card image cap">      
     </div>
    </div>
   </div>
</td>
<td>
  <div style="padding-left:250px;font-size:30px;font-family: 'Abel', sans-serif;font-weight: bold;">
<h4><b>Name </b><span></span>: <?php echo $roww['name']?></h4></br>
       <h4><b>Email</b> <span></span>: <?php echo $roww['email']?></h4></br>
       <h4><b>Available balance</b><span></span> : <?php echo $roww['currentbalance']?></h4></br>
       <a href="#transfer" class="btn btn-primary  mbtn">Transfer money</a>
</div>
</td>
</tr>
        </table>

  
  <hr>
  
  <!-- Menu Section -->
  <div class="w3-row w3-padding-64" id="transfer">
  
  <div class="card" style="width: 30rem; height: 30rem; position: relative;background-color:black;margin-left:250px;">
        <div class="card-body" style="color:#009879">
        <form action="transfer.php" method="POST">
  </br> <b>Sender :</b> <?php echo  $roww['name'];?>
  <div><b>Balance :</b> <?php echo  $roww['currentbalance'];?></br></div></br></br>
        <b> Receiver's name :</b>
  <input class="form-control" list="datalistOptions" id="exampleDataList" name="receiver" placeholder="Receiver's name" style="width:200px;">
  </br><datalist id="datalistOptions">
    <?php 
    while($r=mysqli_fetch_array($res))
    {
        echo "<option value=".$r['name'].">";
    }
    ?>
  </datalist></br></br>
         <b>Enter the amount to be transferred : </b><input type="number" name="amount"/></br></br>
         <button type="submit" class="btn btn-lg btn-primary mbtn" name="submit"style="margin-top:50px;">Send</button>
         </form>
        </div>
      </div>
</div>
     </body>
    </html>