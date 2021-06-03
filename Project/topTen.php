<!DOCTYPE html>

<html>
<head>
    <title>Top 10</title>
</head>

<body>
    <h1>Top 10 Rated Films</h1>

    <div>
        <ul>
            <li>
                <a href="index.php">Search</a>
                <a href="topTen.php">Top 10</a>
            </li>
        </ul>
    </div>

    <?php

    /**
     * File doc Comment
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
    require "connection.php";
    require "header.php";

    echo "<br><br>";
    $array = array();
    $initialTitleArray = array();

    $sqlArrayValues = "SELECT * FROM movies
                            ORDER BY Searched DESC LIMIT 10";
    $result = mysqli_query($conn, $sqlArrayValues);

    while ($row = mysqli_fetch_array($result)) {
        $array[] = $row['Searched'];
        $initialTitleArray[] = $row['Title'];
    }

    for ($i = 1; $i <= 10; $i++) {
        $secondArray[$i] = $array[$i - 1];
        $titleArray[$i] = $initialTitleArray[$i - 1];
    }

    while ($row = mysqli_fetch_array($result)) {
        $array[] = $row['Searched'];
    }

    $numcolumns = count($secondArray);
    $height = 500;
    $width = 500;
    $padding = 5;

    //     /*
    // * Print grid lines bottom up
    // */

    $columnWidth = $width / $numcolumns;
    $maxValue = max($secondArray);
    $image = imagecreate($width, $height);
    $white = imagecolorallocate($image, 0xff, 0xff, 0xff);
    $lightGrey = imagecolorallocate($image, 0xee, 0xee, 0xee);
    $darkGrey = imagecolorallocate($image, 0x7f, 0x7f, 0x7f);
    imagefilledrectangle($image, 0, 0, $width, $height, $white);

    $red = imagecolorallocate($image, 255, 0, 0);
    $green = imagecolorallocate($image, 0, 255, 0);
    $blue = imagecolorallocate($image, 0, 0, 255);
    $purple = imagecolorallocate($image, 148, 0, 211);
    $orange = imagecolorallocate($image, 255, 128, 0);
    $yellow = imagecolorallocate($image, 255, 255, 0);
    $brown = imagecolorallocate($image, 139, 69, 19);
    $pink = imagecolorallocate($image, 255, 192, 203);
    $lightgrey = imagecolorallocate($image, 170, 170, 170);
    $darkgrey = imagecolorallocate($image, 25, 25, 25);
    $colorArray = array();
    $colorArray[1] = $red;
    $colorArray[2] = $green;
    $colorArray[3] = $blue;
    $colorArray[4] = $purple;
    $colorArray[5] = $orange;
    $colorArray[6] = $yellow;
    $colorArray[7] = $brown;
    $colorArray[8] = $pink;
    $colorArray[9] = $lightgrey;
    $colorArray[10] = $darkgrey;

    for ($i = 1; $i <= $numcolumns; $i++) {
        $columnHeight = ($height / 100) * (($secondArray[$i] / $maxValue) * 100);
        $x1 = ($i * $columnWidth) - $columnWidth;
        $y1 = $height - $columnHeight;
        $x2 = (($i + 1) * $columnWidth) - $padding - $columnWidth;
        $y2 = $height;
        imagefilledrectangle($image, $x1, $y1, $x2, $y2, $colorArray[$i]);
        imageline($image, $x1, $y1, $x1, $y2, $lightGrey);
        imageline($image, $x1, $y2, $x2, $y2, $lightGrey);
        imageline($image, $x2, $y1, $x2, $y2, $darkGrey);
    }

    imagepng($image, "image.png");

    $numberImageHeight = 50;
    $numberImage = imagecreate($width, $numberImageHeight);
    $backgroundColor = imagecolorallocate($numberImage, 255, 255, 255);
    $textColor = imagecolorallocate($numberImage, 0, 0, 0);
    for ($i = 1; $i <= $numcolumns; $i++) {
        $x = ($i * $columnWidth) - $columnWidth;
        imagestring($numberImage, 5, $x + 15, 1, $secondArray[$i], $textColor);
    }
    imagepng($numberImage, "numbers.png");
    ?>
    <img src='image.png'>
    <br>
    <img src='numbers.png'>
    <br>
    <?php
    echo "<table>
            <tr><th>COLOR</th><th>TITLE</th></tr>
            <tr><td style='background-color: red'>
            </td><td>$titleArray[1]</td></tr>
            <tr><td style='background-color: blue'>
            </td><td>$titleArray[2]</td></tr>
            <tr><td style='background-color: orange'>
            </td><td>$titleArray[3]</td></tr>
            <tr><td style='background-color: black'>
            </td><td>$titleArray[4]</td></tr>
            <tr><td style='background-color: pink'>
            </td><td>$titleArray[5]</td></tr>
            <tr><td style='background-color: limegreen'>
            </td><td>$titleArray[6]</td></tr>
            <tr><td style='background-color: saddlebrown'>
            </td><td>$titleArray[7]</td></tr>
            <tr><td style='background-color: yellow'></td>
            <td>$titleArray[8]</td></tr>
            <tr><td style='background-color: purple'></td>
            <td>$titleArray[9]</td></tr>
            <tr><td style='background-color: darkgray'></td>
            <td>$titleArray[10]</td></tr>
        </table>";

        require "footer.php";
    ?>

</body>

</html>