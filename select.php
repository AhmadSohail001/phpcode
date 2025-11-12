<?php
// اتصال به دیتابیس
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ahmad"; // نام دیتابیس خودت رو جایگزین کن

$conn = new mysqli($servername, $username, $password, $dbname);

// بررسی اتصال
if ($conn->connect_error) {
  die("ارتباط برقرار نشد: " . $conn->connect_error);
}

// انتخاب داده‌ها از جدول
$sql = "SELECT id, f_name, l_name, n_code, father_name, phone_n FROM tariq"; 
// users = نام جدولت. اگر فرق داره تغییر بده

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fa">
<head>
<meta charset="UTF-8">
<title>نمایش اطلاعات کاربران</title>
<style>
body {
  background-color: #b9d7e8;
  font-family: tahoma;
  direction: rtl;
  text-align: center;
  margin: 50px;
}
table {
  border-collapse: collapse;
  width: 80%;
  margin: auto;
  background: white;
}
th, td {
  border: 1px solid #333;
  padding: 8px;
}
th {
  background-color: #6996ae;
  color: white;
}
</style>
</head>
<body>

<h2>لیست کاربران ثبت‌شده</h2>

<?php
if ($result->num_rows > 0) {
  echo "<table><tr>
          <th>کد</th>
          <th>نام</th>
          <th>نام خانوادگی</th>
          <th>کد ملی</th>
          <th>نام پدر</th>
          <th>شماره تلفن</th>
        </tr>";

  while($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>" . $row["id"] . "</td>
            <td>" . $row["f_name"] . "</td>
            <td>" . $row["l_name"] . "</td>
            <td>" . $row["n_code"] . "</td>
            <td>" . $row["father_name"] . "</td>
            <td>" . $row["phone_n"] . "</td>
          </tr>";
  }
  echo "</table>";
} else {
  echo "هیچ داده‌ای پیدا نشد.";
}

$conn->close();
?>

</body>
</html>
