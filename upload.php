<?php include "config/config.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>image Upload</title>
</head>
<body>
<?php 
if(isset($_POST['btnSubmit'])){echo -1;
    
    // $category = $_POST ['category'];
    $fileName = $_POST ['image'];
    $short_d = $_POST ['short_d'];
    $mrp = $_POST ['mrp'];
    // if(!empty($_POST['image'])){ echo 0;
        try{
        $statusMsg=""; echo 1;
            $tar_dir = "images/product-details/"; echo 2;
            $fileName = basename($_FILES['image']['name']); echo 3;
            $targetFilePath = $tar_dir. $fileName; echo 4;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); echo 5;
            if(!empty($_FILES['image']['name'])){ echo 6;
                $allowedTypes = array('jpg', 'png', 'jpeg', 'PNG'); echo 7;
                if(in_array($fileType, $allowedTypes)){ echo 8;
                    if(move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)){ echo 9;
                        $sqlImage = mysqli_query($conn,"INSERT INTO product_details( image, mrp, short_d) VALUES ('$fileName','$mrp','$short_d')"); echo 10;
                        if($sqlImage){ echo 11;
                            $statusMsg = "File ".$fileName." is successfully uuploaded";  
                        }else{ echo 12;
                            $statusMsg = "File".$fileName." Could not be inserted"; echo 13;
                        }
                    }else{ echo 14;
                    $statusMsg = "There was an error, try again.";}
                }else{ echo 15;
                    $statusMsg = "Only the file types png jpg and jpeg ae allowed.";
                }
            }
        }catch(Exception $e){ echo "error".$e->getMessage(); }
        // } else{ echo "<script>alert('Please select a file to Upload');</script>"; }
        echo "<script>alert('Upload, successful'); 
        window.location.href='upload.php'</script>";
    }
?>
<form action="" method="post" enctype="multipart/form-data">
    <label> Image</label>
    <input type="file" name="image">
        <br>
        <label> Description</label>
    <input type="text" name="short_d">
        <br>
        <label> MRP</label>
        <input type="text" name="mrp">
        <br>
    <input type="submit" name="btnSubmit" value="Upload Data">
    </form>
</body>
</html>