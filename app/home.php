<?php
  session_start();
  if(empty($_SESSION['user_id'])) {
    header("location: ./user_register.php");
  }
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ホーム画面</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./styles/home.css">
</head>

<body>
  <header class="header d-flex justify-content-between align-items-center">
    <a href="./home.php" class="nav-item">
      <img src="./assets/logo.png" alt="Site Logo" class="site-logo">
    </a>
    <nav class="nav">
      <div class="nav-item">
        <a href="./mypage.php">
          <img src="./assets/image/user_icon.svg" alt="User Icon" class="icon">
        </a>
      </div>

      <div class="nav-item">
        <a href="#">
          <img src="./assets/image/notification.svg" alt="Notification Icon" class="icon">
        </a>
      </div>
    </nav>
  </header>
  <?php echo("ユーザーID：".$_SESSION['user_id']."<br>"); ?>
  <a href="./Create_new.php" class="btn btn-primary">新規作成</a>
  <hr>
  <?php
    require_once('dao/travel.php');
    require_once('dao/member.php');
    $travel = new Travel();
    $member = new Member();
    $travel_id_list = $member->searchTravelIdListByUserId($_SESSION['user_id']);

    foreach($travel_id_list as $travel_id) {
      $travel_data = $travel->findTravelByTravelId($travel_id);
      echo("ID:".$travel_data['travel_id']."<br>");
      echo("タイトル：".$travel_data['title']."<br>");
      echo("作成者ID：".$travel_data['management_id']."<br>");
      echo('<a href="./travel_plan.php?travel_id='.$travel_id.'">編集</a>');
      echo("<hr>");
    }
  ?>

    

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="./scripts/home.js"></script>
  <script src="./scripts/header.js"></script>
</body>

</html>