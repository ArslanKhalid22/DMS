<!DOCTYPE html>



<html>
<head>
    <title>Google Maps Draw Polygon Get Coordinates</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>

</head>

<body >
<h2>Google Maps Draw Polygon Get Coordinates</h2>
<div id="map-canvas" style="height: 400px; width: 700px"></div>
<h4>Updated Coordinates (X,Y)</h4>
<div id="info" style="position:absolute; color:red; font-family: Arial; height:200px; font-size: 12px;"></div>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDf6UJtqIUabhRfEVpl5kbV8npQTMGKGdI&libraries=drawing"></script>
<script src="drawMap.js"></script>

</body>
</html>

<button onclick="swal()" class="btn btn-primary"></button>
<script>
    function swal() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'success',
            title: 'Signed in successfully'
        })
    }

</script>
<!--<html>-->
<!---->
<!--<head>-->
<!--    <title>test page</title>-->
<!--    <link rel="stylesheet" href=-->
<!--    "https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"-->
<!--          integrity=-->
<!--          "sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"-->
<!--          crossorigin="anonymous">-->
<!---->
<!--    <script src=-->
<!--            "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">-->
<!--    </script>-->
<!--    <script src=-->
<!--            "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js">-->
<!--    </script>-->
<!--    <script src=-->
<!--            "https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js">-->
<!--    </script>-->
<!---->
<!--    <script>-->
<!--        $(document).ready(function () {-->
<!---->
<!--            // Denotes total number of rows-->
<!--            var rowIdx = 0;-->
<!---->
<!--            // jQuery button click event to add a row-->
<!--            $('#addBtn').on('click', function () {-->
<!---->
<!--                // Adding a row inside the tbody.-->
<!--                $('#tbody').append(`<tr id="R${++rowIdx}">-->
<!--             <td class="row-index text-center">-->
<!--             <p>Row ${rowIdx}</p>-->
<!--             </td>-->
<!--              <td class="text-center">-->
<!--                <button class="btn btn-danger remove"-->
<!--                  type="button">Remove</button>-->
<!--                </td>-->
<!--              </tr>`);-->
<!--            });-->
<!---->
<!--            // jQuery button click event to remove a row.-->
<!--            $('#tbody').on('click', '.remove', function () {-->
<!---->
<!--                // Getting all the rows next to the row-->
<!--                // containing the clicked button-->
<!--                var child = $(this).closest('tr').nextAll();-->
<!---->
<!--                // Iterating across all the rows-->
<!--                // obtained to change the index-->
<!--                child.each(function () {-->
<!---->
<!--                    // Getting <tr> id.-->
<!--                    var id = $(this).attr('id');-->
<!---->
<!--                    // Getting the <p> inside the .row-index class.-->
<!--                    var idx = $(this).children('.row-index').children('p');-->
<!---->
<!--                    // Gets the row number from <tr> id.-->
<!--                    var dig = parseInt(id.substring(1));-->
<!---->
<!--                    // Modifying row index.-->
<!--                    idx.html(`Row ${dig - 1}`);-->
<!---->
<!--                    // Modifying row id.-->
<!--                    $(this).attr('id', `R${dig - 1}`);-->
<!--                });-->
<!---->
<!--                // Removing the current row.-->
<!--                $(this).closest('tr').remove();-->
<!---->
<!--                // Decreasing total number of rows by 1.-->
<!--                rowIdx--;-->
<!--            });-->
<!--        });-->
<!--    </script>-->
<!--</head>-->
<!---->
<!--<body>-->
<!--<div class="container pt-4">-->
<!--    <div class="table-responsive">-->
<!--        <table class="table table-bordered">-->
<!--            <thead>-->
<!--            <tr>-->
<!--                <th class="text-center">Row Number</th>-->
<!--                <th class="text-center">Remove Row</th>-->
<!--            </tr>-->
<!--            </thead>-->
<!--            <tbody id="tbody">-->
<!---->
<!--            </tbody>-->
<!--        </table>-->
<!--    </div>-->
<!--    <button class="btn btn-md btn-primary"-->
<!--            id="addBtn" type="button">-->
<!--        Add new Row-->
<!--    </button>-->
<!--</div>-->
<!--</body>-->
<!---->
<!--</html>-->
<!--<form method="POST" action="" onsubmit="return submitForm(this);">-->
<!--    <input type="text" name="name" />-->
<!--    <input type="submit" />-->
<!--</form>-->
<!--<script>-->
<!--    function submitForm(form) {-->
<!--        swal.fire({-->
<!--            title: "Are you sure?",-->
<!--            text: "This form will be submitted",-->
<!--            icon: "warning",-->
<!--            buttons: true,-->
<!--            dangerMode: true,-->
<!--        })-->
<!--            .then(function (isOkay) {-->
<!--                if (isOkay) {-->
<!--                    window.location.href="index.php";-->
<!--                }-->
<!--            });-->
<!--        return false;-->
<!--    }-->
<!--</script>-->
<?php

?>
<!--<!DOCTYPE html>-->
<!--<html>-->
<!--<head>-->
<!--    <title>Registration Form</title>-->
<!--</head>-->
<!--<body>-->
<!--<script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>-->
<!--<script type="text/javascript">-->
<!---->
<!--    $(document).ready(function (e){-->
<!--        $("#uploadForm").on('submit',(function(e){ e.preventDefault();-->
<!--            var data=new FormData(this);-->
<!--            var u_code=13;-->
<!--            data.append('u_code',u_code);-->
<!--            $.ajax({-->
<!--                url: "upload.php",-->
<!--                type: "POST",-->
<!--                data: data,-->
<!--                contentType: false, cache: false, processData:false,-->
<!--                success: function(data){-->
<!--                    alert("data inserted successfully");-->
<!--                },-->
<!--                error: function(){}-->
<!--            });-->
<!--        }));-->
<!--    });-->
<!--</script>-->
<!--<form enctype="multipart/form-data" id="uploadForm" action="add.php" method="post">-->
<!--    <table>-->
<!---->
<!--            <th>Upload Photo</th>-->
<!--            <td> <input type="file" id="img" name="img"> </td>-->
<!--        </tr>-->
<!--        <tr> <td><input type="submit" onclick="data()" value="submit"></td> </tr>-->
<!--    </table>-->
<!--</form>-->
<!--        <div id="display-image">-->
<!--            --><?php
//            $query = " select * from users  ";
//            $result = mysqli_query($conn, $query);
//
//            while ($data = mysqli_fetch_assoc($result)) {
//                ?>
<!--                <img src="./image/--><?php //echo $data['file_name']; ?><!--">-->
<!---->
<!--                --><?php
//            }
//            ?>
<!--        </div>-->
<!--</body>-->
<!--</html>-->

<?php
//error_reporting(0);
//include ('connect/connect.php');
//$msg = "";
//
//// If upload button is clicked ...
//if (isset($_FILES['uploadfile'])===true){
//    if(empty($_FILES['uploadfile']['name']===true))
//    {
//       echo "bye";
//    }
//    else{
//        echo "ok";
//    }
//die();
//    $filename = $_FILES["uploadfile"]["name"];
//    echo $filename;
//    $tempname = $_FILES["uploadfile"]["tmp_name"];
//    $folder = "./image/" . $filename;
//
//    echo "hello";
//    // Get all the submitted data from the form
//    $sql = "Update  users set file_name= '$filename' where id=13";
//    echo $sql;
//echo "hello";
//    // Execute query
//    $result=mysqli_query($conn, $sql);
//
//    // Now let's move the uploaded image into the folder: image
//    if (move_uploaded_file($tempname, $folder)) {
//        echo "<h3> Image uploaded successfully!</h3>";
//    } else {
//        echo "<h3> Failed to upload image!</h3>";
//    }
//}
//?>
<!---->
<!--<!DOCTYPE html>-->
<!--<html>-->
<!---->
<!--<head>-->
<!--    <title>Image Upload</title>-->
<!--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">-->
<!--    <link rel="stylesheet" type="text/css" href="style.css" />-->
<!--</head>-->
<!---->
<!--<body>-->
<!--<div id="content">-->
<!--    <form method="POST" action="" enctype="multipart/form-data">-->
<!--        <div class="form-group">-->
<!--            <input class="form-control" type="file" name="uploadfile" value="" />-->
<!--        </div>-->
<!--        <div class="form-group">-->
<!--            <button class="btn btn-primary" type="submit" name="upload">UPLOAD</button>-->
<!--        </div>-->
<!--    </form>-->
<!--</div>-->
<!--<div id="display-image">-->
<!--    --><?php
//    $query = " select * from users ";
//    $result = mysqli_query($conn, $query);
//
//    while ($data = mysqli_fetch_assoc($result)) {
//        ?>
<!--        <img src="./image/--><?php //echo $data['file_name']; ?><!--">-->
<!---->
<!--        --><?php
//    }
//    ?>
<!--</div>-->
<!--</body>-->
<!---->
<!--</html>-->
<!---->
<!---->




<?php
//include ('connect/connect.php');
//
//
//
//$plaintext_password = "123";
//
//// The hash of the password that
//// can be stored in the database
//$hash = password_hash($plaintext_password,
//    PASSWORD_DEFAULT);
//
//// Print the generated hash
//echo "Generated hash: ".$hash;
//DIE();
//$plaintext_password = "Password@123";
//
//// The hashed password retrieved from database
//$hash =
//    "$2y$10$8sA2N5Sx/1zMQv2yrTDAaOFlbGWECrrgB68axL.hBb78NhQdyAqWm";
//
//// Verify the hash against the password entered
//$verify = password_verify($plaintext_password, $hash);
//
//// Print the result depending if they match
//if ($verify) {
//    echo 'Password Verified!';
//} else {
//    echo 'Incorrect Password!';
//}



?>
<!--<button  onclick="swal()" class="btn btn-success"></button>-->
<!--<script>-->
<!--    function swal()-->
<!--    {-->
<!--        Swal.fire({-->
<!--            title: 'Do you want to submit the changes?',-->
<!--            showDenyButton: true,  showCancelButton: false,-->
<!--            confirmButtonText: `Save`,-->
<!--            denyButtonText: `Don't save`,-->
<!--        }).then((result) => {-->
<!--            /* Read more about isConfirmed, isDenied below */-->
<!--            if (result.isConfirmed) {-->
<!--                Swal.fire('Saved!', '', 'success')-->
<!--            } else if (result.isDenied) {-->
<!--                Swal.fire('Changes are not saved', '', 'info')-->
<!--            }-->
<!--        });-->
<!---->
<!--    }-->
<!--</script>-->

<?php
//include ('connect/connect.php');
//$query = "SELECT * FROM primaryorders ORDER BY po_code DESC LIMIT 1 ";
//echo $query;
//$result = mysqli_query($conn, $query);
//$row=mysqli_fetch_array($result);
//if(!$row)
//{
//$po_code="PO1";
//$po_code=str_split($po_code,2);
//$po_code= $po_code[1];
//
//}
//else{
//$po_code="PO1";
//echo $po_code;
//}
//?>



<!--<!doctype html>-->
<!--<html lang = "en">-->
<!--<head>-->
<!--    <meta charset = "utf-8">-->
<!--    <title>jQuery UI Autocomplete functionality</title>-->
<!--    <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"-->
<!--          rel = "stylesheet">-->
<!--    <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>-->
<!--    <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>-->
<!---->
<!--    <!-- Javascript -->
<!--    <script>-->
<!--        $(function() {-->
<!--            var availableTutorials  =  [-->
<!--                "ActionScript",-->
<!--                "Bootstrap",-->
<!--                "C",-->
<!--                "C++",-->
<!--            ];-->
<!--            $( "#automplete-1" ).autocomplete({-->
<!--                source: availableTutorials-->
<!--            });-->
<!--        });-->
<!--    </script>-->
<!--</head>-->
<!---->
<!--<body>-->
<!--<!-- HTML -->
<!--<div class = "ui-widget">-->
<!--    <p>Type "a" or "s"</p>-->
<!--    <label for = "automplete-1">Tags: </label>-->
<!--    <input id = "automplete-1">-->
<!--</div>-->
<!--</body>-->
<!--</html>-->

<!--    $('#table1').DataTable({-->
<!--        "pageLength": 3-->
<!--    });-->
<!--</script>-->
<!--<table id="table1">-->
<!--    <thead>-->
<!--    <tr>-->
<!--        <th>Name</th>-->
<!--        <th>Age</th>-->
<!--        <th>Sex</th>-->
<!--        <th>Occupation</th>-->
<!--    </tr>-->
<!--    </thead>-->
<!--    <tbody>-->
<!--    <tr>-->
<!--        <td>Ram</td>-->
<!--        <td>21</td>-->
<!--        <td>Male</td>-->
<!--        <td>Doctor</td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td>Mohan</td>-->
<!--        <td>32</td>-->
<!--        <td>Male</td>-->
<!--        <td>Teacher</td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td>Rani</td>-->
<!--        <td>42</td>-->
<!--        <td>Female</td>-->
<!--        <td>Nurse</td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td>Johan</td>-->
<!--        <td>23</td>-->
<!--        <td>Female</td>-->
<!--        <td>Software Engineer</td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td>Shajia</td>-->
<!--        <td>39</td>-->
<!--        <td>Female</td>-->
<!--        <td>Farmer</td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td>Jack</td>-->
<!--        <td>19</td>-->
<!--        <td>Male</td>-->
<!--        <td>Student</td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td>Hina</td>-->
<!--        <td>30</td>-->
<!--        <td>Female</td>-->
<!--        <td>Artist</td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td>Gauhar</td>-->
<!--        <td>36</td>-->
<!--        <td>Female</td>-->
<!--        <td>Artist</td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td>Jacky</td>-->
<!--        <td>55</td>-->
<!--        <td>Female</td>-->
<!--        <td>Bank Manager</td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td>Pintu</td>-->
<!--        <td>36</td>-->
<!--        <td>Male</td>-->
<!--        <td>Clerk</td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td>Sumit</td>-->
<!--        <td>33</td>-->
<!--        <td>Male</td>-->
<!--        <td>Footballer</td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td>Radhu</td>-->
<!--        <td>40</td>-->
<!--        <td>Female</td>-->
<!--        <td>Coder</td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td>Mamta</td>-->
<!--        <td>49</td>-->
<!--        <td>Female</td>-->
<!--        <td>Student</td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td>Priya</td>-->
<!--        <td>36</td>-->
<!--        <td>Female</td>-->
<!--        <td>Worker</td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td>Johnny</td>-->
<!--        <td>41</td>-->
<!--        <td>Male</td>-->
<!--        <td>Forest Officer</td>-->
<!--    </tr>-->
<!--    </tbody>-->
<!--</table>-->
