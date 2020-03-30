<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>FOUNDA</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/tachyons@4.10.0/css/tachyons.min.css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<body>

<?php include 'header.php'; ?>

    <div align="center" class="row-center">
    <div class="container col-6 mb6">
        <button  type="button" style="color: white;" class="btn-lg peach-gradient br-pill mt4 m3 p4 fl w-100 grow"  data-toggle="modal" data-target="#myModal">Report Lost Item</button>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <form class="modal-dialog modal-lg" role="form" method="post" action="lost.php">
          <div class="modal-content">
            <div class="modal-header text-center">
              <h4 class="modal-title w-100 text-align-left orange-text">Lost Item Form...</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body mx-3">
              <div class="md-form mb-5">
                <i class="fas prefix grey-text"></i>
                <input type="text" id="form34" name = "name" class="form-control validate" placeholder="What's your name?">
              </div>
      
              <div class="md-form mb-5">
                <i class="fas prefix grey-text"></i>
                <input type="email" id="form29" name = "email" class="form-control validate" placeholder="What's your email?">
              </div>
      
              <div class="md-form">
                <i class="fas prefix grey-text"></i>
                <textarea type="text" id="form8" name = "description" class="md-textarea form-control" placeholder="Describe The Item...(Things like the Item type, Color, Where you found it, etc. Be detailed but don't give any personal information that could be used to identify it.)" rows="4"></textarea>
              </div>

              <div class="md-form">
                <i class="fas prefix grey-text"></i>
                <input type="text" id="form8" name = "reward" class="md-textarea form-control" placeholder="What do you want to give as a Reward?...(If you don't want to give anything you can simply write 'Nothing')"></input>
              </div>
            
            </div>
            <div class="modal-footer d-flex justify-content-center">
              <input class="btn peach-gradient br-pill" type = "submit" value = "Send" name = "lost"></input>
            </div>
          </div>
</form>
      </div>
    </div>
    
    

    </divalign="center">
    <br>
    <div class="center orange-text" style="font-weight: bolder;">
        <h3>See What Our Users Have Found</h3>
    </div>
    <div class="container">     
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Description</th>
              <th>Contact</th>
            </tr>
          </thead>
          <?php
        include("database/db_conection.php");
        $view_users_query="select * from items where Type = 'Found'";//select query for viewing users.
        $run=mysqli_query($dbcon,$view_users_query);//here run the sql query.

        while($row=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.
        {
            $Description=$row[2];
            $Email=$row[1];
        ?>
        
        <tr>
<!--here showing results in the table -->
            <td><?php echo $Description;?></td>
            <td><?php echo $Email;?></td>
        </tr>

        <?php } ?>
        </table>
      </div>
      <?php include 'footer.php'; ?>
</body>

</html>

<?php

include("database/db_conection.php");
if(isset($_POST['lost']))
{
    $Founder=$_POST['name']; 
    $ID=$_POST['email'];
    $Description=$_POST['description'];
    $Reward=$_POST['reward'];


    if($Founder=='')
    {
        //javascript use for input checking
        echo"<script>alert('Please enter the name')</script>";
    exit();//this use if first is not work then other will not show
    }

    if($ID=='')
    {
        echo"<script>alert('Please enter the Email')</script>";
    exit();
    }

    if($Description=='')
    {
        echo"<script>alert('Please enter the Description')</script>";
    exit();
    }

//insert the user into the database.
    $insert_user="insert into items (Founder,Email,Description,Type,Reward) VALUE ('$Founder','$ID','$Description','Lost','$Reward')";
    if(mysqli_query($dbcon,$insert_user))
    {
        echo"<script>window.open('lost.php','_self')</script>";
    }

}

?>