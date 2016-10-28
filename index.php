<?php
include 'settings.php';

$url = 'https://api.airtable.com/v0/' . $base . '/' . $table . '?maxRecords=10&view=Main%20View';
$headers = array(
	'Authorization: Bearer ' . $api_key
);
$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPGET, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_URL, $url);
$entries = curl_exec($ch);
curl_close($ch);
$airtable_response = json_decode($entries, TRUE);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>A Wrapper For Airtable</title>
    <meta content="How to use the Airtable API to fetch data from your base, display it, and manipulate it." name="description">
    <meta content="Ben Gardner" name="author">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel=
    "stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link href="dist/css/materialize.css" rel="stylesheet">
    <link href="dist/css/custom.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src=
    "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
    <script src=
    "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.min.js"
    type="text/javascript"></script>
    <script src="dist/js/all.min.js"></script>
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
  <script>
  (function(d) {
    var config = {
      kitId: 'fut3kxg',
      scriptTimeout: 3000,
      async: true
    },
    h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
  })(document);
</script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col s12">
                <h1 class="center-align">A Wrapper For Airtable</h1>
                <p class="center-align">This website uses Airtable's API to display a base. The point of this project was to show how easy it is to fetch data from Airtable, update it, and even delete rows.</p>
                <p class="center-align">Select a cell below, change the text, and it will automatically sync with Airtable on deselection. To delete a row, click the trash icon. To add a row, click the plus icon. Convince yourself that your changes "stick" by refreshing the page.</p>
                <div class="airtable animated bounce">
                <table>
                <?php
                foreach($airtable_response['records'] as $key => $value) {
									  echo '<tr id="r' . $key . '">';
                                        echo '<td><textarea class="materialize-textarea ' . $value['id'] . '" id="c' . $key  . '-1">' . $value['fields']['col_1'] . '</textarea></td>';
                                        echo '<td><textarea class="materialize-textarea ' . $value['id'] . '" id="c' . $key  . '-2">' . $value['fields']['col_2'] . '</textarea></td>';
                                        echo '<td><textarea class="materialize-textarea ' . $value['id'] . '" id="c' . $key  . '-3">' . $value['fields']['col_3'] . '</textarea></td>';
                                        echo '<td><textarea class="materialize-textarea ' . $value['id'] . '" id="c' . $key  . '-4">' . $value['fields']['col_4'] . '</textarea></td>';
										echo '<td><a class="btn-floating btn waves-effect waves-light"><i class="material-icons delete valign fig-purple" id="i' . $key . '">delete</i></a></td>';
										echo '</tr>';
                }
                 ?>
				</table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <a class="btn-floating btn-large waves-effect waves-light fig-purp" id="add"><i class="material-icons">add</i></a>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <p class="center-align">Made with love by <a href="http://www.automationfuel.com">Ben Gardner</a></p>
            </div>
        </div>
    </div>
</body>
</html>
