<?php 
include "db_conn.php";
$id = $_GET["id"];


if(isset($_POST['submit'])) {
        $fullname =  $_POST['full_name'];
        $studnum =  $_POST['student_number'];
        $department =  $_POST['department'];
        $yearlevel =  $_POST['year_level'];
        $section =  $_POST['section'];

    $sql = "UPDATE `students` SET `full_name`='$fullname',`student_number`='$studnum',`department`='$department',`year_level`='$yearlevel',`section`='$section' WHERE id = $id";
   
   
    $result = mysqli_query($conn, $sql);

if($result) {
    header("Location: index.php?msg= Data updated successfully");
}
else{
    echo "Failed: " . mysqli_error($conn);
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="./cssfiles/index.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
    @font-face {
        font-family: eastman;
        src: url(./EastmanRomanTrial-Extrabold.otf);
    }



    .navbar {
        background-color: yellow;
    }

    #logo {
        width: 50px;
    }

    #title {
        color: maroon;
        font-family: eastman;
        position: absolute;
        left: 70px;
        top: 20px;
    }

    .mh {
        font-family: eastman;
        margin-top: 50px;
        color: yellow;
        background-color: maroon;
        padding: 20px;
        border-radius: 10px;
    }

    .mc {
        background-color: yellow;
        border-radius: 10px;
    }


    .sh {
        font-weight: bold;
    }

    label {
        font-weight: bold;
    }

    .buttons {
        padding: 20px;
    }
    </style>

</head>

<body>
    <nav class="navbar style=" background-color: yellow;>
        <div class="container-fluid">
            <a class="navbar-brand"><img id="logo" src="./cgclogo.png" alt="" srcset="" /></a>
            <h1 id="title">CITI Global College</h1>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <div class="container mc">
        <div class="text-center mb-4">
            <h3 class="mh">EDIT STUDENT INFORMATION</h3>
            <p class="text-muted sh"> Click update when the needed information are updated </p>
        </div>

        <?php
        
        $sql = "SELECT * FROM `students` WHERE id = '$id' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        ?>


        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width-50vh; min-width:300px;">
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Full Name:</label>
                        <input type="text" class="form-control" name="full_name" value="<?php echo $row['full_name']?>">
                    </div>

                    <div class="col mb-3">
                        <label class="form-label">Student Number:</label>
                        <input type="text" class="form-control" name="student_number"
                            value="<?php echo $row['student_number']?>">
                    </div>

                    <div class="col">
                        <label class="form-label">Department:</label>
                        <input type="text" class="form-control" name="department"
                            value="<?php echo $row['department']?>">
                    </div>
                    <div class="container">

                        <div class="col mb-3">
                            <label class="form-label">Year Level:</label>
                            <input type="text" class="form-control" name="year_level"
                                value="<?php echo $row['year_level']?>"">
                        </div>

                        <div class=" col">
                            <label class="form-label">Section:</label>
                            <input type="text" class="form-control" name="section" value="<?php echo $row['section']?>">
                        </div>
                    </div>
                </div>

                <div class="form-group container d-flex justify-content-center buttons">
                    <button type="submit" class="btn btn-success me-3" name="submit">UPDATE</button>
                    <a href="index.php" class="btn btn-danger">BACK</a>
                </div>

            </form>
        </div>
    </div>


    <!-------------------------------------------------------------------------------------------------------->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
</body>

</html>