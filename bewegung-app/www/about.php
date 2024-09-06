<?php
    $pageTitle = "About";
    $contentMargin = "auto";
    include '_head.php';
?>
<div style="margin:10pt;text-align:center;">
<div><img src="img/frog_g_150.webp" style="margin-top:40pt;" /></div>

<div id="update"></div>

<script>
    const url = 'update.php';
    fetch(url)
      .then(response => {
        if (!response.ok) {
          throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.text();
      })
      .then(data => {
        const contentDiv = document.getElementById('update');
        contentDiv.innerHTML = data;
      })
      .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
      });
    </script>

<h1 class="normal" style="margin-bottom:10pt;">About</h1>
<h1 class="normal" style="margin-top:0;font-size:16pt;"><?php include 'version'; ?></h1>
<p><span class="immer-in-font-uc">Immer in</span>&nbsp;<span class="bewegung-font-uc">Bewegung</span> is your open source, lightweight, and future proof travel documentation app.</p>
<p>Check for updates at <a target="_blank" href="https://bewegung.app/">bewegung.app</a>.</p>

<?php
/*
<div style="display:inline-flex;align-items: center;border:2pt solid #000;border-radius:10pt;gap:10pt;padding:3pt 5pt 3pt 5pt;">
    <div style="display:inline-block;padding-top:5pt;"><img src="img/frog_g_150.webp" style="height:32pt;" /></div>

        <div style="display:inline-block;">
            
          <!--<div style="font-family: 'Francois+One', sans-serif;font-size:10pt;margin:0;">Tracking my trips with</div>
--><div style="line-height:16pt;display:inline-block;"> 
            <span class="immer-in-font-uc">Immer in</span><br />
            <span class="bewegung-font-uc">Bewegung</span>
          </div>
          <!--<div style="font-family: 'Francois+One', sans-serif;font-size:10pt;margin:0;font-weight:bold;"><a href="https://bewegung.app">bewegung.app</a></div>
    ->></div>
</div>
*/
?>

</div>
<?php include '_foot.php'; ?>