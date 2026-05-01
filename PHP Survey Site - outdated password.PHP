<!doctype html>
<html lang="en">
      <head>
            <meta charset="utf-8">
            <title>Assessment</title>
            <meta name="description" content="Selecting, inserting, updating and deleting using a single PHP page - Assignment">
            <meta name="Damien" content="my name">
      </head>
      <body background="https://t4.ftcdn.net/jpg/04/92/22/93/360_F_492229389_5ve1bCKgYrLRHpCj3o4FAzz60efaZgG0.jpg">
            <!-- just a black image background -->
            <img src="https://cdn.prod.website-files.com/659a9ef71c962485037fcc8f/66854aece1e4d28d5a361380_X%20box%20logo.png" alt="Comp" style="float:right;width:150px;height:111px;">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTJ9CWTfVX60RjWstHQf4wgTZaifFdaI9uJyg&s" alt="Comp" style="float:right;width:150px;height:111px;">
            <div class="wrapper">
                  <h1 style="font-family: Arial, sans-serif; font-size: 32px; font-weight: bold; color: #ff003b;">GAMING SURVEY 👾</h1>
            </div>
            <style> .responsive-box { padding: 15vw; background-color: lightyellow; } </style>
            <div class="mb-4">
                  <h2 style="color:#00cdff">Time Spent Playing Games</h2>
                  <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/0d/Nintendo.svg/1200px-Nintendo.svg.png" alt="Comp" style="float:right;width:150px;height:111px;">
                  <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTj9-l2sscifSqt7GExflrZbfxMmwoNoT3sFw&s" alt="Comp" style="float:right;width:150px;height:111px;">
                  <h3 style="color:#ff003b">Hours per Week 🎮</h3>
                  <!-- checkbox for users (written in html not php so it isn't saved -->
                  <div class="grid md:grid-cols-2 gap-2">
                        <label class="game-option flex items-center p-3 rounded-lg border">
                              <input type="checkbox" name="genres[]" value="action" class="mr-3 text-blue-600">
                              <span style="color:#ff003b">0-5</span>
                        </label>
                        <label class="game-option flex items-center p-3 rounded-lg border">
                              <input type="checkbox" name="genres[]" value="adventure" class="mr-3 text-blue-600">
                              <span style="color:#00cdff">6-10</span>
                        </label>
                        <label class="game-option flex items-center p-3 rounded-lg border">
                              <input type="checkbox" name="genres[]" value="rpg" class="mr-3 text-blue-600">
                              <span style="color:#ff003b">11-15</span>
                        </label>
                        <label class="game-option flex items-center p-3 rounded-lg border">
                              <input type="checkbox" name="genres[]" value="strategy" class="mr-3 text-blue-600">
                              <span style="color:#00cdff">16-20</span>
                        </label>
                        <label class="game-option flex items-center p-3 rounded-lg border">
                              <input type="checkbox" name="genres[]" value="sports" class="mr-3 text-blue-600">
                              <span style="color:#ff003b">21-25<span>
                                    </label>
                                    <label class="game-option flex items-center p-3 rounded-lg border">
                                          <input type="checkbox" name="genres[]" value="puzzle" class="mr-3 text-blue-600">
                                          <span style="color:#00cdff">25+</span>
                                    </label>
                                    </div>
                              <h2 style="color:#00cdff">Personal Info 👤</h2>
                              <!-- php survey that IS saved to "phpmyadmin" (below) -->
                              <?php
                              $id = 'ID';
                              $FavouriteGame = 'FavouriteGame';
                              $GameGenre = 'GameGenre';
                              $Username = 'Username';
                              $conn = new mysqli("localhost","dtinn2","Bellbird25","dtinn2_Assignment") or die(mysqli_error($conn));
                              if (isset($_POST["update"])) {
                                    $id = $_POST["id"];
                                    $FavouriteGame = $_POST["FavouriteGame"];
                                                                          $GameGenre = $_POST["GameGenre"];
                                                                          $Username = $_POST["Username"];
                                                                          if ($id == 'new') {
                                                                                $query = mysqli_query($conn, "INSERT INTO GameSurvey (FavouriteGame, GameGenre, Username) VALUES ('$FavouriteGame', '$GameGenre', '$Username')") or die(mysqli_error($conn));
                                                                                                       $id = $conn->insert_id;
                                                                                                      }
                                    else {
                                          $query = mysqli_query($conn, "UPDATE GameSurvey SET FavouriteGame='$FavouriteGame', GameGenre='$GameGenre', Username='$Username' WHERE ID=$id") or die(mysqli_error($conn));
                                          }
                              }
                              if (isset($_POST["delete"]) && $_POST["id"] != 'new') {
                                    $id = $_POST["id"];
                                    $query = mysqli_query($conn, "DELETE FROM GameSurvey WHERE ID = $id") or die(mysqli_error($conn));
                                    $id = 'new';
                              }
                              if (isset($_POST["id"]) && $_POST["id"] != 'new') { $id = $_POST["id"];
                                                                                                         $query = mysqli_query($conn, "SELECT * FROM GameSurvey WHERE ID = $id") or die(mysqli_error($conn));
                                                                                                         while ($row = mysqli_fetch_array($query)) {
                                                                                                               $FavouriteGame = $row["FavouriteGame"];
                                                                                                               $GameGenre = $row["GameGenre"];
                                                                                                               $Username = $row["Username"];
                                                                                                         }
                                                                                                        }
                              echo '<form name="GameSurvey" action="'.htmlentities($_SERVER['PHP_SELF']).'" method="post">';
                              echo '<select name="id" onchange="this.form.submit()">'; echo '<option value="new">New</option>';
                              $query = mysqli_query($conn, "SELECT ID FROM GameSurvey ORDER BY ID ASC") or die(mysqli_error($conn)); $selected = '';
                              while ($row = mysqli_fetch_array($query)) {
                                    $val = $row["ID"];
                                    if ($id == $val) {
                                          $selected = ' selected';
                                    } else {
                                          $selected = '';
                                    }
                                    echo '<option value="'.$val.'"'.$selected.'>'.$val.'</option>';
                              }
                              echo '</select>';
                              echo '<input style="color: #00cdff;" type="text" name="FavouriteGame" value="'.$FavouriteGame.'">';
                              echo '<input style="color: #ff003b;" type="text" name="GameGenre" value="'.$GameGenre.'">';
                              echo '<input style="color: #00cdff;" type="text" name="Username" value="'.$Username.'">';
                              echo '<input type="submit" name="update" value="Save">';
                              echo '<input type="submit" name="delete" value="Delete">';
                              echo '</form>';
                              ?>
                              <select name="period">
                              <!-- gives the user different options to choose from (html not php so it won't be saved) -->
                              <option value= "n/a">Device</option>
                              <option value= "D1">PC</option>
                              <option value= "D2">Xbox</option>
                              <option value= "D3">PS</option> <option value= "D4">Other</option>
                              </select>
                              <!-- feedback box for users (doesn't get saved unfortunately) -->
                              <h3 style="color:#ff003b">🎯 User Feedback: </h3>
                              <textarea name = "comments" rows = "4" cols = "40">
                              </textarea>
                              </body>
                        </html>
