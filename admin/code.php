<?php
// session_start();
include('security.php');

if (isset($_POST['check_submit_btn'])) {
    $email = $_POST['email_id'];
    $email_query = "SELECT * FROM register WHERE email = '$email' ";
    $email_query_run = mysqli_query($connection, $email_query);
    if (mysqli_num_rows($email_query_run) > 0 ) {
       echo "Email already exists. Please try another one.";
    } else {
        echo "It's available.";
    }
}

if (isset($_POST['registerbtn'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];
    $usertype = $_POST['usertype'];

    $email_query = "SELECT * FROM register WHERE email = '$email' ";
    $email_query_run = mysqli_query($connection, $email_query);
    if (mysqli_num_rows($email_query_run) > 0 ) {
        $_SESSION['status'] = "Email Already Taken. Please try another one.";
        $_SESSION['status_code'] = "error";
        header('Location: register.php');
    } else {

    if ($password === $cpassword) {
        $query = "INSERT INTO register (username, email, password, usertype) VALUES ('$username', '$email', '$password', '$usertype')";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            // echo "Saved";
            $_SESSION['status'] = "Admin Profile Added";
            $_SESSION['status_code'] = "success";
            header('Location: register.php');
        } else {
            // echo "Not Saved";
            $_SESSION['status'] = "Admin Profile Not Added";
            $_SESSION['status_code'] = "error";
            header('Location: register.php');
        }
    } else {
        $_SESSION['status'] = "Password and Confirm Password Do Not Match";
        $_SESSION['status_code'] = "warning";
        header('Location: register.php');
    }
}
    
}

if (isset($_POST['updatebtn'])) {
    $id = $_POST['edit_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $usertypeupdate = $_POST['usertype'];

    $query = "UPDATE register SET username='$username', email='$email', password='$password', usertype='$usertypeupdate' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);
    if($query_run) {
        $_SESSION['status'] = "Your data is updated";
        $_SESSION['status_code'] = "success";
        header('Location: register.php');
    } else {
        $_SESSION['status'] = "Your data not is updated: ".mysqli_error($connection);
        $_SESSION['status_code'] = "error";
        header('Location: register.php');
    }
}

if (isset($_POST['reg_delete_btn'])) {
    $id = $_POST['reg_delete_id'];

    $query = "DELETE FROM register WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['status'] = "Your data is deleted";
        $_SESSION['status_code'] = "success";
        header('Location: register.php');
    } else {
        $_SESSION['status'] = "Your data is not deleted";
        $_SESSION['status_code'] = "error";
        header('Location: register.php');
    }
}



if (isset($_POST['login_btn'])) {
    $email_login = $_POST['email'];
    $password_login = $_POST['password'];

    $query = "SELECT * FROM register WHERE email='$email_login' AND password='$password_login' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['username'] = $email_login;
        header('Location: index.php');
    } else {
        $_SESSION['status'] = 'Email Id/Password is invalid';
        header('Location: login.php');
    }


}

if (isset($_POST['logout_btn'])) {
    session_destroy();
    unset($_SESSION['username']);
}


if (isset($_POST['about_save'])) {
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $description = $_POST['description'];
    $links = $_POST['links'];

    $query = "INSERT INTO abouts (title, subtitle, description, links) VALUES ('$title', '$subtitle', '$description', '$links')";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
         $_SESSION['success'] = "About Us Page Added";
         header('Location: aboutus.php');
    } else {
         $_SESSION['status'] = "About Us Page Not Added: ".mysqli_error($connection);
         header('Location: aboutus.php');
    }
}


if (isset($_POST['about_delete_btn'])) {
    $id = $_POST['delete_id'];

    $query = "DELETE FROM abouts WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Your data is deleted";
        header('Location: aboutus.php');
    } else {
        $_SESSION['status'] = "Your data is not deleted";
        header('Location: aboutus.php');
    }
}




if (isset($_POST['update_btn'])) {
    $id = $_POST['edit_id'];
    $title = $_POST['edit_title'];
    $subtitle = $_POST['edit_subtitle'];
    $description = $_POST['edit_description'];
    $links = $_POST['edit_links'];

    $query = "UPDATE abouts SET title='$title', subtitle='$subtitle', description='$description', links='$links' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);
    if($query_run) {
        $_SESSION['success'] = "Your data is updated";
        header('Location: aboutus.php');
    } else {
        $_SESSION['status'] = "Your data not is updated";
        header('Location: aboutus.php');
    }
}

if (isset($_POST['faculty_save'])) {
    $name = $_POST['name'];
    $designation = $_POST['designation'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];

    // $validate_img_extension = $_FILES["image"]['type'] == "image/jpg" ||
    //     $_FILES["image"]['type'] == "image/png" ||
    //     $_FILES["image"]['type'] == "image/jpeg" ||
    //     $_FILES["image"]['type'] == "image/gif"
    //     ;

        $img_types = array('image/jpg', 'image/png', 'image/jpeg', 'image/gif');
        $validate_img_extension = in_array($_FILES["image"]["type"], $img_types);


    if ($validate_img_extension) {
        # code...
    

    if (file_exists("upload/faculty/".$_FILES["image"]["name"])) {
        $store = $_FILES["image"]["name"];
        $_SESSION['status'] = "Image already exists. '.$store'";
        header('Location: faculty.php');
    } else {
        $query = "INSERT INTO faculty (name, designation, description, image) VALUES ('$name', '$designation', '$description', '$image')";
        $query_run = mysqli_query($connection, $query);
        if($query_run) {
            move_uploaded_file($_FILES["image"]["tmp_name"], "upload/faculty/".$_FILES["image"]["name"]);
            $_SESSION['success'] = "Faculty Added";
            header('Location: faculty.php');
        } else {
            $_SESSION['status'] = "Faculty Not Added";
            header('Location: faculty.php');
        }
    }

} else {
    $_SESSION['status'] = "Only PNG, JPG, JPEG and GIF Images allowed";
    header('Location: faculty.php');
}

}

if (isset($_POST['faculty_update_btn'])) {
    $edit_id = $_POST['edit_id'];
    $edit_name = $_POST['edit_name'];
    $edit_designation = $_POST['edit_designation'];
    $edit_description = $_POST['edit_description'];
    $edit_image = $_FILES['edit_image']['name'];

    //Delete image from folder while edit and update image in PHP
    $faculty_query = "SELECT * FROM faculty WHERE id = '$edit_id' ";
    $faculty_query_run = mysqli_query($connection, $faculty_query);
    foreach($faculty_query_run as $fa_row) {
        if ($edit_image == NULL) {
            //Update with exising image
            $image_data = $fa_row['image'];
        } else {
            //Update with new image and delete with old image
            if ($img_path = "upload/faculty/".$fa_row['image']) {
                unlink($img_path);
                $image_data = $edit_image;
            }
            
        }
    }

    $query = "UPDATE faculty SET name = '$edit_name', designation = '$edit_designation', description = '$edit_description', image = '$image_data' WHERE id = '$edit_id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run) {
        if ($edit_image == NULL) {
            //Update with exising image
            $_SESSION['success'] = "Faculty updated with exising image";
            header('Location: faculty.php');
        
        } else {
            //Update with new image and delete with old image
            move_uploaded_file($_FILES["edit_image"]["tmp_name"], "upload/faculty/".$_FILES["edit_image"]["name"]);
            $_SESSION['success'] = "Faculty Updated";
            header('Location: faculty.php');
        }
      
    } else {
        $_SESSION['status'] = "Faculty Not Updated";
        header('Location: faculty.php');
    }
}


if (isset($_POST['search_data'])) {
    $id = $_POST['id'];
    $visible = $_POST['visible'];

    $query = "UPDATE faculty SET visible = '$visible' WHERE id = '$id' ";
    $query_run = mysqli_query($connection, $query);
}

if (isset($_POST['delete_multiple_data'])) {
    $id = "1";
    $query = "DELETE FROM faculty WHERE visible = '$id' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Your data is deleted";
        header('Location: faculty.php');
    } else {
        $_SESSION['status'] = "Your data not is deleted";
        header('Location: faculty.php');
    }

}


if (isset($_POST['delete_btn'])) {
    $id = $_POST['delete_id'];

    $query = "DELETE FROM faculty WHERE id = '$id' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Faculty data is deleted";
        header('Location: faculty.php');
    } else {
        $_SESSION['status'] = "Faculty data not is deleted";
        header('Location: faculty.php');
    }
}


if (isset($_POST['dept_save'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];

    // $validate_img_extension = $_FILES["image"]['type'] == "image/jpg" ||
    //     $_FILES["image"]['type'] == "image/png" ||
    //     $_FILES["image"]['type'] == "image/jpeg" ||
    //     $_FILES["image"]['type'] == "image/gif"
    //     ;

        $img_types = array('image/jpg', 'image/png', 'image/jpeg', 'image/gif');
        $validate_img_extension = in_array($_FILES["image"]["type"], $img_types);


    if ($validate_img_extension) {
        # code...
    

    if (file_exists("upload/departments/".$_FILES["image"]["name"])) {
        $store = $_FILES["image"]["name"];
        $_SESSION['status'] = "Image already exists. '.$store'";
        header('Location: departments.php');
    } else {
        $query = "INSERT INTO dept_category (name, description, image) VALUES ('$name', '$description', '$image')";
        $query_run = mysqli_query($connection, $query);
        if($query_run) {
            move_uploaded_file($_FILES["image"]["tmp_name"], "upload/departments/".$_FILES["image"]["name"]);
            $_SESSION['success'] = "Department Added";
            header('Location: departments.php');
        } else {
            $_SESSION['status'] = "Department Not Added";
            header('Location: departments.php');
        }
    }

} else {
    $_SESSION['status'] = "Only PNG, JPG, JPEG and GIF Images allowed";
    header('Location: departments.php');
}

}



if (isset($_POST['department_update_btn'])) {
    $edit_id = $_POST['edit_id'];
    $edit_name = $_POST['edit_name'];
    $edit_description = $_POST['edit_description'];
    $edit_image = $_FILES['edit_image']['name'];

    //Delete image from folder while edit and update image in PHP
    $departmet_query = "SELECT * FROM dept_category WHERE id = '$edit_id' ";
    $departmet_query_run = mysqli_query($connection, $departmet_query);
    foreach($departmet_query_run as $fa_row) {
        if ($edit_image == NULL) {
            //Update with exising image
            $image_data = $fa_row['image'];
        } else {
            //Update with new image and delete with old image
            if ($img_path = "upload/departments/".$fa_row['image']) {
                unlink($img_path);
                $image_data = $edit_image;
            }
            
        }
    }


    $query = "UPDATE dept_category SET name = '$edit_name', description = '$edit_description', image = '$image_data' WHERE id = '$edit_id' ";
    $query_run = mysqli_query($connection, $query);

   
    if($query_run) {
        if ($edit_image == NULL) {
            //Update with exising image
            $_SESSION['success'] = "Department updated with exising image";
            header('Location: departments.php');
        
        } else {
            //Update with new image and delete with old image
            move_uploaded_file($_FILES["edit_image"]["tmp_name"], "upload/departments/".$_FILES["edit_image"]["name"]);
            $_SESSION['success'] = "Department Updated";
            header('Location: departments.php');
        }
      
    } else {
        $_SESSION['status'] = "Department Not Updated";
        header('Location: departments.php');
    }
}

if (isset($_POST['search_data'])) {
    $id = $_POST['id'];
    $visible = $_POST['visible'];

    $query = "UPDATE dept_category SET visible = '$visible' WHERE id = '$id' ";
    $query_run = mysqli_query($connection, $query);
}


if (isset($_POST['delete_multiple_data'])) {
    $id = "1";
    $query = "DELETE FROM dept_category WHERE visible = '$id' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Your data is deleted";
        header('Location: departments.php');
    } else {
        $_SESSION['status'] = "Your data not is deleted";
        header('Location: departments.php');
    }

}


if (isset($_POST['delete_btn'])) {
    $id = $_POST['delete_id'];

    $query = "DELETE FROM dept_category WHERE id = '$id' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Department Category is deleted";
        header('Location: departments.php');
    } else {
        $_SESSION['status'] = "Department Category not is deleted";
        header('Location: departments.php');
    }
}

if (isset($_POST['dept_list_save'])) {
    $department = $_POST['department'];
    $name = $_POST['name'];   
    $description = $_POST['description'];
    $section = $_POST['section'];

    $query = "INSERT INTO dept_category_list (department, name, description, section) VALUES ('$department', '$name', '$description', '$section')";
    $query_run = mysqli_query($connection, $query);
    
    if ($query_run) {
        $_SESSION['success'] = "Department Category-List is Added";
        header('Location: departments-list.php');
    } else {
        $_SESSION['status'] = "Department Category-List is not Added";
        header('Location: departments-list.php');
    }

}


if (isset($_POST['dept_list_update_btn'])) {
    $edit_id = $_POST['edit_id'];
    $edit_department = $_POST['edit_department'];
    $edit_name = $_POST['edit_name'];
    $edit_description = $_POST['edit_description'];
    $edit_section = $_POST['edit_section'];

    $query = "UPDATE dept_category_list SET department = '$edit_department', name = '$edit_name', description = '$edit_description', section = '$edit_section' WHERE id = '$edit_id' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Department Category-List is Updated";
        header('Location: departments-list.php');
    } else {
        $_SESSION['status'] = "Department Category-List is not Updated";
        header('Location: departments-list.php');
    }
}

if (isset($_POST['search_data'])) {
    $id = $_POST['id'];
    $visible = $_POST['visible'];

    $query = "UPDATE dept_category_list SET visible = '$visible' WHERE id = '$id' ";
    $query_run = mysqli_query($connection, $query);
}


if (isset($_POST['delete_multiple_data'])) {
    $id = "1";
    $query = "DELETE FROM dept_category_list WHERE visible = '$id' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Your data is deleted";
        header('Location: departments-list.php');
    } else {
        $_SESSION['status'] = "Your data not is deleted";
        header('Location: departments-list.php');
    }

}


if (isset($_POST['delete_btn'])) {
    $id = $_POST['delete_id'];

    $query = "DELETE FROM dept_category_list WHERE id = '$id' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Department Category is deleted";
        header('Location: departments-list.php');
    } else {
        $_SESSION['status'] = "Department Category not is deleted";
        header('Location: departments-list.php');
    }
}




//LEEWEBS TECHNOLOGIES
//Portfolio - Insert

if (isset($_POST['portfolio_save'])) {
    $description = mysqli_real_escape_string($connection, $_POST['description']);
    $title = $_POST['title'];
    $date = $_POST['date'];
    $image = $_FILES['image']['name'];

    // $validate_img_extension = $_FILES["image"]['type'] == "image/jpg" ||
    //     $_FILES["image"]['type'] == "image/png" ||
    //     $_FILES["image"]['type'] == "image/jpeg" ||
    //     $_FILES["image"]['type'] == "image/gif"
    //     ;

        $img_types = array('image/jpg', 'image/png', 'image/jpeg', 'image/gif');
        $validate_img_extension = in_array($_FILES["image"]["type"], $img_types);


    if ($validate_img_extension) {
        # code...
    

    if (file_exists("upload/portfolio/".$_FILES["image"]["name"])) {
        $store = $_FILES["image"]["name"];
        $_SESSION['status'] = "Image already exists. '.$store'";
        header('Location: portfolio.php');
    } else {
        $query = "INSERT INTO portfolio (description, title, date, image) VALUES ('$description', '$title', '$date', '$image')";
        $query_run = mysqli_query($connection, $query);
        if($query_run) {
            move_uploaded_file($_FILES["image"]["tmp_name"], "upload/portfolio/".$_FILES["image"]["name"]);
            $_SESSION['success'] = "Portfolio Added";
            header('Location: portfolio.php');
        } else {
            $_SESSION['status'] = "Portfolio Not Added";
            header('Location: portfolio.php');
        }
    }

} else {
    $_SESSION['status'] = "Only PNG, JPG, JPEG and GIF Images allowed";
    header('Location: portfolio.php');
}

}

//Portfolio - Update
if (isset($_POST['portfolio_update_btn'])) {
    $edit_id = $_POST['edit_id'];
    $edit_description = mysqli_real_escape_string($connection, $_POST['edit_description']);
    $edit_title = $_POST['edit_title'];
    $edit_date = $_POST['edit_date'];
    $edit_image = $_FILES['edit_image']['name'];

    //Delete image from folder while edit and update image in PHP
    $faculty_query = "SELECT * FROM portfolio WHERE id = '$edit_id' ";
    $faculty_query_run = mysqli_query($connection, $faculty_query);
    foreach($faculty_query_run as $fa_row) {
        if ($edit_image == NULL) {
            //Update with exising image
            $image_data = $fa_row['image'];
        } else {
            //Update with new image and delete with old image
            if ($img_path = "upload/portfolio/".$fa_row['image']) {
                unlink($img_path);
                $image_data = $edit_image;
            }
            
        }
    }

    $query = "UPDATE portfolio SET description = '$edit_description', title = '$edit_title', date = '$edit_date', image = '$image_data' WHERE id = '$edit_id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run) {
        if ($edit_image == NULL) {
            //Update with exising image
            $_SESSION['success'] = "Portfolio updated with exising image";
            header('Location: portfolio.php');
        
        } else {
            //Update with new image and delete with old image
            move_uploaded_file($_FILES["edit_image"]["tmp_name"], "upload/portfolio/".$_FILES["edit_image"]["name"]);
            $_SESSION['success'] = "Portfolio Updated";
            header('Location: portfolio.php');
        }
      
    } else {
        $_SESSION['status'] = "Portfolio Not Updated";
        header('Location: portfolio.php');
    }
}


if (isset($_POST['search_data'])) {
    $id = $_POST['id'];
    $visible = $_POST['visible'];

    $query = "UPDATE portfolio SET visible = '$visible' WHERE id = '$id' ";
    $query_run = mysqli_query($connection, $query);
}

//Portfolio - Delete
if (isset($_POST['portfolio_delete_multiple_data'])) {
    $id = "1";
    $query = "DELETE FROM portfolio WHERE visible = '$id' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Your data is deleted";
        header('Location: portfolio.php');
    } else {
        $_SESSION['status'] = "Your data not is deleted";
        header('Location: portfolio.php');
    }

}


if (isset($_POST['portfolio_delete_btn'])) {
    $id = $_POST['delete_id'];

    $query = "DELETE FROM portfolio WHERE id = '$id' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Portfolio data is deleted";
        header('Location: portfolio.php');
    } else {
        $_SESSION['status'] = "Portfolio data not is deleted";
        header('Location: portfolio.php');
    }
}



if (isset($_POST['blog_save'])) {
    $content = mysqli_real_escape_string($connection, $_POST['content']);
    $title = $_POST['title'];
    $topic = $_POST['topic'];
    $date = $_POST['date'];
    $image = $_FILES['image']['name'];

    // $validate_img_extension = $_FILES["image"]['type'] == "image/jpg" ||
    //     $_FILES["image"]['type'] == "image/png" ||
    //     $_FILES["image"]['type'] == "image/jpeg" ||
    //     $_FILES["image"]['type'] == "image/gif"
    //     ;

        $img_types = array('image/jpg', 'image/png', 'image/jpeg', 'image/gif');
        $validate_img_extension = in_array($_FILES["image"]["type"], $img_types);


    if ($validate_img_extension) {
        # code...
    

    if (file_exists("upload/testimony/".$_FILES["image"]["name"])) {
        $store = $_FILES["image"]["name"];
        $_SESSION['status'] = "Image already exists. '.$store'";
        header('Location: blog.php');
    } else {
        $query = "INSERT INTO blog (content, title, topic, date, image) VALUES ('$content', '$title', '$topic', '$date', '$image')";
        $query_run = mysqli_query($connection, $query);
        if($query_run) {
            move_uploaded_file($_FILES["image"]["tmp_name"], "upload/testimony/".$_FILES["image"]["name"]);
            $_SESSION['success'] = "Blog Added";
            header('Location: blog.php');
        } else {
            $_SESSION['status'] = "Blog Not Added";
            header('Location: blog.php');
        }
    }

} else {
    $_SESSION['status'] = "Only PNG, JPG, JPEG and GIF Images allowed";
    header('Location: blog.php');
}

}




//Portfolio - Update
if (isset($_POST['blog_update_btn'])) {
    $edit_id = $_POST['edit_id'];
    $edit_content = mysqli_real_escape_string($connection, $_POST['edit_content']);
    $edit_title = $_POST['edit_title'];
    $edit_topic = $_POST['edit_topic'];
    $edit_date = $_POST['edit_date'];
    $edit_image = $_FILES['edit_image']['name'];

    //Delete image from folder while edit and update image in PHP
    $faculty_query = "SELECT * FROM blog WHERE id = '$edit_id' ";
    $faculty_query_run = mysqli_query($connection, $faculty_query);
    foreach($faculty_query_run as $fa_row) {
        if ($edit_image == NULL) {
            //Update with exising image
            $image_data = $fa_row['image'];
        } else {
            //Update with new image and delete with old image
            if ($img_path = "upload/testimony/".$fa_row['image']) {
                unlink($img_path);
                $image_data = $edit_image;
            }
            
        }
    }

    $query = "UPDATE blog SET content = '$edit_content', title = '$edit_title', topic = '$edit_topic', date = '$edit_date', image = '$image_data' WHERE id = '$edit_id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run) {
        if ($edit_image == NULL) {
            //Update with exising image
            $_SESSION['success'] = "Blog updated with exising image";
            header('Location: blog.php');
        
        } else {
            //Update with new image and delete with old image
            move_uploaded_file($_FILES["edit_image"]["tmp_name"], "upload/testimony/".$_FILES["edit_image"]["name"]);
            $_SESSION['success'] = "Blog Updated";
            header('Location: blog.php');
        }
      
    } else {
        $_SESSION['status'] = "Blog Not Updated";
        header('Location: blog.php');
    }
}


if (isset($_POST['search_data'])) {
    $id = $_POST['id'];
    $visible = $_POST['visible'];

    $query = "UPDATE blog SET visible = '$visible' WHERE id = '$id' ";
    $query_run = mysqli_query($connection, $query);
}

//Portfolio - Delete
if (isset($_POST['blog_delete_multiple_data'])) {
    $id = "1";
    $query = "DELETE FROM blog WHERE visible = '$id' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Your data is deleted";
        header('Location: blog.php');
    } else {
        $_SESSION['status'] = "Your data not is deleted";
        header('Location: blog.php');
    }

}


if (isset($_POST['blog_delete_btn'])) {
    $id = $_POST['delete_id'];

    $query = "DELETE FROM blog WHERE id = '$id' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Portfolio data is deleted";
        header('Location: blog.php');
    } else {
        $_SESSION['status'] = "Portfolio data not is deleted";
        header('Location: blog.php');
    }
}




if (isset($_POST['contact_delete_btn'])) {
    $id = $_POST['delete_id'];

    $query = "DELETE FROM contact WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['status'] = "Your data is deleted";
        $_SESSION['status_code'] = "success";
        header('Location: contact.php');
    } else {
        $_SESSION['status'] = "Your data is not deleted";
        $_SESSION['status_code'] = "error";
        header('Location: contact.php');
    }
}





if (isset($_POST['blog_single_save'])) {
    $content = mysqli_real_escape_string($connection, $_POST['content']);
    $title = $_POST['title'];
    $topic = $_POST['topic'];
    $date = $_POST['date'];
    $image = $_FILES['image']['name'];

    // $validate_img_extension = $_FILES["image"]['type'] == "image/jpg" ||
    //     $_FILES["image"]['type'] == "image/png" ||
    //     $_FILES["image"]['type'] == "image/jpeg" ||
    //     $_FILES["image"]['type'] == "image/gif"
    //     ;

        $img_types = array('image/jpg', 'image/png', 'image/jpeg', 'image/gif');
        $validate_img_extension = in_array($_FILES["image"]["type"], $img_types);


    if ($validate_img_extension) {
        # code...
    

    if (file_exists("upload/blog_single/".$_FILES["image"]["name"])) {
        $store = $_FILES["image"]["name"];
        $_SESSION['status'] = "Image already exists. '.$store'";
        header('Location: blog-single.php');
    } else {
        $query = "INSERT INTO single_blog (content, title, topic, date, image) VALUES ('$content', '$title', '$topic', '$date', '$image')";
        $query_run = mysqli_query($connection, $query);
        if($query_run) {
            move_uploaded_file($_FILES["image"]["tmp_name"], "upload/blog_single/".$_FILES["image"]["name"]);
            $_SESSION['success'] = "Blog Added";
            header('Location: blog-single.php');
        } else {
            $_SESSION['status'] = "Blog Not Added";
            header('Location: blog-single.php');
        }
    }

} else {
    $_SESSION['status'] = "Only PNG, JPG, JPEG and GIF Images allowed";
    header('Location: blog-single.php');
}

}


?>












