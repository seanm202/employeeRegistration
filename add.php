<?php
require_once "pdo.php";
function test_input($data)
{
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
  }



function getAgeValue($dob)
{
$dob = new DateTime($dob);
$currentDate = new DateTime();

// $currentDate=date("Y-m-d");
$age=$currentDate->diff($dob)->y;;
return $age;
}

if(isset($_POST['submitDetails']))
{

  $email = test_input($_POST["email"]);
    if(!isset($_POST['name']))
    {
      $_SESSION['error']="Name is missing!!!";
    }
    else if(ctype_alpha($_POST['name'])==false)
    {
      $_SESSION['error']="Name must be alphabetic";
    }
    else if(!isset($_POST['fathersName']))
    {
      echo("Father's name is missing!!!");
    }
    else if(ctype_alpha($_POST['fathersName'])==false)
    {
      $_SESSION['error']="Father's name must be alphabetic";
    }
    else if(!isset($_POST['mobileNumber']))
    {
      $_SESSION['error']="Mobile number is missing!!!";
    }
    else if(!is_numeric($_POST['mobileNumber']))
    {
      $_SESSION['error']="Mobile number must be numeric!!!";
    }
    else if(!preg_match('/^[0-9]{10}+$/', $_POST['mobileNumber']))
    {
      $_SESSION['error']="Mobile number must have 10 digits.!!!";
    }
    else if(!isset($_POST['dob']))
    {
      $_SESSION['error']="Date of birth is missing!!!";
    }
    else if(getAgeValue($_POST['dob'])<18)
    {
      $_SESSION['error'] = "Applicant must be 18years or older!!!";
    }
    else if(!isset($_POST['job']))
    {
      $_SESSION['error']="Job is missing!!!";
    }
    else if(!isset($_POST['email']))
    {
      $_SESSION['error']="Email is missing!!!";
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
          $_SESSION['error'] = "Email must have an at-sign (@)";
    }else if(!isset($_FILES['profilePhoto']))
    {
      $_SESSION['error']="Photo is missing!!!";
    }
    else if ($_FILES['profilePhoto']['error'] === UPLOAD_ERR_OK)
    {
      // get details of the uploaded file
      $fileTmpPath = $_FILES['profilePhoto']['tmp_name'];
      $fileName = $_FILES['profilePhoto']['name'];
      $fileSize = $_FILES['profilePhoto']['size'];
      $fileType = $_FILES['profilePhoto']['type'];
      $fileNameCmps = explode(".", $fileName);
      $fileExtension = strtolower(end($fileNameCmps));

      // sanitize file-name
      $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

      // check if file has one of the following extensions
      $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');
      $uploadFileDir = './uploaded_files/';
      $dest_path = $uploadFileDir . $newFileName;

      if (in_array($fileExtension, $allowedfileExtensions))
      {
        // directory in which the uploaded file will be moved
        $uploadFileDir = './uploaded_files/';
        $dest_path = $uploadFileDir . $newFileName;

        if(move_uploaded_file($fileTmpPath, $dest_path))
        {
          $_SESSION['success'] ='File is successfully uploaded.';
        }
        else
        {
          $_SESSION['error'] = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
          return;
        }
        $_SESSION['error'] = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
        unset($_SESSION['error']);
        $_SESSION['error'] = $_FILES['profilePhoto']['error'];
      }

      echo("<p>Handling POST data...</p>\n");
      $sql = "INSERT INTO employee (name,fathersName,mobileNumber,dateOfBirth,position,email,photoLoc,remarks) VALUES (:name, :fathersName, :mobileNumber, :dateOfBirth, :position, :email, :photoLoc, :remarks)";
      $stmt = $pdo->prepare($sql);

      $stmt->execute(array(':name' => $_POST['name'],':fathersName' => $_POST['fathersName'],':mobileNumber' => $_POST['mobileNumber'],':dateOfBirth' => $_POST['dob'],':position' => $_POST['job'],':email' => $_POST['email'],':photoLoc' => $dest_path,':remarks' => "NIL"));
      echo("<h2 style='font-size:20px;color:blue;'>Record inserted</h2>");
      header('Location: index.php');
    }
}
?>
