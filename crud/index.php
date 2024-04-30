<?php
include "db_conn.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD</title>
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

    @media print {
        body * {
            visibility: hidden;
        }

        .print-container,
        .print-container * {
            visibility: visible;
        }

        .print-container {
            position: absolute;
            left: 0px;
            top: 0px;
        }
    }

    .maint {
        background-color: yellow;
        /* Your desired background color */
    }


    .maroon-header {
        background-color: maroon;
        color: white;
        /* Optional: Text color for better readability */
    }

    .yellow-body {
        background-color: yellow;
    }
    </style>

</head>

<body>
    <nav class="navbar style=" background-color: yellow;>
        <div class="container-fluid">
            <a class="navbar-brand"><img id="logo" src="./cgclogo.png" alt="" srcset="" /></a>
            <h1 id="title">CITI Global College</h1>
            <form class="d-flex" role="search" method="get">
                <input class="form-control me-2" name="search" value="<?php if (isset($_GET['search'])) {
                        echo $_GET['search'];}?>" type="search" placeholder="Search" aria-label="Search" />
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <div class="container">
        <?php 
if(isset($_GET['msg'])) {
            $msg = $_GET['msg'];
            echo ' 
        <div class="alert alert-warning alert-dismissible fade show" role="alert mt-5">
            ' . $msg . '           
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}

?>
        <div class=" text-center buttoncon container mt-3 mb-3">
            <a href="add.php" class="btn btn-dark mb-2 mt-2">Add New</a>
            <button class="btn btn-dark" onclick="window.print();">Print table</button>
        </div>

        <caption><b>List of students</b></caption>

        <table class="table table-striped align-middle table-hover text-center print-container maint">
            <thead class="maroon-header">
                <tr>
                    <th scope="col">Full Name</th>
                    <th scope="col">Student Number</th>
                    <th scope="col">Department</th>
                    <th scope="col">Year Level</th>
                    <th scope="col">Section</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="table-group-divider yellow-body">
                <?php
        $sql = "SELECT * FROM `students`";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)) {
        ?>

                <tr class="table-row">
                    <td class="full-name"><?php echo $row['full_name'] ?></td>
                    <td class="student-number"><?php echo $row['student_number'] ?></td>
                    <td class="department"><?php echo $row['department'] ?></td>
                    <td class="year-level"><?php echo $row['year_level'] ?></td>
                    <td class="section"><?php echo $row['section'] ?></td>
                    <th>
                        <a href="edit.php?id=<?php echo $row["id"]?>" class="link-dark"><i
                                class="fa-solid fa-pen fs-5 me-3"></i></a>
                        <a href="delete.php?id=<?php echo $row["id"]?>" class="link-dark"><i
                                class="fa-solid fa-trash fs-5 me-3"></i></a>
                        <a href="student_profile.php?id=<?php echo $row["id"]?>" class="link-dark"><i
                                class="fa-solid fa-list fs-5 me-3"></i></a>
                    </th>
                </tr>


                <?php   
}        
        ?>

            </tbody>
        </table>

        <div class="no-record-found alert alert-warning mt-3" style="display: none;">
            NO RECORD FOUND
        </div>
    </div>

    <!-------------------------------------------------------------------------------------------------------->
    <script src=" https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <!-------------------------------------------------------------------------------------------------------->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.querySelector('input[name="search"]');
        const tableRows = document.querySelectorAll(".table-row");
        const noRecordFoundMessage = document.querySelector(".no-record-found");

        searchInput.addEventListener("input", function() {
            const searchValue = this.value.toLowerCase().trim();
            let rowCount = 0;

            tableRows.forEach(function(row) {
                const fullName = row.querySelector('.full-name').textContent.toLowerCase();
                const studentNumber = row.querySelector('.student-number').textContent
                    .toLowerCase();
                const department = row.querySelector('.department').textContent.toLowerCase();
                const yearLevel = row.querySelector('.year-level').textContent.toLowerCase();
                const section = row.querySelector('.section').textContent.toLowerCase();

                if (fullName.includes(searchValue) ||
                    studentNumber.includes(searchValue) ||
                    department.includes(searchValue) ||
                    yearLevel.includes(searchValue) ||
                    section.includes(searchValue)) {
                    row.style.display = "";
                    rowCount++;
                } else {
                    row.style.display = "none";
                }
            });

            if (rowCount === 0) {
                noRecordFoundMessage.style.display = "block";
            } else {
                noRecordFoundMessage.style.display = "none";
            }
        });
    });
    </script>
</body>

</html>