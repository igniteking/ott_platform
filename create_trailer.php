<?php include('./components/includes.php') ?>
<?php include('./components/header.php') ?>
<?php include('./components/apiFunction.php') ?>
<!-- header section end -->
<!-- breadcrumb area start -->
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-area-content">
                    <h1>Create Trailer Page</h1>
                </div>
            </div>
        </div>
    </div>
</section><!-- breadcrumb area end -->
<!-- blog area start -->
<section class="blog-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title pb-20">
                    <h1><i class="icofont icofont-coffee-cup"></i> Trailer Form</h1>
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-lg-12">
                <br><br>
                <?php
                $post = @$_POST['admin_blog'];
                $topic = @$_POST['topic'];
                $link = @$_POST['link'];
                $profile_picture = @$_POST['profile_picture'];
                $created_at = date("Y-m-d");
                if ($post) {
                    if (empty($profile_picture)) {
                        // UPLOADING PROFILE PIC
                        $length = 10;
                        $random = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
                        $folder = mkdir("./content/trailer/$random");
                        $target_dir = "./content/trailer/$random/";
                        $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
                        $uploadOk = 1;
                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
                            $profile_picture = htmlspecialchars(basename($_FILES["profile_picture"]["name"]));
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }

                    $final = mysqli_query($conn, "INSERT INTO `trailer`(`id`, `topic`, `link`, `image`, `created_at`) VALUES
                     (NULL,'$topic','$link','$target_dir$profile_picture','$created_at')");
                    if ($final) {
                        echo "<script>
                                        $(document).ready(function() {
                                            console.log('ready!');
                                            document.getElementById('notification-success-blog').click()
                                        });
                                        </script>
                                    <meta http-equiv=\"refresh\" content=\"4; url=create_trailer.php\">";
                    }
                }

                ?>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="textarea-container">
                                <label for="">Heading of the Trailer</label>
                                <input type="text" name="topic" placeholder="Type Topic of the blog here">
                            </div>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="textarea-container">
                                <label for="">Content of the blog</label>
                                <input type="url" name="link" placeholder="Insert youtube url here">
                            </div>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="textarea-container">
                                <label for="">Background Image</label>
                                <input name="profile_picture" id="exampleAddress" type="file" class="form-control">
                            </div>
                        </div>
                    </div><br>
                    <div class="details-comment">
                        <input type="submit" class="theme-btn col-md-12 theme-btn2" name="admin_blog" value="Submit" />
                    </div>
                </form>
                <button onclick="Notify('Posted successfully! <br> Redirecting....', null, true, 'success')" hidden id="notification-success-blog">success</button>
                <br><br>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table>
                    <thead>
                        <tr>
                            <td>Topic</td>
                            <td>Link</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $delete_trailer = @$_POST['delete_trailer'];
                        $trailer_id  = @$_GET['trailer_id'];
                        if ($delete_trailer) {
                            echo deleteTrailer($conn, $trailer_id);
                        }
                        $query = "SELECT * FROM trailer";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_array($result)) {
                            $trailer_id  = $row['id'];
                            $topic  = $row['topic'];
                            $link  = $row['link'];
                            echo "<tr>
                            <td>$topic</td>
                            <td>$link</td>
                            <td>";
                        ?>
                            <form method="post" class="form row" action="<?php echo $_SERVER['PHP_SELF']; ?>?trailer_id=<?php echo $trailer_id; ?>">
                                <input type="submit" name="delete_trailer" value="Delete Trailer" class="col-md-12 btn btn-danger">
                            </form>
                            <button onclick="Notify('Deleted successfully! <br> Redirecting....', null, true, 'danger')" hidden id="notification-deleted-blog">success</button>
                            </td><?php
                                    echo "
                            </tr>";
                                }
                                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- blog area end -->
<!-- footer section start -->
<?php include('./components/footer.php') ?>