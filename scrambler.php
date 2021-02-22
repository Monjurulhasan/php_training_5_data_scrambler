<?php 
    include_once "scrambler_functions.php";
    $task = 'encode';
    if(isset($_GET['task']) && $_GET['task'] !=''){
        $task = $_GET['task'];
    }
    $key = 'abcdefghijklmnopqrstuvwxyz1234567890';
    if('key' == $task){
        $key_original = str_split($key);
        shuffle($key_original);
        $key = join('', $key_original);
    }else if(isset($_POST['key']) && $_POST['key'] !=''){
        $key = $_POST['key'];
    }

    $scrambledData = '';
    if('encode' == $task){
        $data = $_POST['data'] ?? '';
        if($data != ''){
            $scrambledData = scrambleData($data, $key);
        }
    }

    if('decode' == $task){
        $data = $_POST['data'] ?? '';
        if($data != ''){
            $scrambledData = decodeData($data, $key);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">
    <title>Data Scrambler</title>
    <style>
        body{
            margin-top: 30px;
        }
        #data{
            width: 100%;
            height: 160px;
        }
        #result{
            width: 100%;
            height: 160px;
        }
        .hidden{
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="column column-60 column-offset-20">
                <h2>Data Scrambler</h2>
                <p>Use this application to scrambler your data</p>
                <p>
                    <a href="/scrambler.php?task=encode">Encode</a> |
                    <a href="/scrambler.php?task=decode">Decode</a> |
                    <a href="/scrambler.php?task=key">Generate Key</a>
                </p>
            </div> <!-- end .column -->
        </div> <!-- end .row -->
        <div class="row">
            <div class="column column-60 column-offset-20">
                <form method="POST" action="scrambler.php<?php if('decode'== $task) { echo "?task=decode";} ?>">
                    <label for="key">Key</label>
                    <input type="text" name="key" id="key" <?php displayKey($key) ?> >
                    <label for="data">Data</label>
                    <textarea name="data" id="data"><?php if(isset($_POST['data'])) { echo $_POST['data'];} ?></textarea>
                    <label for="result">Result</label>
                    <textarea id="result"><?php echo $scrambledData?></textarea>
                    
                    <button type="submit">Do It For Me</button>
                </form> <!-- end form -->
            </div> <!-- end .column -->
        </div> <!-- end .row -->
    </div> <!-- end .container -->
</body>
</html>