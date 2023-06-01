<?php
$api_key = "4a2ff1022de91af3d87295cf25c92b06";
$last_year = date("Y");
$recent_year = date("Y");
$network = @$_GET['network'];
if ($network) {
    $data = file_get_contents("https://api.themoviedb.org/3/movie/top_rated?primary_release_year=$recent_year&api_key=$api_key&language=en-US");
    echo $data = json_decode($data, true);
    $data2 = file_get_contents("https://api.themoviedb.org/3/discover/movie?with_networks=$network&api_key=$api_key");
    echo $data2 = json_decode($data2, true);

    foreach ($data2['results'] as $result) {
        $orignal_title = $result['original_title'];
        $overview = $result['overview'];
        $poster_path = $result['poster_path'];
        $backdrop_path = $result['backdrop_path'];
        $final_poster = 'https://image.tmdb.org/t/p/w500/' . $poster_path;
        $final_backdrop = 'https://image.tmdb.org/t/p/w500/' . $backdrop_path;
    }
} else if ($network == '') {
    $query = urlencode("trending");
    $data = file_get_contents("https://api.themoviedb.org/3/movie/top_rated?api_key=$api_key&language=in");
    $data2 = file_get_contents("https://api.themoviedb.org/3/$query/movie/day?api_key=$api_key");
    $data = json_decode($data, true);
    $data2 = json_decode($data2, true);


    foreach ($data2['results'] as $result) {
        $orignal_title = $result['original_title'];
        $overview = $result['overview'];
        $poster_path = $result['poster_path'];
        $backdrop_path = $result['backdrop_path'];
        $final_poster = 'https://image.tmdb.org/t/p/w500/' . $poster_path;
        $final_backdrop = 'https://image.tmdb.org/t/p/w500/' . $backdrop_path;
    }
}
