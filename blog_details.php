<?php include('./components/includes.php') ?>
<?php include('./components/header.php') ?>
<?php include('./components/apiFunction.php') ?>


<!-- breadcrumb area start -->
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-area-content">
                    <h1>Blog Details Page</h1>
                </div>
            </div>
        </div>
    </div>
</section><!-- breadcrumb area end -->
<!-- blog area start -->
<section class="blog-details">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php
                $blog_id = $_GET['blog_id'];
                $query = "SELECT * FROM blog WHERE id = '$blog_id'";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_array($result)) {
                    $id  = $row['id'];
                    $topic  = $row['topic'];
                    $content  = $row['content'];
                    $image  = $row['image'];
                    $created_at  = $row['created_at'];
                    $newDate = date("d-M-Y", strtotime($created_at));
                    $year = substr($newDate, 7, 4);
                    $day = substr($created_at, 5, -3);
                    $month = substr($newDate, 3, -5);
                    $blog_pre = --$blog_id;
                    $blog_next = ++$blog_id;
                    echo "<div class='news-details'>
                    <div class='single-news'>
                    <div class='col-md-12'><img src='$image'></div>
                        <div class='news-date'>
                            <h2><span>NOV</span> 25</h2>
                            <h1>2017</h1>
                        </div>
                    </div>
                    <h2>$topic</h2>
                    <p>$content</p>
                    <br><br>
                    ";
                    if ($_SESSION['email']) {
                        if ($user_type == 'admin') {
                            $delete_blog = @$_POST['delete_blog'];
                            if ($delete_blog) {
                                echo deleteBlog($conn, $blog_id);
                            }
                ?>
                            <form method="post" class="form row" action="<?php echo $_SERVER['PHP_SELF']; ?>?blog_id=<?php echo $blog_id; ?>">
                                <input type="submit" name="delete_blog" value="Delete Blog" class="col-md-12 btn btn-danger">
                            </form>
                            <button onclick="Notify('Deleted successfully! <br> Redirecting....', null, true, 'danger')" hidden id="notification-deleted-blog">success</button>

                <?php }
                        echo "
                    <div class='detail-author'>
                        <div class='row flexbox-center'>
                            <div class='col-lg-6 text-lg-left text-center'>
                                    <h4>By Admin</h4>
                            </div>
                            <div class='col-lg-6 text-lg-right text-center'>
                                <div class='details-author'>
                                    <h4>Share:</h4>
                                    <a href='#'><i class='icofont icofont-social-facebook'></i></a>
                                    <a href='#'><i class='icofont icofont-social-twitter'></i></a>
                                    <a href='#'><i class='icofont icofont-social-pinterest'></i></a>
                                    <a href='#'><i class='icofont icofont-social-linkedin'></i></a>
                                    <a href='#'><i class='icofont icofont-social-google-plus'></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='details-thumb'>
                    <div class='details-thumb-prev'>
                        <div class='thumb-icon'>
                            <i class='icofont icofont-simple-left'></i>
                        </div>
                        <div class='thumb-text'>
                            <a href='blog_details.php?blog_id=$blog_pre'>
                                <h4>Previous Post</h4>
                                <p>Standard Post With Gallery</p>
                            </a>
                        </div>
                    </div>
                    <div class='details-thumb-next'>
                        <div class='thumb-text'>
                            <a href='blog_details.php?blog_id=$blog_next'>
                                <h4>Next Post</h4>
                                <p>Standard Post With Preview Image</p>
                            </a>
                        </div>
                        <div class='thumb-icon'>
                            <i class='icofont icofont-simple-right'></i>
                        </div>
                    </div>
                </div>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
    </div>
</section><!-- blog area end -->
<?php include('./components/footer.php') ?>