<?php

echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Employee Number</th><th>Employee Name</th><th>Job Title</th><th>Date of Hire</th></tr>";

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
  $conn = new PDO("mysql:host=localhost;dbname=assignment 2", 'root', 1234) or die("NAW");

  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT EMPNO, ENAME, JOB, HIREDATE FROM EMP WHERE HIREDATE BETWEEN 1985-01-01 AND CURDATE() ORDER BY HIREDATE");

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
?>
