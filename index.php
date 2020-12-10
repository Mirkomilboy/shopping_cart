<?php
    session_start();

    require_once('./inc/createDB.php');
    require_once('./inc/component.php');

    // creating instance of createDB class
    $database = new createDB("Productdb", "Producttb");

    if(isset($_POST['add'])){
        if(isset($_SESSION['cart'])) {
            $item_array_id = array_column($_SESSION['cart'], "product_id");

            if(in_array($_POST['product_id'], $item_array_id)) {
                echo "<script>alert('Product is already added in the cart!')</script>";
                echo "<script>window.location = 'index.php'</script>";
            } else {
                $count = count($_SESSION['cart']);
                $item_array = array(
                    'product_id'=>$_POST['product_id']
                );
                $_SESSION['cart'][$count] = $item_array;
            }
        } else {
            $item_array = array(
                'product_id'=>$_POST['product_id']
            );
            // Create new session variable
            $_SESSION['cart'][0]=$item_array;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php require_once("inc/header.php"); ?>
    <div class="container">
        <div class="row text-center py-5">
            <?php
                $result = $database->getData();
                while($row = mysqli_fetch_assoc($result)) {
                    component($row['product_name'], $row['product_name'], $row['product_image'], $row['id']);
                }
            ?>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>