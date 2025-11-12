
<?php
include 'connect.php';
$x=$_POST["f_name"];
$y=$_POST["l_name"];
$s=$_POST["n_code"];
$h=$_POST["father_name"];
$f=$_POST["phone_n"];

$servername="localhost";
$username="root";
$password="";
$database="ahmad";
$conn= connect("localhost","root","","ahmad");
function ql($x , $y , $s , $h , $f, $conn)
{
 $q="INSERT INTO tariq (f_name, l_name, n_code, father_name, phone_n)
 VALUES ('$x' , '$y' , '$s' , '$h' , '$f')";
 mysqli_query($conn,$q);
}
 ql($x, $y, $s , $h, $f,$conn);
?>
