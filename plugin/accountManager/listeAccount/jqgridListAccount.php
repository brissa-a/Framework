<?php

global $em;
$qb = $em -> createQueryBuilder();

$page = $_POST['page'];
$limit = $_POST['rows'];
$sidx = $_POST['sidx'];
$sord = $_POST['sord'];

if (!$sidx)
	$sidx = 1;
$qb -> select('COUNT(u)') -> from('Member', 'u');
$count = $qb -> getQuery() -> getSingleScalarResult();

// calculate the total pages for the query
if ($count > 0 && $limit > 0) {
	$total_pages = ceil($count / $limit);
} else {
	$total_pages = 0;
}

// if for some reasons the requested page is greater than the total
// set the requested page to total page
if ($page > $total_pages)
	$page = $total_pages;

// calculate the starting position of the rows
$start = $limit * $page - $limit;

// if for some reasons start position is negative set it to 0
// typical case is that the user type 0 for the requested page
if ($start < 0)
	$start = 0;

// the actual query for the grid data
$qb = $em -> createQueryBuilder();
$qb -> select('u') -> from('Member', 'u') -> orderBy("u.$sidx", $sord);
try {
$listeMembre = $qb -> getQuery() -> setFirstResult($start) -> setMaxResults($limit) -> getResult();
// we should set the appropriate header information. Do not forget this.
header("Content-type: text/xml;charset=utf-8");

$s = "<?xml version='1.0' encoding='utf-8'?>";
$s .= "<rows>";
$s .= "<page>" . $page . "</page>";
$s .= "<total>" . $total_pages . "</total>";
$s .= "<records>" . $count . "</records>";

// be sure to put text data in CDATA
foreach ($listeMembre as $member) {
	$s .= "<row id='" . $member -> getId() . "'>";
	$s .= "<cell>" . $member -> getFamilyName() . "</cell>";
	$s .= "<cell>" . $member -> getFirstName() . "</cell>";
	$s .= "<cell>" . $member -> getContact() -> getEmail() . "</cell>";
	$s .= "<cell>" . $member -> getSubscribeDate() -> format('d/m/Y'). "</cell>";
	$s .= "</row>";
}
$s .= "</rows>";

echo $s;

} catch (exception $e) {
	echo $e->getMessage();
}

?>