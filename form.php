<html long ="fa">
    <head>
        <meta charset="UTF-8">
        <style>
            body
            {
            background-color:#6996ae;
                font-family:tahoma;      
                direction: rtl;
                text-align: center;
                margin:150px;
            }
              .form
              {
                margin: 80px;

              }

</style>
</head>
<body>
<form class ="form" method="POST"> <br>

<lable> نام  </lable> <br>
<input type ="text" name="f_name" required> <br>
<sapn class="required"> </sapn><br>
            
<lable > نام خانوادگی</lable> <br>
<input type ="text" name="l_name" required> <br>
<sapn class="required"> </sapn><br>
            
<lable> کد ملی</lable> <br>
<input type ="text" name="n_code" id="n_code" required> <br>
<sapn class="required"> </sapn><br>
            
<lable> اسم پدر</lable> <br>
<input type ="text" name="father_name" required> <br>
<sapn class="required"> </sapn><br>

<lable> شماره تلفن  </lable> <br>
<input type ="text" name="phone_n" required> <br>
<sapn class="required"> </sapn><br>
      
<input type="submit"> <br>
</form>
</body>
</head>
<?php
include 'insert.php';
?>
