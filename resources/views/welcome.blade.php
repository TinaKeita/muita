<?php
    // api beigas jaunajai pilsetai
    $api_url = "https://deskplan.lv/muita/app.json";
    $data = @file_get_contents($api_url);
    $muta_data = json_decode($data, true);
    

?>