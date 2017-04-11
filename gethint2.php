<?php

  $json = file_get_contents('http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002?key=FD7A4010D36B3ED66C98799206F51991&steamids=76561198018132926', TRUE);
  //$data = json_decode($json);
  //echo $data->response.players->personaname;
  //echo $data['response']['players'][0]['personaname'];

  $jsonIterator = new RecursiveIteratorIterator(
      new RecursiveArrayIterator(json_decode($json, TRUE)),
      RecursiveIteratorIterator::SELF_FIRST);

  foreach ($jsonIterator as $key => $val) {
      if(is_array($val)) {
          echo "$key:\n";
      } else {
          echo "$key => $val\n";
      }
  }



?>
