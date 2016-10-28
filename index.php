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
    <title>Airtable API Magic</title>
    <meta content="" name="description">
    <meta content="Ben Gardner" name="author">
    <link href=
    "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css"
    rel="stylesheet">
    <!--<link rel="stylesheet" href="style.css" />-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel=
    "stylesheet">
    <script src="https://code.jquery.com/jquery-2.1.4.min.js">
    </script>
    <script src=
    "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js">
    </script>
    <script src=
    "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.min.js"
    type="text/javascript">
    </script><!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col m8 offset-m2 s12">
                <div class="airtable">
                <table>
                <?php
                foreach($airtable_response['records'] as $key => $value) {
									  echo '<tr id="' . $key . '">';
                    echo '<td><input id="' . $value['id'] . '" class="' . $key  . '-1" value="' . $value['fields']['col1'] . '"></td>';
										echo '<td><input id="' . $value['id'] . '" class="' . $key  . '-2" value="' . $value['fields']['col2'] . '"></td>';
										echo '<td><input id="' . $value['id'] . '" class="' . $key  . '-3" value="' . $value['fields']['col3'] . '"></td>';
										echo '<td><a class="btn-floating btn waves-effect waves-light red" id="add"><i class="material-icons ' . $key . '" id="delete">delete</i></a></td>';
										echo '</tr>'
                }
                 ?>
							  </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col m8 offset-m2 s12">
                <a class="waves-effect waves-light btn" id="update">button</a>

                <a class="btn-floating btn waves-effect waves-light red" id="add"><i class="material-icons">add</i></a>
            </div>
        </div>
    </div>
</body>
</html>
