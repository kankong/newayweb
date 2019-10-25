<?php
include "model/mysqlpdoconn.php";
if(isset($_GET['product']) && isset($_GET['cat'])){
    $cat = $_GET['cat'];
    $adv = getadvantages($cat);
    echo $adv;
}else if(isset($_GET['page']) && isset($_GET['cat'])){
    $cat = $_GET['cat'];
    $pages =  getpages( $cat );
    echo "<button>$pages</button>";
}else if(isset($_GET['pageno']) && isset($_GET['cat'])){
   $cat = $_GET['cat'];
    $pageno = $_GET['pageno'];
    echo  getpictures($cat, $pageno);
}else if(isset($_GET['cat']) && $_GET['cat'] != ""){
    $cat = $_GET['cat'];
    $desc = getdesc($cat);
    echo $desc;
    //echo $cat;
}


function getdesc($Catname){
  global $conn;
  $sql="SELECT * FROM Tiles WHERE category='$Catname'";
  $stmt = $conn->query($sql);
  //$result = $stmt->fetchAll(PDO::FETCH_ASSOC);  print_r($result);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $tbdata = "<h1>DESCRIPTION</h1>";
    $tbdata .= "Size: " . $result['size'] . "<br />"
              . "Material: " . $result['material'] . "<br />"
              . "Thickness: " . $result['thickness'] . "<br />"
              . "Water Adsorption Rate: " . $result['water_adsorption_rate'] . "<br />"
              . "Packing: " . $result['packing'] . "<br />"
              . "Area: " . $result['area'] . "<br />"; 
    return $tbdata;  
}

function getadvantages($Catname){
  //product=tile&cat=" + cat
  global $conn;
  $sql="SELECT * FROM advantages WHERE product='tile' AND category='$Catname'";
  $stmt = $conn->query($sql);
  //$result = $stmt->fetchAll(PDO::FETCH_ASSOC);  print_r($result);
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  $tbdata = "<h1>ADVANTAGES</h1>";
  while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $tbdata .= $result['advantages'] . "<br />";
  }
  return $tbdata;  
}

function getpages($Catname){
    global $conn;
    if($Catname == "bigsize" ){
      $catpic = "BIG_SIZE_TILES";
    }else if($Catname == "glazedmatte" ){
      $catpic = "GLAZED_MATTE_TILES";
    }else if ($Catname == "glazedpolished"){
      $catpic = "GLAZED_POLISHED_TILES";
     }else if ($Catname == "polished"){
      $catpic = "POLISHED_PORCELAIN_TILES";
    }
    //BIG_SIZE_TILES,  GLAZED_MATTE_TILES,  GLAZED_POLISHED_TILES,  POLISHED_PORCELAIN_TILES
    $sql="SELECT COUNT(*) FROM tbtilepics WHERE `subcat` = '$catpic'";
    $stmt=$conn->query($sql);
    $pages = $stmt->fetchColumn();
    //$page = $pages / 20;
    if ($pages % 20 == 0){
      $page = $pages / 20 ;
    }else{
      $page = ($pages / 20) + 1 ;
    }
   $btnpages = "";
   
    for($i = 1; $i  < $page; $i++){
      $btnpages  .=  "<button onclick=loadpic2('$Catname','$i')>$i</button>";
    }
     return $btnpages;
}

function getpictures($Catname, $Pageno){
  global $conn;
  if($Catname == "bigsize" ){
    $catpic = "BIG_SIZE_TILES";
  }else if($Catname == "glazedmatte" ){
    $catpic = "GLAZED_MATTE_TILES";
  }else if ($Catname == "glazedpolished"){
    $catpic = "GLAZED_POLISHED_TILES";
   }else if ($Catname == "polished"){
    $catpic = "POLISHED_PORCELAIN_TILES";
  }

//$img = $catpic . $Pageno;
$pagestart = ($Pageno *20) -20;
$sql="SELECT * FROM tbtilepics WHERE subcat  = '$catpic' ORDER BY indexno ASC Limit $pagestart,20";
$stmt = $conn->query($sql);
//$result = $stmt->fetchAll(PDO::FETCH_ASSOC);  print_r($result);
  while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
      $pathname = "TILES_web_small/" . $catpic . "/" . $result['path'] . $result['filename'];
      $picresult .=  "<div class=div_photo_container>"
                     . "<a href='#' onclick=showMyImage('$pathname')>"
                     . "<img src=$pathname width=190px height=190px />"
                     . "</a></div>";
  } 

  return  $picresult ;
}
?>