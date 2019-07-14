<!DOCTYPE html>
<!-- saved from url=(0074)http://mumstudents.org/cs472/2015-07-DE/Homework/2/resources/skeleton.html -->
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>TMNT - Rancid Tomatoes</title>
    <?php $css_path="../hw2/tmnt_files/";?>;
    <link href="<?=$css_path?>movie.css" type="text/css" rel="stylesheet" />
    <link rel="icon" href="<?=$css_path?>/rotten.gif" type="image/x-icon" />
  </head>

  <body>
      <?php
      $movie = $_GET["film"]!=NULL?$_GET["film"]:"spiderman";
      list($title,$year,$rating)=file($movie."/info.txt");
      ?>
    <div class="banner">
      <img src="<?=$css_path?>/banner.png" alt="Rancid Tomatoes" />
    </div>
    <h1><?=$title?> (<?=$year?>)</h1>
    <div class="content">
      <section>
        <div class="rotten">
          <img src="<?=$css_path?><?=$rating<60?"rottenbig.png":"freshbig.png"?>" alt="Rotten" />
          <span class="rotten-percentage"><strong><?=$rating?>%</strong></span>
        </div>
        <div class="column">
          <?php 
          $reviews=glob($movie."/review*.txt");
          for($i=0;$i<count($reviews);$i++){
            if($i==round(count($reviews)/2,0)){
            ?>
            </div><div class="column">
            <?php }
            list($quote,$rate,$fname,$lname)=file($reviews[$i]);
            ?>
          <article>
            <p>
              <img src="<?=$css_path?>/<?=strtolower($rate)?>.gif" alt=<?=$rate?> />
              <q
                ><?=$quote?></q
              >
            </p>
            <p>
              <img src="<?=$css_path?>/critic.gif" alt="Critic" />
              <?=$fname;?><br />
              <span><?=$lname;?></span>
            </p>
          </article>

            <?php 
          }?>
       </div>
      </section>
      <aside>
        <div>
          <img src="<?=$movie?>/overview.png" alt="general overview" />
        </div>

        <dl>
            <?php
            $overview=file($movie."/overview.txt");
            foreach($overview as $row){
                $data=explode(":",$row);
                $dds=explode(",",$data[1]);
                if(!$dds)
                $dds=$data[1];
                ?>
                <dt><?=$data[0]?><dt>
                  <?php
                  ?>
                    <dd>
                      <?php
                    for($i=0;$i<count($dds);$i++){
                        ?><?= $dds[$i]?>
                        <?php
                        if($i<count($dds))
                        ?> <br/>
                    <?php
                  }?>
                    </dd>
                    <?php
                  }?>
        </dl>
      </aside>
      <div class="footer">
        <p>(1-<?=count($reviews)?>) of <?=count($reviews)?></p>
      </div>
    </div>
    <footer>
      <a href="http://validator.w3.org/check/referer"
        ><img src="<?=$css_path?>/w3c-html.png" alt="Valid HTML5"
      /></a>
      <br />
      <a href="http://jigsaw.w3.org/css-validator/check/referer"
        ><img src="<?=$css_path?>/w3c-css.png" alt="Valid CSS"
      /></a>
    </footer>
  </body>
</html>
