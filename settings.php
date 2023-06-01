<?php include('./components/includes.php') ?>
<?php include('./components/header.php') ?>
<!-- header section end -->
<!-- breadcrumb area start -->
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-area-content">
                    <h1>Settings Page</h1>
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
                    <h1><i class="icofont icofont-setting"></i> Settings</h1>
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-lg-12">
                <br><br>
                <?php
                $platform_add = @$_POST['platform_add'];
                $platform_name = @$_POST['platform_name'];
                $platform_id = @$_POST['platform_id'];
                $created_at = date("Y-m-d");
                if ($platform_add) {
                    $final = mysqli_query($conn, "INSERT INTO `network_provider`(`id`, `network_provider_id`, `network_name`, `created_at`) 
                    VALUES (NULL,'$platform_id','$platform_name','$created_at')");
                    if ($final) {
                        echo "<script>
                                        $(document).ready(function() {
                                            console.log('ready!');
                                            document.getElementById('notification-success-blog').click()
                                        });
                                        </script>
                                    <meta http-equiv=\"refresh\" content=\"4; url=create_blog.php\">";
                    }
                }

                ?>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="textarea-container">
                                <label for="">Platform Name</label>
                                <input type="text" name="platform_name" placeholder="Type Name of the Platform here">
                            </div>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="textarea-container">
                                <label for="">Platform ID</label>
                                <input type="text" name="platform_id" placeholder="Type Id of the Platform here">
                            </div>
                        </div>
                    </div><br>
                    <div class="details-comment">
                        <input type="submit" class="theme-btn col-md-12 theme-btn2" name="platform_add" value="Submit" />
                    </div>
                </form>
                <button onclick="Notify('Posted successfully! <br> Redirecting....', null, true, 'success')" hidden id="notification-success-blog">success</button>
                <br><br>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <br><br>
                <?php
                $language_add = @$_POST['language_add'];
                $languges = @$_POST['languges'];
                $language_code = @$_POST['language_code'];
                $created_at = date("Y-m-d");
                if ($language_add) {
                    $final = mysqli_query($conn, "INSERT INTO `settings`(`id`, `languges`, `language_code`, `created_at`) 
                    VALUES (NULL, '$languges', '$language_code', '$created_at')");
                    if ($final) {
                        echo "<script>
                                        $(document).ready(function() {
                                            console.log('ready!');
                                            document.getElementById('notification-success-blog').click()
                                        });
                                        </script>
                                    <meta http-equiv=\"refresh\" content=\"4; url=create_blog.php\">";
                    }
                }

                ?>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="textarea-container">
                                <label for="">Languges Name</label>
                                <input type="text" name="languges" placeholder="Type Name of the Languges Name here">
                            </div>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="textarea-container">
                                <label for="">Language Code</label>
                                <input type="text" name="language_code" placeholder="Type Id of the Language Code here">
                            </div>
                        </div>
                    </div><br>
                    <div class="details-comment">
                        <input type="submit" class="theme-btn col-md-12 theme-btn2" name="language_add" value="Submit" />
                    </div>
                </form>
                <button onclick="Notify('Posted successfully! <br> Redirecting....', null, true, 'success')" hidden id="notification-success-blog">success</button>
                <br><br>
            </div>
        </div>
    </div>
</section><!-- blog area end -->
<!-- footer section start -->
<?php include('./components/footer.php') ?>