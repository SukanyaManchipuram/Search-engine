<?php
$xmlDoc=new DOMDocument();
$xmlDoc->load("search.xml");

$x=$xmlDoc->getElementsByTagName('item');

//get the q parameter from URL
$q=$_GET["q"];

//lookup all links from the xml file if length of q>0
if (strlen($q)>0) {
  $hint="";
  for($i=0; $i<($x->length); $i++) 
  {
    $y=$x->item($i)->getElementsByTagName('name');
    $z=$x->item($i)->getElementsByTagName('link');
    if ($y->item(0)->nodeType==1) 
	{
      if (stristr($y->item(0)->childNodes->item(0)->nodeValue,$q))
      {
        if ($hint=="") 
		{
          $hint="<a style='align:right; color:#000000; border:none;' href='" . 
          $z->item(0)->childNodes->item(0)->nodeValue . 
          "' target='_blank'>" . 
          $y->item(0)->childNodes->item(0)->nodeValue . "</a></br>";
        } 
		else
		{
          $hint=$hint . "<br /><a style='align:right; color:#000000; border:none;' href='" . 
          $z->item(0)->childNodes->item(0)->nodeValue . 
          "' target='_blank'>" . 
          $y->item(0)->childNodes->item(0)->nodeValue . "</a></br>";
        }
      }
    }
  }
}

// if no hint was found
// or to the correct values
if ($hint=="") {
  $response="no matching sites";
} else {
  $response=$hint;
}

//output the response
echo $response;
?>
