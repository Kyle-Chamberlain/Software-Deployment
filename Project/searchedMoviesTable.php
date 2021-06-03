<?php  
 
/**
 * File Doc Comment
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

if ($result->num_rows > 0) {
    echo '<table class="table table-striped">';
    echo "<tr><th>Title</th><th>Rating</th>
    <th>Year</th><th>Genre</th></tr>";

    while ($row = $result->fetch_assoc()) {
        $tit = $row["Title"];
        $rat = $row["Rating"];
        $yr = $row["Year"];
        $gen = $row["Genre"];
        

        echo "<tr><td>".$tit."</td>
            <td>".$rat."</td><td>".$yr."</td>
            <td>".$gen."</td></tr>";
    }
    echo "</table>";
} else {
    echo "No results found for this search.";
}
