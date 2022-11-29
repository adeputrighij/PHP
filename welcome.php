<html>
    <body>
        Welcome <?php echo $_POST["firstname"];?><br>
        Your Email Addres is: <?php echo $_POST["email"];

    $servername = "ec2-107-22-122-106.compute-1.amazonaws.com";
    $username = "zmseawatfuzhsu";
    $password = "281cc09e9877230af68606b1893e14b5e2eb9b5aa157b4f4d7dbd36502b414de";
    $port = 5432
    $dbname = "d1mldtufmnb1pt";
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    
    try {
      $conn = new PDO("pgsql:host=$servername;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "INSERT INTO mydb.myguest (firstname, lastname, email)
      VALUES ('John', 'Doe', 'john@example.com')";
      // use exec() because no results are returned
      $conn->exec($sql);
      echo "New record created successfully";
    } catch(PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }
        
    try {
      $conn = new PDO("pgsql:host=$servername;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // begin the transaction
      $conn->beginTransaction();
      // our SQL statements
      $conn->exec("INSERT INTO MyGuests (firstname, lastname, email)
      VALUES ('Ade', 'Putri', 'ade@gmail.com')");
    
      // commit the transaction
      $conn->commit();
      echo "New records created successfully";
    } catch(PDOException $e) {
      // roll back the transaction if something failed
      $conn->rollback();
      echo "Error: " . $e->getMessage();
    }
        
        
    echo "<table style='border: solid 1px black;'>";
    echo "<tr><th>Id</th><th>Firstname</th><th>Lastname</th></tr>";

    class TableRows extends RecursiveIteratorIterator {
      function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
      }

      function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
      }

      function beginChildren() {
        echo "<tr>";
      }

      function endChildren() {
        echo "</tr>" . "\n";
      }
    }

    try {
      $conn = new PDO("pgsql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT id, firstname, lastname FROM MyGuests");
      $stmt->execute();

      // set the resulting array to associative
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        echo $v;
      }
    } catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
    $conn = null;
    echo "</table>";
        
    //Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    //Check connection
    if ($conn->connect_error) {
        die("Connection failed:".$conn->connect_error);
    }
    
    $sql = "INSERT INTO myguest (firstname, lastname, email)
    VALUES ('$firstname', '$lastname', '$email')";
    
    if($conn->query($sql) === TRUE){
        echo "New records created succesfully";
    } else {
        echo "Error: ".$sql."<br>".$conn->error;
    }
    
    $conn = new mysqli ($servername, $username, $password, $dbname);
    $sql=  "SELECT id, firstname, lastname FROM myguest";
    $result=$conn->query($sql);
    if($result->num_rows>0){
        //output data of each row
        while($row=$result->fetch_assoc()) {
            echo "id:".$row["id"]."-Name:".$row["firstname"]."".$row["lastname"]."<br>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>
    <a href="http://localhost/tess.php">hapus</a>
    <a href="http://localhost/tambahdata.php">tambah</a>
    </body>
</html>
