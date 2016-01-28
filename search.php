<?php
$recipe=addslashes(strip_tags($_POST['recipe']));
$recipes=explode(chr(10), $recipe);
print_r($recipes);
echo "<hr />";
$dir    = 'recipe/';
$files = scandir($dir);
//print_r($files);
unset($files[0]);
unset($files[1]);

foreach($files as $file){
	$handle = fopen("recipe/" . $file, "r");
	$contents = fread($handle, filesize("recipe/" . $file));
	fclose($handle);
	$xml = new SimpleXMLElement($contents);
	$title = $xml->xpath('/recipe/information/title');
	//echo "<b>" . $title[0] . "</b>";
	$result = $xml->xpath('/recipe/ingredients/item/name');
	$n=count($result);
	$i=0;
	while(list( , $node) = each($result)) {
		foreach($recipes as $r){
			//echo strcasecmp(chop($r), $node) . "<br />";
			if(strcasecmp(chop($r), $node) == 0){
				//echo $node . "<br />";
				$i++;
			}
		}
	}
	if($i == $n){ echo $title[0]; }
}


?>
