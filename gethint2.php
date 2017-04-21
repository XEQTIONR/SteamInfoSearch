<?php
/*
@author Ishtehar Hussain
@date March 19, 2017
@notes gets information contents for a particular steamid
*/
  require('steam_key.php');

  $base = "{$IsteamURL}{$steamKey}{$suffix}"; // from steam_key.php
  //$base = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002?key=FD7A4010D36B3ED66C98799206F51991&steamids=';
  $q = $_GET["q"];
  $url = $base.$q;
  //$json = file_get_contents('http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002?key=FD7A4010D36B3ED66C98799206F51991&steamids=76561198018132926', TRUE);
  $json = file_get_contents($url, TRUE);

  $result["q_val"] = $q;
  //$data = json_decode($json);
  //echo $data->response.players->personaname;
  //echo $data['response']['players'][0]['personaname'];

  $jsonIterator = new RecursiveIteratorIterator(
      new RecursiveArrayIterator(json_decode($json, TRUE)),
      RecursiveIteratorIterator::SELF_FIRST);

      $gamer_attributes = array('steamid','personaname','communityvisibilitystate','avatarmedium');

  foreach ($jsonIterator as $key => $val) {
      if(is_array($val)) {
          //echo "$key:\n";
      } else if(in_array($key,$gamer_attributes) ){
          $result[$key]=$val;
        /*  switch ($key) {
            case 'avatarmedium':
            echo '<img src="' .htmlspecialchars($val). '"> <br>';

              # code...
              break;
            default:
              echo "$key is $result[$key]".'<br>';
              # code...
              break;
          }*/


      }


  }
  echo json_encode($result);



?>
