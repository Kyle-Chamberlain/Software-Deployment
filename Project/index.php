<!DOCTYPE html>

<html>


<head>
    <title>Search Films</title>
</head>

<body>
    <h1>Search For Films</h1>
    <div>
        <ul>
            <li>
                <a href="index.php">Search</a>
                <a href="topTen.php">Top 10</a>
            </li>
        </ul>
    </div>
    <div>
        <br>
        <form action="index.php" method="post"><br>
            <label for="year_id">Title:</label><br>
            <input type="text" name="tit_id"><br>

            <label for="gen_id">Genre:</label>
            <select class="form-control" name="gen_id">
                <option value=""></option>
                <option value="Comedy">Comedy</option>
                <option value="SciFi">SciFi</option>
                <option value="Drama<">Drama</option>
                <option value="Mystery/Suspense<">Mystery/Suspense</option>
                <option value="Action/Adventure">Action/Adventure</option>
                <option value="Family">Family</option>
                <option value="VAR">VAR</option>
                <option value="Music">Music</option>
                <option value="Animation">Animation</option>
                <option value="Musical">Musical</option>
                <option value="Horror">Horror</option>
                <option value="Documentary">Documentary</option>
                <option value="Western">Western</option>
                <option value="TV Classics">TV Classics</option>
                <option value="Adventure">Adventure</option>
                <option value="Thriller">Thriller</option>
                <option value="Ballet">Ballet</option>
                <option value="Classics">Classics</option>
                <option value="Foreign">Foreign</option>
                <option value="Dance / Ballet">Dance / Ballet</option>
                <option value="Opera">Opera</option>
                <option value="Comedy/Drama">Comedy/Drama</option>
                <option value="Action/Comedy">Action/Comedy</option>
                <option value="Fantasy">Fantasy</option>
                <option value="Special Interest">Special Interest</option>
                <option value="Late Night">Late Night</option>
                <option value="Other">Other</option>
                <option value="Anime">Anime</option>
                <option value="War">War</option>
                <option value="Satire">Satire</option>
                <option value="Suspense/Thriller">Suspense/Thriller</option>
            </select>

            <label for="rat_id">Rating:</label>
            <select class="form-control" name="rat_id">
                <option value=""></option>
                <option value="R">R</option>
                <option value="NR">NR</option>
                <option value="G">G</option>
                <option value="PG">PG</option>
                <option value="PG-13">PG-13</option>
                <option value="VAR">VAR</option>
                <option value="NC-17">NC-17</option>
                <option value="UNK">UNK</option>
                <option value="UR">UR</option>
                <option value="R/NR">R/NR</option>
                <option value="UR/R">UR/R</option>
                <option value="R/UR">R/UR</option>
            </select>
            <label for="year_id">Year:</label><br>
            <input type="text" name="year_id"><br>
            <input type="submit" name="submit"><br>
        </form>
    </div>
    <?php

    /**
     * File doc comment 
     * 
     * PHP version 4
     * 
     * @category   Components
     * @package    WordPress
     * @subpackage Theme_Name_Here
     * @author     Kyle Chamberlain <P454666@tafe.wa.edu.au>
     * @license    https://www.gau.org/licence/gpl-3.0.txt GNU/GPLv3
     * @link       https://yoursite.com
     * @since      1.0.0
     */

    require "header.php"; 
    require "connection.php";
    if (isset($_POST["submit"])) {

        $title = $_POST["tit_id"];
        $genre = $_POST["gen_id"];
        $rating = $_POST["rat_id"];
        $year = $_POST["year_id"];

        $searchCounter = "UPDATE movies
                SET Searched = Searched + 1
                WHERE Title LIKE '%$title%'";

        switch ($_POST["rat_id"]) {
        case "R":
            $displaySearch = "SELECT * 
                    FROM movies 
                    WHERE Title LIKE '%$title%' 
                    AND Genre LIKE '%$genre%' 
                    AND Year LIKE '%$year%'
                    AND Rating LIKE 'R';";
            break;
        case "G":
            $displaySearch = "SELECT * 
                    FROM movies 
                    WHERE Title LIKE '%$title%' 
                    AND Genre LIKE '%$genre%' 
                    AND Year LIKE '%$year%'
                    AND Rating LIKE 'G';";
            break;
        case "PG":
            $displaySearch = "SELECT * 
                    FROM movies 
                    WHERE Title LIKE '%$title%' 
                    AND Genre LIKE '%$genre%' 
                    AND Year LIKE '%$year%'
                    AND Rating LIKE 'PG';";
            break;
        default:
            $displaySearch = "SELECT * 
                    FROM movies 
                    WHERE Title LIKE '%$title%' 
                    AND Genre LIKE '%$genre%'
                    AND Year LIKE '%$year%'
                    AND Rating LIKE '%$rating%';";
            break;
        }
        $result = $conn->query($displaySearch);
        include "searchedMoviesTable.php";

        $conn->query($searchCounter);
        $conn->close();
    }
    require "footer.php";
    ?>
</body>

</html>