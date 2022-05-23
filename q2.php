<?php

echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Department Number</th><th>Department Name</th><th>Total of Employee Salary</th></tr>";

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
  $stmt = $conn->prepare("SELECT EMP.DEPTNO,DEPT.DNAME, SUM(EMP.SAL) total_amt FROM EMP INNER JOIN DEPT ON EMP.DEPTNO=DEPT.DEPTNO GROUP BY DEPTNO");
  $stmt->execute();

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









