<?php
require_once 'pdoconfig.php';

try {
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
echo "Connected to $dbname at $host successfully.<hr><br>";

if(isset($_REQUEST['submit'])){
  if(($_REQUEST['name'] == "") || ($_REQUEST['email'] == "") || ($_REQUEST['address'] == "")){
    echo "<small>fill all fields</small><hr>";
  }else{
$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$address = $_REQUEST['address'];
$sql = "INSERT INTO detail (name,email, address) VALUES ('$name', '$email', '$address')";
$conn->exec($sql);

  }
}


} catch (PDOException $pe) {
die ("Could not connect to the database $dbname :" . $pe->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDO example</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<script>
  function fun(){
    alert("Details Successfully record in database.");
  }

</script>
</head>
<body>
<div class="container">
    <div class="row">
      <div class="col-md-12">
      <form action="" method="post">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name">
        </div>
          <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email address">
          </div>
          <div class="form-group">
          <label for="address">Address</label>
          <input type="text" name="address" id="address" class="form-control" placeholder="Enter your address">
          </div>
          <button type="submit" class="btn btn-primary" name="submit" onclick = "fun()">Submit</button>
      </form>
      
      </div>
    </div>
  </div>
<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Address</th>
    </tr>
  </thead>
  <tbody>
  <?php
                        include_once('pdoconfig.php');
                        $a=1;
                        $stmt = $conn->prepare(
                                "SELECT * FROM detail");
                        $stmt->execute();
                        $users = $stmt->fetchAll();
                        foreach($users as $user)
                        {
                    ?>
                    <tr>
                        <td>
                            <?php echo $user['id']; ?>
                        </td>
                        <td>
                            <?php echo $user['name']; ?>
                        </td>
                        <td>
                            <?php echo $user['email']; ?>
                        </td>
                        <td>
                            <?php echo $user['address']; ?>
                        </td>

                        <?php } ?>
    <!-- <tr>
      <th scope="row"></th>
      <td><?php echo "$name"; ?></td>
      <td><?php echo "$email"; ?></td>
      <td><?php echo "$address"; ?></td>
    </tr> -->
   
  </tbody>
</table>
</body>
</html>


