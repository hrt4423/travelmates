// get_travel_titles.php
<?php
namespace travel_mates;
require_once('travel.php');

header('Content-Type: application/json');

$travel = new Travel();
$titles = $travel->getAllTravelTitles(); // 新しいメソッドを作成
echo json_encode($titles);
?>
