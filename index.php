<?php

$db_conn=mysqli_connect("mydb","dummy","c3322b","db3322") or die("Connection Error!".mysqli_connect_error());

$current_time=time();

$query="DELETE FROM UserRecord WHERE timestamp<".strval($current_time).";";
$record=mysqli_query($db_conn,$query) or die("0 Error!".mysqli_error($db_conn));

if (isset($_COOKIE["userid"])==false){
    $new_user_id=rand(10000,99999);


    $query="SELECT * FROM UserRecord WHERE uid=".strval($new_user_id).";";
    $record=mysqli_query($db_conn,$query) or die("1 Error!".mysqli_error($db_conn));
    while(mysqli_num_rows($record)!=0){
        $new_user_id=rand(10000,99999);
        $query="SELECT visible FROM UserRecord WHERE uid=".strval($new_user_id).";";
        $record=mysqli_query($db_conn,$query) or die("2 Error!".mysqli_error($db_conn));
    }

    
    $current_time = time()+300;
    setcookie("userid",$new_user_id,$current_time);
    $query="INSERT INTO UserRecord VALUES(".strval($new_user_id).",12345678,".strval($current_time).");";
    $record=mysqli_query($db_conn,$query) or die("3 Error!".mysqli_error($db_conn));

    $query="SELECT visible FROM UserRecord WHERE uid=".strval($new_user_id).";";//$_COOKIE["userid"] to replace "1234"
    $record=mysqli_query($db_conn,$query) or die("8 Error!".mysqli_error($db_conn));

 

}
else{
    $current_user= $_COOKIE["userid"];
    $query="SELECT * FROM UserRecord WHERE uid=".strval($current_user).";";
    $record=mysqli_query($db_conn,$query) or die($current_user."4 Error!".mysqli_error($db_conn));
    if (mysqli_num_rows($record)==0){
        $new_user_id=rand(10000,99999);
        $query="SELECT * FROM UserRecord WHERE uid=".strval($new_user_id).";";
        $record=mysqli_query($db_conn,$query) or die("5 Error!".mysqli_error($db_conn));
        while(mysqli_num_rows($record)!=0){
            $new_user_id=rand(10000,99999);
            $query="SELECT visible FROM UserRecord WHERE uid=".strval($new_user_id).";";
            $record=mysqli_query($db_conn,$query) or die("6 Error!".mysqli_error($db_conn));
        }
        $current_time = time()+300;
        setcookie("userid",$new_user_id,$current_time);
        $query="INSERT INTO UserRecord VALUES(".strval($new_user_id).",12345678,".strval($current_time).");";
        $record=mysqli_query($db_conn,$query) or die("7 Error!".mysqli_error($db_conn));

        $query="SELECT visible FROM UserRecord WHERE uid=".strval($new_user_id).";";//$_COOKIE["userid"] to replace "1234"
        $record=mysqli_query($db_conn,$query) or die("8 Error!".mysqli_error($db_conn));

    }else{
        $query="SELECT visible FROM UserRecord WHERE uid=".strval($_COOKIE["userid"]).";";//$_COOKIE["userid"] to replace "1234"
        $record=mysqli_query($db_conn,$query) or die("8 Error!".mysqli_error($db_conn));
    }

  
    
};




$blk1="<h2 draggable = 'false' onclick=notEyeIsClicked()>Block 1 - SP500</h2>
<p onclick=notEyeIsClicked()><img draggable = 'false' onclick=notEyeIsClicked() src='images/SP500.png' alt='SP500' style='width: 250px;'>
</p><img onclick=hide(event)></img>
</div>";

$blk2="<h2 draggable = 'false' onclick=notEyeIsClicked()>Block 2 - FTSE 100</h2>
<p onclick=notEyeIsClicked()><img draggable = 'false' onclick=notEyeIsClicked() src='images/FTSE100.png' alt='FTSE 100'>
</p><img onclick=hide(event)></img>
</div>";

$blk3="<h2 draggable = 'false' onclick=notEyeIsClicked()>Block 3 - Hang Seng Index</h2>
<p onclick=notEyeIsClicked()><img draggable = 'false' onclick=notEyeIsClicked() src='images/HSI.png' alt='Hang Seng Index' style='width: 900px;'>
</p><img onclick=hide(event)></img>
</div>";

$blk4="<h2 draggable = 'false' onclick=notEyeIsClicked()>Block 4 - Nasdaq Composite index</h2>
<p onclick=notEyeIsClicked()><img draggable = 'false' onclick=notEyeIsClicked() src='images/nasdaq.png' alt='NASDAQ' style='width: 600px;'>
</p><img onclick=hide(event)></img>
</div>";

$blk5="<h2 draggable = 'false' onclick=notEyeIsClicked()>Block 5 - USD Exchange Rate</h2>
<p onclick=notEyeIsClicked()><img draggable = 'false' onclick=notEyeIsClicked() src='images/ex_rate.png' alt='USD Rate' style='width: 250px;'>
</p><img onclick=hide(event)></img>
</div>";

$blk6="<h2 draggable = 'false' onclick=notEyeIsClicked()>Block 6 - Currency Converter</h2>
<p onclick=notEyeIsClicked()><img draggable = 'false' onclick=notEyeIsClicked() src='images/Convert-Currency.png' alt='Currency Converter' style='width: 300px;'>
</p><img onclick=hide(event)></img>
</div>";

$blk7="<h2 draggable = 'false' onclick=notEyeIsClicked()>Block 7 - Crypto Index</h2>
<p onclick=notEyeIsClicked()><img draggable = 'false' onclick=notEyeIsClicked() src='images/Crypto.png' alt='Crypto Index' style='width: 500px;'>
</p><img onclick=hide(event)></img>
</div>";

$blk8="<h2 draggable = 'false' onclick=notEyeIsClicked()>Block 8 - USD vs. HKD</h2>
<p onclick=notEyeIsClicked()><img draggable = 'false' onclick=notEyeIsClicked() src='images/USD-HKD.png' alt='USD vs. HKD' style='width: 400px;'>
</p><img onclick=hide(event)></img>
</div>";

$blocks = array("1"=>$blk1,
"2"=>$blk2,
"3"=>$blk3,
"4"=>$blk4,
"5"=>$blk5,
"6"=>$blk6,
"7"=>$blk7,
"8"=>$blk8);

$visible = array("1"=>false,
"2"=>false,
"3"=>false,
"4"=>false,
"5"=>false,
"6"=>false,
"7"=>false,
"8"=>false);


?>

<!DOCTYPE>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="index.css">
        <script src="index.js"></script>
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <title>Financial Dashboard</title>
    </head>
    <body>
        <div id="outmost">
            <h1>Financial Dashboard</h1>
            <div id='container'>
                <?php 
                    if (mysqli_num_rows($record)>0){
                        while($row=mysqli_fetch_array($record)){
                            foreach (mb_str_split($row['visible']) as $char) {
                                echo "<div draggable='false' ondragleave='notDrop(event)' ondragstart='drag(event)' ondrop='drop(event)' ondragover='allow(event)' id=\"".$char."\" class='Visible'>".$blocks[$char];
                                $visible[$char] = true;
                            }
                        }
                        foreach ($visible as $x =>$val){
                            if ($val==false){
                                echo "<div draggable='false' ondragleave='notDrop(event)' ondragstart='drag(event)' ondrop='drop(event)' ondragover='allow(event)' id=\"".$x."\"class='Hidden'>".$blocks[$x];

                            }
                        }

                    }
                ?>
            </div>
        </div>
    </body>

</html>