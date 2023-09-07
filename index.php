<?php
declare(strict_types=1);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "news";

function db_connect(): object
{
    global $servername;
    global $username;
    global $password;
    global $dbname;

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Fout bij het maken van de connection: " . $e->getMessage();
    }
}

// Call the db_connect() function to establish a database connection
$conn = db_connect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
  <script defer src="script.js"></script>
</head>
<title>BiroGeek - News</title>
<body>
  <header class="page_header">
    <figure>
      <img class="page_header_image" src="bootstrap-logo-shadow.png">
    </figure>
    <ul class="page_header_list">
      <li class="page_header_button">TEST</li>
      <li class="page_header_button">TEST</li>
      <li class="page_header_button">TEST</li>
      <li class="page_header_button">TEST</li>
    </ul>
  </header>
   <div class="page__content">
        <?php
        // Assuming you have a "news" table with columns ImageID and TitleID
        $sql = "SELECT ImageID, TitleID FROM news";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $imageID = $row['ImageID'];
            $titleID = $row['TitleID'];

            echo '<section class="page__content-news">';
            echo '<article class="page__content-article">';
            echo '<img class="page__content-images" src="' . $imageID . '" alt="">';
            echo '<p class="page__content-text">' . $titleID . '</p>';
            echo '</article>';
            echo '</section>';
        }
        ?>
    </div>
  <button class="button_search"></button>
</body>
</html>