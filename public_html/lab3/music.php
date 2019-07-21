

<!DOCTYPE html>
<html>
	<!--
	Web Programming Step by Step
	Lab #3, PHP
	-->

	<head>
		<title>Music Viewer</title>
		<meta charset="utf-8" />
		<link href="./viewer.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
        <?php
		$num_songs=5678;
		function getMP3Files(){
			
			$ul= "<ul id=\"musiclist\">";
			$li="<li class=\"mp3item\">";
			$a_begin="<a href=\"";
			$a_mid="\">";
			$ul_end="</ul>";
			$li_end="</li>";
			$a_end="</a>";
			$songs=glob("./songs/*.mp3");
			$option=$_GET["option"]!=NULL?$_GET["option"]:false;
			if($option!=false)
			echo "Current sorting: ".$option;
			echo $ul;
			switch($option){
				case "shuffle":
				shuffle($songs);
				break;
				case "reverse":
				$songs=array_reverse($songs);
				break;
				case "sortBySize":
				$arr=array();
				foreach($songs as $song){
					$arr[$song]=round(filesize($song)/1024,0);
				}
				arsort($arr);
				$songs=array_keys($arr);
				break;
				default:
				break;
			}
			foreach($songs as $afile){
				echo $li;
				echo $a_begin.$afile.$a_mid;
				echo basename($afile)." (".round(filesize($afile)/1024,0)." KB)";
				echo "<audio controls src=\"".$afile."\">Your browser does not support audio element</audio>";
				echo $a_end;
				echo $li_end;
			}
			getM3UFiles();
			echo $ul_end;
		}
		function getM3UFiles(){
			$ul= "<ul>";
			$li="<li>";
			$pli="<li class=\"playlistitem\">";
			$a_begin="<a href=\"";
			$a_mid="\">";
			$ul_end="</ul>";
			$li_end="</li>";
			$a_end="</a>";
			foreach(glob("./songs/*.m3u") as $afile){
				echo $pli;
				echo basename($afile);
				echo $ul;
				foreach(file($afile) as $fcontent){
					if($fcontent[0]!="#"){//&& strpos($fcontent,".mp3")!=strlen($fcontent)-4){
						echo $li;
						echo $fcontent;
						echo $li_end;	
					}
				}
				echo $ul_end;
				echo $li_end;
			}
		}
        function getLinks(){
			$num_links=$_GET["newspages"]!=NULL?$_GET["newspages"]:5;
            echo "<ol>";
            for($i=1;$i<=$num_links;$i++){
                echo "<li><a href='http://music.yahoo.com/news/archive/".$i.".html'>Page ".$i."</a></li>";
            }
            echo "</ol>";
		}
		
		function getFavoriteArtists(){
			$artists=array("Britney Spears","Christina Aguilera","Justin Bieber");
			$artists=file("./favorite.txt");
			echo "<ol>";
			foreach($artists as $artist)
				echo "<li>".makeArtistNameLink($artist)."</li>";
			echo "</ol>";
		}
		function makeArtistNameLink($name){
			$result= "<a href=\"http://music.yahoo.com/videos/".formatName($name)."\">".$name."</a>";
			//echo $result;
			return $result;
		}
		function formatName($name){
			$name=strtolower($name);
			$name=str_replace(" ","-",$name);
			return $name;
		}

        ?>
		<h1>My Music Page</h1>
		
		<!-- Exercise 1: Number of Songs (Variables) -->
		<p>
			I love music.
			I have <?=$num_songs?> total songs,
			which is over <?=(float)$num_songs/10?> hours of music!
		</p>

		<!-- Exercise 2: Top Music News (Loops) -->
		<!-- Exercise 3: Query Variable -->
		<div class="section">
			<h2>Yahoo! Top Music News</h2>
           <?php getLinks();?>
		</div>

		<!-- Exercise 4: Favorite Artists (Arrays) -->
		<!-- Exercise 5: Favorite Artists from a File (Files) -->
		<div class="section">
			<h2>My Favorite Artists</h2>
			<?php getFavoriteArtists();?>
		</div>
		
		<!-- Exercise 6: Music (Multiple Files) -->
		<!-- Exercise 7: MP3 Formatting -->
		<div class="section">
			<h2>My Music and Playlists</h2>
			<h3>
			Supported sorting options: shuffle, reverse,sortBySize. ie:
			<a href="http://mumstudents.org/~000-98-6689/lab3/music.php?newspages=4&option=shuffle">Shuffle</a> 
			</h3>
			<?=getMP3Files();?>

<!-- 
			<ul id="musiclist">
				<li class="mp3item">
					<a href="http://mumstudents.org/cs472/Labs/3/songs/be-more.mp3">be-more.mp3</a>
				</li>
				
				<li class="mp3item">
					<a href="http://mumstudents.org/cs472/Labs/3/songs/just-because.mp3">just-because.mp3</a>
				</li>

				<li class="mp3item">
					<a href="http://mumstudents.org/cs472/Labs/3/songs/drift-away.mp3">drift-away.mp3</a>
				</li>

				<!-- Exercise 8: Playlists (Files) -->
				<!-- <li class="playlistitem">472-mix.m3u:
					<ul>
						<li>Hello.mp3</li>
						<li>Be More.mp3</li>
						<li>Drift Away.mp3</li>
						<li>190M Rap.mp3</li>
						<li>Panda Sneeze.mp3</li>
					</ul>
				</li>
			</ul> --> 
		</div>
		<div>
			<a href="http://validator.w3.org/check/referer">
				<img src="http://mumstudents.org/cs472/Labs/3/w3c-html.png" alt="Valid HTML5" />
			</a>
			<a href="http://jigsaw.w3.org/css-validator/check/referer">
				<img src="http://mumstudents.org/cs472/Labs/3/w3c-css.png" alt="Valid CSS" />
			</a>
		</div>
	</body>
</html>

