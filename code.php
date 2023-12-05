<?php

include('security.php');

// INSERT REGISTER
if (isset($_POST['registerbtn'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirmpassword'];
    $UserType = $_POST['usertype'];


    if ($password === $confirm_password) {
        $query = "INSERT INTO `register` (username,email,password,usertype) VALUES ('$username','$email','$password','$UserType')";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            echo "done";
            $_SESSION['success'] = "Admin is Added Successfully";
            header('Location: register.php');
        } else {
            echo "not done";
            $_SESSION['status'] = "Admin is Not Added";
            header('Location: register.php');
        }
    } else {
        echo "pass no match";
        $_SESSION['status'] = "Password and Confirm Password Does not Match";
        header('Location: register.php');
    }

}



// EDIT REGISTER


if (isset($_POST['edit_btn'])) {
    $id = $_POST['edit_id'];

    $query = "SELECT * FROM register WHERE id = '$id'";
    $query_result = mysqli_query($connection, $query);
}





if (isset($_POST['updatebtn'])) {
    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $email = $_POST['edit_email'];
    $password = $_POST['edit_password'];
    $updateusertype = $_POST['update_usertype'];


    $query = "UPDATE register SET username='$username', email='$email', password='$password', usertype='$updateusertype' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION['status_code'] = "success";
        header('Location: register.php');
    } else {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] = "error";
        header('Location: register.php');
    }
}

// DELETE REGISTER
if (isset($_POST['delete_btn'])) {
    $id = $_POST['delete_id'];

    $query = "DELETE FROM register WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['status'] = "Your Data is Deleted";
        $_SESSION['status_code'] = "success";
        header('Location: register.php');
    } else {
        $_SESSION['status'] = "Your Data is NOT DELETED";
        $_SESSION['status_code'] = "error";
        header('Location: register.php');
    }
}

// LOGIN REGISTER
if (isset($_POST['login_btn'])) {
    $email_login = $_POST['emaill'];
    $password_login = $_POST['passwordd'];

    $query = "SELECT * FROM register WHERE email='$email_login' AND password='$password_login' LIMIT 1";
    $query_run = mysqli_query($connection, $query);

    if (mysqli_fetch_array($query_run)) {
        $_SESSION['username'] = $email_login;
        header('Location: index.php');
    } else {
        $_SESSION['status'] = "Email / Password is Invalid";
        header('Location: login.php');
    }

}

// INSERT PRODUCT
if (isset($_POST['productaddbtn'])) {
    $product_name = $_POST['product_name'];
    $product_designation = $_POST['product_designation'];
    $product_description = $_POST['product_description'];
    $product_image = $_FILES['product_image']['name'];
    $categort = $_POST['category_id'];

    if (file_exists("upload/" . $_FILES["product_image"]['name'])) {

        $store = $_FILES['product_image']['name'];
        $_SESSION['status'] = "image already Exist. '.$store.'";
        header('Location: product.php');

    } else {
        $query = "INSERT INTO `prodcut` (productname,productdesignation,productdescription,prodcutimage,category_id)
    VALUES ('$product_name','$product_designation','$product_description','$product_image','$categort')";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            move_uploaded_file($_FILES['product_image']['tmp_name'], "upload/" . $_FILES["product_image"]["name"]);
            $_SESSION['success'] = "Product is Added Successfully";
            header('Location: product.php');
        } else {
            echo "not done";
            $_SESSION['status'] = "Product is Not Added";
            header('Location: product.php');
        }
    }
}

if (isset($_POST['updateprodcutbtn'])) {
    $edit_id = $_POST['edit_id'];
    $product_name = $_POST['edit_product'];
    $product_designation = $_POST['edit_designation'];
    $product_description = $_POST['edit_description'];
    $product_image = $_FILES['product_image']['name'];
    $categort = $_POST['category_id'];

    $query = "UPDATE prodcut SET productname='$product_name', productdesignation='$product_designation', productdescription='$product_description', prodcutimage='$product_image', category_id='$categort' WHERE pid='$edit_id' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        move_uploaded_file($_FILES['product_image']['tmp_name'], "upload/" . $_FILES["product_image"]["name"]);
        $_SESSION['success'] = "Product is Updated Successfully";
        header('Location: product.php');
    } else {
        echo "not done";
        $_SESSION['status'] = "Product is Not Updated";
        header('Location: product.php');
    }
}

if (isset($_POST['delete_data_btn'])) {
    $id = $_POST['delete_id'];

    $query = "DELETE FROM prodcut WHERE pid='$id' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['status'] = "Your Data is Deleted";
        $_SESSION['status_code'] = "success";
        header('Location: product.php');
    } else {
        $_SESSION['status'] = "Your Data is NOT DELETED";
        $_SESSION['status_code'] = "error";
        header('Location: product.php');
    }
}


?>