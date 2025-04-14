<?php 

function getWeather() {
    // Setup return vars
    $msg = "";
    $output = "";

    // Make sure we got a zip
    if(!empty($_POST['zip_code'])) {
        $zip = trim($_POST['zip_code']);
        
        // Setup curl
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://russet-v8.wccnet.edu/~sshaper/assignments/assignment10_rest/get_weather_json.php?zip_code=$zip");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        // Get the data
        $data = curl_exec($ch);

        if(!$data) {
            $msg = "Couldn't get weather: " . curl_error($ch);
        } else {
            $weather = json_decode($data, true);
            
            // Check for API errors
            if(isset($weather['error'])) {
                $msg = $weather['error'];
            }
            // Got weather data
            else if(isset($weather['searched_city'])) {
                $msg = "Got the weather!";
                $city = $weather['searched_city'];
                
                // Build the output
                $output = "<h2>{$city['name']}</h2>";
                $output .= "<p>Temp: {$city['temperature']}<br>";
                $output .= "Humidity: {$city['humidity']}</p>";
                
                // Show forecast
                $output .= "<h4>Next 3 Days:</h4><ul>";
                foreach($city['forecast'] as $day) {
                    $output .= "<li>{$day['day']}: {$day['condition']}</li>";
                }
                $output .= "</ul>";

                // Higher temps table
                $output .= "<h4>Cities Warmer than {$city['name']}:</h4>";
                $output .= "<table class='table'><tr><th>City</th><th>Temp</th></tr>";
                if(!empty($weather['higher_temperatures'])) {
                    foreach($weather['higher_temperatures'] as $c) {
                        $output .= "<tr><td>{$c['name']}</td><td>{$c['temperature']}</td></tr>";
                    }
                }
                $output .= "</table>";

                // Lower temps table
                $output .= "<h4>Cities Cooler than {$city['name']}:</h4>";
                $output .= "<table class='table'><tr><th>City</th><th>Temp</th></tr>";
                if(!empty($weather['lower_temperatures'])) {
                    foreach($weather['lower_temperatures'] as $c) {
                        $output .= "<tr><td>{$c['name']}</td><td>{$c['temperature']}</td></tr>";
                    }
                }
                $output .= "</table>";
            }
        }
        curl_close($ch);
    } else {
        $msg = "Need a ZIP code!";
    }

    return array($msg, $output);
}
?>