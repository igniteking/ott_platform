<?php
$api_key = "4a2ff1022de91af3d87295cf25c92b06";
$query = urlencode("trending");
$data = file_get_contents("https://api.themoviedb.org/3/movie/top_rated?api_key=$api_key&language=en-US&page=1");

$data = json_decode($data, true);
// print_r($data);

foreach ($data['results'] as $result) {
	echo $orignal_title = $result['original_title']."<br>";
	echo $overview = $result['overview']."<br><br>";
	echo $poster_path = $result['poster_path'];
}
?>