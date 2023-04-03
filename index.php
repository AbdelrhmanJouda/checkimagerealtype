<?PHP 
$error=[];
if(isset( $_POST['submit'])){
    $file =$_FILES['image'];
    if($file['name'] != ''){
                                        //image info to validate
        $fname = $file['name'];
        $ftmp = $file['tmp_name'];
        $fsize = $file['size'];
        $ferror = $file['error'];
        $ftype = $file['type'];
        // extension
        $fextension = pathinfo($fname,PATHINFO_EXTENSION);
                // all this data can be changed like the type and extension which will accept a fake type
               // but all we need to check the real type of file is useing this function
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $Type = finfo_file($finfo,$file['tmp_name'] );
        finfo_close($finfo);
        if($Type === "image/gif" || $Type === "image/png" || $Type === "image/jpeg" || $Type === "image/JPEG" || $Type === "image/PNG" || $Type === "image/GIF"){
            $_SESSION['success'] = ["Great the real type of this file is $Type not fake <br> file type = $Type"];
        }else{
            $error[]="This file type is not image, the real type of this file is : $Type";
        }

    }else{
    $error[] = 'slect image';
    }
    if(!empty($error)){
        $_SESSION['errors']=$error;
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  </head>
  <body>
    <h1>check image</h1>
<div class="container">
    <div class="row">
        <div class="col">  
                            <?php if(isset($_SESSION['errors'])):foreach($_SESSION['errors'] as $error): ?>
                                <div class="alert alert-danger">
                                    <?= $error ?>
                                </div>
                                <?php endforeach; endif; unset($_SESSION['errors']); ?>
                            <?php if(isset($_SESSION['success'])):foreach($_SESSION['success'] as $success): ?>
                                <div class="alert alert-success">
                                    <?= $success ?>
                                </div>
                                <?php endforeach; endif; unset($_SESSION['success']); ?>
            <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
  <div class="mb-3">
    <label  class="form-label">Image</label>
    <input type="file" name="image" class="form-control">
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
  </body>
</html>