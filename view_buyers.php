<?php // view the buyers

$page_title = 'View the current Buyers';
include ('includes/header.php');
echo '<h1>Registered Buyers</h1>';
require_once ('includes/mysqli_oop_connect.php');


// number of records per page to be shown
$display = 10;


// determine how many pages there are
// 
// if p is set, use it
if (isset($_GEt['p']) && is_numeric ($_GET['p'])) {
	$pages = $_GET['p'];
	
} else { // if not, need to determine how many pages
// count the number of records of buyers
	$q = "SELECT COUNT(buyer_id) FROM buyers";
	$r = $mysqli->query($q); // run the query
	$row = @mysqli_fetch_array ($r, MYSQLI_NUM);
	$records = $row[0];
	
	// Calculate number of pages
	if ($records > $display) { // more than 1 page
		$pages = ceil ($records/$display);
		} else {
			$pages = 1;	
		}
		
} // end of p IF
// 
//  Determine where in the database to start returning results
if (isset($_GET['s']) && is_numeric ($_GET['s'])) {
	$start = $_GET['s'];
	
} else {
	$start = 0;
}

// determine the sort...
// default by add buyer date
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'abd';

// determine the sorting order
switch ($sort) {
	case 'bln':
		$order_by = 'buyer_last_name ASC';
		break;
	case 'bfn':
		$order_by = 'buyer_first_name ASC';
		break;
	case 'abd':
		$order_by = 'add_buyer_date ASC';
		break;
	default:
		$order_by = 'add_buyer_date ASC';
		$sort = 'abd';
		break;
}

// define the query
$q = "SELECT buyer_last_name, buyer_first_name, DATE_FORMAT(add_buyer_date, '%M %d, %Y') AS abd, buyer_id FROM buyers ORDER BY $order_by LIMIT $start, $display";
$r = $mysqli->query($q);

// Table header
echo '<table align="center" cellspacing="0" cellpadding="5" width="75%">
<tr>
	<td align="left"><b>Edit</b></td>
	<td align="left"><b>Delete</b></td>
	<td align="left"><b><a href="view_buyers.php?sort=bln">Last Name</a></b></td>
	<td align="left"><b><a href="view_buyers.php?sort=bfn">First Name</a></b></td>
	<td align="left"><b><a href="view_buyers.php?sort=abd">Date Buyer Added</a></b></td>
</tr>
';

//fetch and print records
$bg = '#eeeeee'; //set the initial background color

while ($row = $row = $r->fetch_object()) {
	
	$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee'); //Switch the background color
	
	echo '<tr bgcolor="' . $bg . '">
		<td align="left"><a href="edit_buyer.php?id=' . $row->buyer_id . '">Edit</a></td>
		<td align="left"><a href="delete_buyer.php?id=' . $row->buyer_id . '">Delete</a></td>
		<td align="left">' . $row->buyer_last_name . '</td>
		<td align="left">' . $row->buyer_first_name . '</td>
		<td align="left">' . $row->abd . '</td>
	</tr>
';


} // end of WHILE loop

echo '</table>';
$r->free(); // free up memory


$mysqli->close();
unset($mysqli);

// make links to other pages, if required
	if ($pages > 1) {
		
		// ad some spacing 
		echo '<br /><p>';
		
		// Determine what page the script is
	 	$current_pages = ($start/$display) + 1;
	
	// if it's not the first page, make a previous link:
	if ($current_page != 1) {
		echo '<a href="view_buyers.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort .  '">Previous</a> ';
	}
	
	// make numbered pages
	for ($i = 1; $i <= $pages; $i++) {
		if ($i != $current_page) {
			echo '<a href="view_buyers.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
			
		} else {
			echo $i . ' ';
		}
	}  // end of FOR loop
	
	// if not the last page, make next button
	if ($current_pages != $pages) {
		echo '<a href="view_buyers.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
	} 
	
	echo '</p>'; // closing the paragraph
	
} // end of links section
	
	include ('includes/footer.php');

?>