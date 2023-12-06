<?php
// connecting to database
$conn = mysqli_connect("localhost", "root", "", "online_market") or die("Database Error");

// getting user message through ajax
$getMesg = mysqli_real_escape_string($conn, strtolower($_POST['text']));

//checking user query to database query
$check_data = "SELECT replies FROM chatbot WHERE messages LIKE '%$getMesg%'";
$run_query = mysqli_query($conn, $check_data) or die("Error");

function predict($description) {
    $abusive_words_file = "abusivewords.txt";
    $abusive_words = file($abusive_words_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $abusive_word_found = false;
    foreach ($abusive_words as $word) {
        if (strpos($description, $word) !== false) {
            $abusive_word_found = true;
            break;
        }
    }
    $end = "try using the words like:<br> 
            <span style='color: #FED700;'>bag, cart, buy, order,
            issues, call, customer care, delay</span>";
    if (strpos($description, 'bag') !== false) {
      return "<a href='../bags' style='color:#FED700;text-decoration:none;'>bags</a> are saved orders that you can reorder.<br>When it comes to a bag,
              there are few things you need to learn on how the bag works.<br> You can edit the name of the bag to the anyname you want,<br>
              you can reorder the bag and then,<br> you can also delete the bag.";
    } elseif (strpos($description, 'cart') !== false) {
      return "The <a href='../../cart' style='color:#FED700;text-decoration:none;'>cart</a> is there your pre ordered items are being stored.";
    } elseif (strpos($description, 'refund') !== false) {
      return 'We refund you your money when you do not want an order again.';
    } elseif (strpos($description, 'order') !== false) {
      return 'Orders will be delivered with 12-24 hours of order';
    }elseif ($abusive_word_found) {
      return "To be more respectful, abusive words are not accepted while using this chat system $end";
    } elseif (strpos($description, 'issues') !== false) {
        return "If you have any issue, you can call our customer care: <a href='tel: +2348120188577'>call now</a>. If
        there is no response or you didn't get the appropriate answer you need, <a href='mailto: ikechukwuphilip45@gmail.com'>email us now</a>";
    } elseif (strpos($description, 'customer care') !== false) {
        return "If you have any issue, you can call our customer care: <a href='tel: +2348120188577'>call now</a>. If
        there is no response or you didn't get the appropriate answer you need, <a href='mailto: ikechukwuphilip45@gmail.com'>email us now</a>";
    } else {
      // Set the OpenAI API endpoint and API key
        $openai_endpoint = 'https://api.openai.com/v1/engines/davinci/completions';
        $openai_api_key = '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';

        // Set the prompt text
        $data = array(
          'prompt' => $description,
          'max_tokens' => 100,
          'temperature' => 0.7
        );

        // Initialize cURL
        $ch = curl_init();

        // Set the cURL options
        curl_setopt($ch, CURLOPT_URL, $openai_endpoint);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          'Content-Type: application/json',
          'Authorization: Bearer ' . $openai_api_key
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the cURL request and get the response
        $response = curl_exec($ch);

        // Close the cURL session
        curl_close($ch);

        // Decode the JSON response
        $json = json_decode($response);

        // Check if the API request was successful
        if ($json && $json->choices) {
          // Get the generated text from the API response
          $generated_text = $json->choices[0]->text;
          return $generated_text;
        } else {
          return 'Error: ' . $json->error->message;
        }
    }
  }
  
// if user query matched to database query we'll show the reply otherwise it go to else statement
if(mysqli_num_rows($run_query) > 0){
    //fetching replay from the database according to the user query
    $fetch_data = mysqli_fetch_assoc($run_query);
    //storing replay to a varible which we'll send to ajax
    $replay = $fetch_data['replies'];
    echo $replay;
}else{
    echo predict($getMesg);
}

?>