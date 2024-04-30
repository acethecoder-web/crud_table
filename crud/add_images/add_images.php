<?php
include('db_conn.php');

if(isset($_POST['upload'])) {
    $tile_name = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $folder = 'images/' . $tile_name;

    if(move_uploaded_file($tempname, $folder)) {
        $query = mysqli_query($conn, "INSERT INTO images (file) values ('$tile_name')");
        if($query) {
            // File uploaded successfully, no need to reload the page
            echo "<script>updateImage();</script>";
        } else {
            echo "<script>alert('File upload unsuccessful');</script>";
        }
    } else {
        echo "<script>alert('File upload unsuccessful');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD IMAGES</title>
    <script>
    function updateImage() {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    document.getElementById('uploadedImage').src = xhr.responseText;
                } else {
                    console.error('Error: ' + xhr.status);
                }
            }
        };
        xhr.open('GET', 'get_latest_image.php', true);
        xhr.send();
    }
    </script>
</head>

<body>

    <div class="container maincon mb-5 ">
        <form method="post" enctype="multipart/form-data" action="" onsubmit="event.preventDefault(); updateImage();">
            <input type="file" id="imageInput" name="image">
            <button type="submit" name="upload">SUBMIT</button>
        </form>
    </div>

    <div>
        <?php
        // Fetch the latest image from the database
        $res = mysqli_query($conn, "SELECT * FROM images ORDER BY id DESC LIMIT 1");
        $row = mysqli_fetch_assoc($res);
        $imageSrc = isset($row['file']) ? 'images/' . $row['file'] : 'images/placeholder.jpg';
        ?>
        <img id="uploadedImage" src="<?php echo $imageSrc; ?>" alt="">
    </div>

</body>

</html>