<?php
$servername = "localhost";
$username = "root";
$password = "";
$db="expense_tracker";

// Create connection
$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

if (isset($_POST['save_exp_cat']) && !empty($_POST['exp_cat_name'])) {
    extract($_POST);
    $sql="SELECT * FROM `exp_cat` WHERE name='$exp_cat_name'";
    $result=$conn->query($sql);
    $row = $result->num_rows;
    if ($row<=0) {
        $sql="INSERT INTO `exp_cat` VALUES('','$exp_cat_name',NULL)";
        $result=$conn->query($sql);
        if ($result) {
            $_SESSION['color']="success";
            $_SESSION['flash_message'] = 'Data Added Successfully!';
            header("Location: expense_cat.php");
        }else {
            $_SESSION['color']="warning";
            $_SESSION['flash_message'] = 'Something Wrong!';
            header("Location: expense_cat.php");
        }
    }else {
        $_SESSION['color']="warning";
        $_SESSION['flash_message'] = 'Data alrady added!';
        header("Location: expense_cat.php");
    }
}
if (isset($_GET['cat_id'])) {
    extract($_GET);
    $sql="DELETE FROM `exp_cat` WHERE id='$cat_id'";
    $result=$conn->query($sql);
    if ($result) {
        $_SESSION['color']="success";
        $_SESSION['flash_message'] = 'Data deleted Successfully!';
        header("Location: expense_cat.php");
    }else {
        $_SESSION['color']="warning";
        $_SESSION['flash_message'] = 'Something Wrong!';
        header("Location: expense_cat.php");
    }
}

if (!empty($_POST['exp_cat_edit_name']) && isset($_POST['edit_exp_id'])) {
    extract($_POST);
    $sql="SELECT * FROM `exp_cat`";
    $result=$conn->query($sql);
    $row = $result->num_rows;
    if ($row<=0) {
        $sql="UPDATE `exp_cat` SET name='$exp_cat_edit_name' WHERE id='$edit_exp_id'";
        $result=$conn->query($sql);
        if ($result) {
            $_SESSION['color']="success";
            $_SESSION['flash_message'] = 'Data Added Successfully!';
            header("Location: expense_cat.php");
        }else {
            $_SESSION['color']="warning";
            $_SESSION['flash_message'] = 'Something Wrong!';
            header("Location: expense_cat.php");
        }
    }else {
        $_SESSION['color']="warning";
        $_SESSION['flash_message'] = 'Data alrady added!';
        header("Location: expense_cat.php");
    }
}

if (isset($_POST['add_expense']) && !empty($_POST['exp_cat_id'])) {
    extract($_POST);
        $sql="INSERT INTO `expenses` VALUES('','$exp_cat_id','$exp_amount','$exp_date',NULL)";
        $result=$conn->query($sql);
        if ($result) {
            $_SESSION['color']="success";
            $_SESSION['flash_message'] = 'Data Added Successfully!';
            header("Location: expense.php");
        }else {
            $_SESSION['color']="warning";
            $_SESSION['flash_message'] = 'Something Wrong!';
            header("Location: expense.php");
        }
}

if (isset($_GET['exp_id'])) {
    extract($_GET);
    $sql="DELETE FROM `expenses` WHERE id='$exp_id'";
    $result=$conn->query($sql);
    if ($result) {
        $_SESSION['color']="success";
        $_SESSION['flash_message'] = 'Data deleted Successfully!';
        header("Location: exp_report.php");
    }else {
        $_SESSION['color']="warning";
        $_SESSION['flash_message'] = 'Something Wrong!';
        header("Location: exp_report.php");
    }
}

if (isset($_POST['update_expense']) && !empty($_POST['exp_update_id'])) {
    extract($_POST);
        $sql="UPDATE `expenses` SET exp_cat_id='$exp_cat_id',exp_amount='$exp_amount',exp_date='$exp_date' WHERE id='$exp_update_id'";
        $result=$conn->query($sql);
        if ($result) {
            $_SESSION['color']="success";
            $_SESSION['flash_message'] = 'Data Added Successfully!';
            header("Location: exp_report.php");
        }else {
            $_SESSION['color']="warning";
            $_SESSION['flash_message'] = 'Something Wrong!';
            header("Location: exp_report.php");
        }
}