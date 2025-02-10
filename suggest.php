<?php
// Sample data (you can replace this with your own data source)
$keywords = array("Audi", "BMW", "AUDI Q8", "Nissan", "Toyota", "Toyota Fortuner", "Maruti", "Maruti , Maruti Suzuki Wagon R");

// Get the keyword entered by the user
$query = $_POST['query'];

// Search for matches
$matches = array();
if($query !== ''){
    foreach($keywords as $keyword){
        if(stripos($keyword, $query) !== false){
            $matches[] = $keyword;
        }
    }
}

// Display suggestions
if(!empty($matches)){
    foreach($matches as $match){
        echo "<p>" . $match . "</p>";
    }
} else {
    echo "<p>No suggestions found.</p>";
}
?>
