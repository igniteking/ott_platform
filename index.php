  <?php include('./components/includes.php') ?>
  <?php include('./components/api.php') ?>
  <?php include('./components/header.php') ?>
  <?php include('./components/apiFunction.php') ?>


  <section class="hero-area" id="home">
    <div class="container col-12">
      <div class="row hero-area-slide">
        <div class="col-md-4">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="section-title pb-20">
                  <h1><i class="icofont icofont-coffee-cup"></i> Latest Stories</h1>
                </div>
              </div>
            </div>
            <hr />
            <style>
              .mySlides {
                display: none
              }

              img {
                vertical-align: middle;
              }

              /* Slideshow container */
              .slideshow-container {
                max-width: 1000px;
                position: relative;
                margin: auto;
              }

              /* Next & previous buttons */
              .prev,
              .next {
                cursor: pointer;
                position: absolute;
                top: 50%;
                width: auto;
                padding: 16px;
                margin-top: -22px;
                color: white;
                font-weight: bold;
                font-size: 18px;
                transition: 0.6s ease;
                border-radius: 0 3px 3px 0;
                user-select: none;
              }

              /* Position the "next button" to the right */
              .next {
                right: 0;
                border-radius: 3px 0 0 3px;
              }

              /* On hover, add a black background color with a little bit see-through */
              .prev:hover,
              .next:hover {
                background-color: rgba(0, 0, 0, 0.8);
              }

              /* Caption text */
              .text {
                color: #f2f2f2;
                font-size: 15px;
                padding: 8px 12px;
                position: absolute;
                bottom: 8px;
                width: 100%;
                text-align: center;
              }

              /* Number text (1/3 etc) */
              .numbertext {
                color: #f2f2f2;
                font-size: 12px;
                padding: 8px 12px;
                position: absolute;
                top: 0;
              }

              /* The dots/bullets/indicators */
              .dot {
                cursor: pointer;
                height: 15px;
                width: 15px;
                margin: 0 2px;
                background-color: #bbb;
                border-radius: 50%;
                display: inline-block;
                transition: background-color 0.6s ease;
              }

              /* On smaller screens, decrease text size */
              @media only screen and (max-width: 300px) {

                .prev,
                .next,
                .text {
                  font-size: 11px
                }
              }
            </style>

            <div class="slideshow-container">
              <?php
              $query = "SELECT * FROM blog ORDER BY id DESC LIMIT 5";
              $result = mysqli_query($conn, $query);
              while ($row = mysqli_fetch_array($result)) {
                $id  = $row['id'];
                $topic  = $row['topic'];
                $content  = $row['content'];
                $image  = $row['image'];
                $created_at  = $row['created_at'];
                echo "<div class='mySlides'>
                <div class='numbertext'>1 / 3</div>
                <img src='$image' style='width:100%'>
                <div class='text' style='color: black'>$topic</div>
              </div>";
              }
              ?>
              <a class="prev" onclick="plusSlides(-1)">❮</a>
              <a class="next" onclick="plusSlides(1)">❯</a>

            </div>
            <br>

            <script>
              let slideIndex = 1;
              showSlides(slideIndex);

              // Next/previous controls
              function plusSlides(n) {
                showSlides(slideIndex += n);
              }

              // Thumbnail image controls
              function currentSlide(n) {
                showSlides(slideIndex = n);
              }

              function showSlides(n) {
                let i;
                let slides = document.getElementsByClassName("mySlides");
                let dots = document.getElementsByClassName("dot");
                if (n > slides.length) {
                  slideIndex = 1
                }
                if (n < 1) {
                  slideIndex = slides.length
                }
                for (i = 0; i < slides.length; i++) {
                  slides[i].style.display = "none";
                }
                for (i = 0; i < dots.length; i++) {
                  dots[i].className = dots[i].className.replace(" active", "");
                }
                slides[slideIndex - 1].style.display = "block";
                dots[slideIndex - 1].className += " active";
              }
            </script>
            <?php
            $query = "SELECT * FROM blog ORDER BY id DESC LIMIT 5";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($result)) {
              $id  = $row['id'];
              $topic  = $row['topic'];
              $content  = $row['content'];
              $image  = $row['image'];
              $created_at  = $row['created_at'];
              echo "<hr /><div class='row p-2'>
              <div class='col-md-8'>
                $topic
              </div>
              <div class='col-md-4'>
                <a href='blog.php?blog_id=$id'>Read More</a>
              </div>
            </div>";
            } ?>

          </div>
        </div>


        <div class="col-md-6">
          <div class="row">
            <div class="col-lg-12">
              <div class="section-title pb-20">
                <h1><i class="icofont icofont-film"></i> Trailers & Videos</h1>
              </div>
            </div>
          </div>
          <hr />
          <div class="row">
            <div class="col-md-12">
              <div class="slideshow-container">
                <?php
                $query = "SELECT * FROM trailer ORDER BY id DESC LIMIT 1";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_array($result)) {
                  $id  = $row['id'];
                  $topic  = $row['topic'];
                  $link  = $row['link'];
                  $image  = $row['image'];
                  $created_at  = $row['created_at'];
                  echo "<div class='video-area'>
                  <img src='$image' alt='img' width='100%' />
                  <a href='$link' class='popup-youtube'>
                    <i class='icofont icofont-ui-play'></i>
                  </a>
                  <div class='video-text'>
                    <h2>$topic</h2>
                  </div>
                </div> ";
                }
                ?>
                <!-- -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2 text-center">
          <div class="row">
            <div class="col-lg-12">
              <div class="section-title pb-20">
                <h1><i class="icofont icofont-coffee-cup"></i> For You</h1>
              </div>
            </div>
          </div>
          <hr />
          <br><br>
          <a class="btn btn-primary col-md-12" href="./watchlist.php"><i class="icofont icofont-ticket"></i> Your Watchlist</a><br><br>


          <form class="row" action='./searched.php?network=<?php echo $network = @$_POST['network']; ?>&&language=<?php echo $language = @$_POST['language']; ?>>' method='get'>
            <label for="" style="float: left;">
              <h4> Search By:-</h4>
            </label>
            <select name="network" class="form-control" id="">
              <option value="">All Platforms</option>
              <?php
              $query = "SELECT * FROM network_provider";
              $result = mysqli_query($conn, $query);
              while ($row = mysqli_fetch_array($result)) {
                $id  = $row['id'];
                $network_provider_id  = $row['network_provider_id'];
                $network_name  = $row['network_name'];
                $created_at  = $row['created_at'];
                echo "<option value='$network_provider_id'>$network_name</option>";
              }
              ?>
            </select><br><br>
            <select name="language" class="form-control" id="">
            <option value="">All Languages</option>
              <?php
              $settings = "SELECT * FROM settings";
              $result3 = mysqli_query($conn, $settings);
              while ($row = mysqli_fetch_array($result3)) {
                $languges  = $row['languges'];
                $language_code  = $row['language_code'];
                echo "<option value='$language_code'>$languges</option>";
              }
              ?>
            </select>
            <br><br>
            <input type="submit" class="btn btn-primary col-md-6" name="search" id="">
            <input type="reset" class="btn btn-secondary col-md-6" name="" id="">
          </form>
          <br><br>
          <span>Share on Social</span>
          <div class="login-social">
            <a href="#"><i class="icofont icofont-social-facebook"></i></a>
            <a href="#"><i class="icofont icofont-social-twitter"></i></a>
            <a href="#"><i class="icofont icofont-social-instagram"></i></a>
            <a href="#"><i class="icofont icofont-social-youtube"></i></a>
            <a href="#"><i class="icofont icofont-camera"></i></a>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
  <!-- hero area end -->
  <center>
    <section class="video ptb-90">
      <div class="col-md-10">
        <hr />
        <div class="row">
          <div class="col-md-12">
            <div class="video-slider mt-20">
              <!-- here -->
              <?php
              $query = "SELECT * FROM network_provider";
              $result = mysqli_query($conn, $query);
              while ($row = mysqli_fetch_array($result)) {
                $network_provider_id = $row['network_provider_id'];
                echo networks("$network_provider_id", "4a2ff1022de91af3d87295cf25c92b06");
              } ?>
            </div>
          </div>
        </div>
      </div>
      </div>
    </section>
    <center>
      <section class="video ptb-90">
        <div class="col-md-10">
          <div class="row">
            <div class="col-lg-12">
              <div class="section-title pb-20">
                <h1><i class="icofont icofont-movie"></i> Trending Movies</h1>
              </div>
            </div>
          </div>
          <hr />
          <div class="row">
            <div class="col-md-12">
              <div class="video-slider mt-20">
                <?php
                $add_to_watchlist = @$_POST['watchlist'];
                if (isset($_SESSION['email'])) {
                  $email_id = $_SESSION['email'];
                } else {
                  $email_id = "";
                };
                $movie_id = @$_POST['movie_id'];
                $created_at = date("Y-m-d");
                if ($add_to_watchlist) {
                  $add_to_watchlist_query = "INSERT INTO `watch_list`(`id`, `email`, `movie_id`, `created_at`) VALUES (NULL,'$email_id', '$movie_id','$created_at')";
                  $result_add_to_watchlist = mysqli_query($conn, $add_to_watchlist_query);
                  if ($result_add_to_watchlist) {
                    echo "<script>
                            $(document).ready(function() {
                                document.getElementById('notification-success-watchlist').click()
                            });
                        </script>";
                    echo "<meta http-equiv=\"refresh\" content=\"3; url=index.php\">";
                  }
                }

                foreach ($data2['results'] as $result) {
                  $id = $result['id'];
                  $network == 'netflix' ? $orignal_title = $result['original_title'] : $orignal_title = $result['original_title'];
                  $network == 'netflix' ? $overview = $result['overview'] : $overview = $result['overview'];
                  $network == 'netflix' ? $poster_path = $result['poster_path'] : $poster_path = $result['poster_path'];
                  $network == 'netflix' ? $backdrop_path = $result['backdrop_path'] : $backdrop_path = $result['backdrop_path'];
                  $network == 'netflix' ? $release_date = $result['release_date'] : $release_date = $result['release_date'];
                  $network == 'netflix' ? $vote_count = $result['vote_count'] : $vote_count = $result['vote_count'];
                  $network == 'netflix' ? $final_poster = 'https://image.tmdb.org/t/p/w500/' . $poster_path : $final_poster = 'https://image.tmdb.org/t/p/w500/' . $poster_path;
                  echo "<div class='single-portfolio'>
                <a href='movie_details.php?id=$id'><div class='single-portfolio-img'>
                  <img src='$final_poster' alt='portfolio' />
                </div>
                <div class='portfolio-content'>
                <br>
                  <h4>$orignal_title</h4>
                  <div class='review'>
                    <h6>$vote_count voters</h6>
                  </div>";
                  if (isset($_SESSION['email'])) {
                    echo "<br>
                  <form action='./index.php' method='post'>
                  <input type='hidden' value='$id' name='movie_id' />
                <input type='submit' value='+ Add To Watchlist' name='watchlist' class='btn btn-primary'>
              </form>";
                  }
                  echo "
                </div></a>
              </div>";
                }
                ?>

              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- video section end -->
    </center>
    <!-- hero area end -->
    <!-- hero area end -->
    <center>
      <section class="video ptb-90">
        <div class="col-md-10">
          <div class="row">
            <div class="col-lg-12">
              <div class="section-title pb-20">
                <h1><i class="icofont icofont-movie"></i> Top Rated Movies</h1>
              </div>
            </div>
          </div>
          <hr />
          <div class="row">
            <div class="col-md-12">
              <div class="video-slider mt-20">
                <?php
                foreach ($data['results'] as $result) {
                  $id = $result['id'];
                  $network == 'netflix' ? $orignal_title = $result['original_title'] : $orignal_title = $result['original_title'];
                  $network == 'netflix' ? $overview = $result['overview'] : $overview = $result['overview'];
                  $network == 'netflix' ? $poster_path = $result['poster_path'] : $poster_path = $result['poster_path'];
                  $network == 'netflix' ? $backdrop_path = $result['backdrop_path'] : $backdrop_path = $result['backdrop_path'];
                  $network == 'netflix' ? $release_date = $result['release_date'] : $release_date = $result['release_date'];
                  $network == 'netflix' ? $vote_count = $result['vote_count'] : $vote_count = $result['vote_count'];
                  $network == 'netflix' ? $final_poster = 'https://image.tmdb.org/t/p/w500/' . $poster_path : $final_poster = 'https://image.tmdb.org/t/p/w500/' . $poster_path;
                  echo "<div class='single-portfolio'>
                <a href='movie_details.php?id=$id'>
                <div class='single-portfolio'>
                <div class='single-portfolio-img'>
                  <img src='$final_poster' alt='portfolio' />
                </div><br>
                <div class='portfolio-content'>
                  <h4>$orignal_title</h4>
                  <div class='review'>
                    <h6>$vote_count voters</h6>
                  </div>";
                  if (isset($_SESSION['email'])) {
                    echo "<br>
                    <form action='./index.php' method='post'>
                    <input type='hidden' value='$id' name='movie_id' />
                  <input type='submit' value='+ Add To Watchlist' name='watchlist' class='btn btn-primary'>
                </form>";
                  }
                  echo "
                  </div></a></div>
                </div>";
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- video section end -->
    </center>
    <!-- video section start -->
    <section class="video ptb-90">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="section-title pb-20">
              <h1><i class="icofont icofont-film"></i> Trailers & Videos</h1>
            </div>
          </div>
        </div>
        <hr />
        <div class="row">
          <div class="col-md-9">
            <div class="video-area">
              <div class="slideshow-container">
                <?php
                $query = "SELECT * FROM trailer ORDER BY id DESC LIMIT 1";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_array($result)) {
                  $id  = $row['id'];
                  $topic  = $row['topic'];
                  $link  = $row['link'];
                  $image  = $row['image'];
                  $created_at  = $row['created_at'];
                  echo "
                  <img src='$image' alt='img' width='100%' />
                  <a href='$link' class='popup-youtube'>
                    <i class='icofont icofont-ui-play'></i>
                  </a>
                  <div class='video-text'>
                    <h2>$topic</h2>
                </div> ";
                }
                ?>
                <!-- -->
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="row">
              <div class="col-md-12 col-sm-6">
                <div class="slideshow-container">
                  <?php
                  $query = "SELECT * FROM trailer ORDER BY id DESC LIMIT 3 OFFSET 1";
                  $result = mysqli_query($conn, $query);
                  while ($row = mysqli_fetch_array($result)) {
                    $id  = $row['id'];
                    $topic  = $row['topic'];
                    $link  = $row['link'];
                    $image  = $row['image'];
                    $created_at  = $row['created_at'];
                    echo "<div class='video-area'>
                  <img src='$image' alt='img' width='100%' />
                  <a href='$link' class='popup-youtube'>
                    <i class='icofont icofont-ui-play'></i>
                  </a>
                </div> ";
                  }
                  ?>
                  <!-- -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- video section end -->
    <?php include('./components/footer.php') ?>