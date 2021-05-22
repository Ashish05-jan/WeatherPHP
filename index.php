<?php 
$city="";
$msg="";
$status="";
if(isset($_POST['submit'])){
$city = $_POST['city'];
$url = "http://api.openweathermap.org/data/2.5/weather?q=$city&appid=34635c47ec7fbc1f6bc0db4c1eea26e1";
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$result=curl_exec($ch);
curl_close($ch);
$result = json_decode($result,true);
if($result['cod']==200){
    $status="yes";
}else{
    $msg = $result['message'];
}
// echo '<pre>';
// print_r($result);
// die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Forecast</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   <div class="forms">
    <form style="width:100%" method="post">
        <input type="text" class="text" placeholder="Enter city name" name="city" value = "<?php echo $city?>"/>
        <input type="submit" value="Submit" class="submit" name="submit"/>
    </form>
   </div>

   <?php if($status=="yes"){?>
      <article class="widget">
         <div class="weatherIcon">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR_XTb5h9cUJ7x-FmV8s3QYXTKlh6oehZkpdg&usqp=CAU<?php echo $result['weather'][0]['icon']?>@4x.png"/>
         </div>
         <div class="weatherInfo">
            <div class="temperature">
               <span><?php echo round($result['main']['temp']-273.15)?>°</span>
            </div>
            <div class="description mr45">
               <div class="weatherCondition"><?php echo $result['weather'][0]['main']?></div>
               <div class="place"><?php echo $result['name']?></div>
            </div>
            
         </div>
         <div class="date">
            <?php echo date('d M Y',$result['dt'])?> 
             
         </div>
      </article>
      <?php } ?>
   </body>
</html>