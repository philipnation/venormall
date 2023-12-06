<?php
// Array of abusive words
$abusive_words = array("fool", "idiot", "mugu");

// The sentence to be checked
$sentence = "This sentence contains an a fool and also an idiot.";

// Check if any abusive word is present in the sentence
$abusive_word_found = false;
foreach ($abusive_words as $word) {
    if (strpos($sentence, $word) !== false) {
        $abusive_word_found = true;
        break;
    }
}

// Output message based on result
if ($abusive_word_found) {
    echo "Do not use the statement.";
} else {
    echo "Use it.";
}



//
    //for timeout session
//
$timeout = 10;

// Check if the session timeout has expired
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
    // Clear the session data and destroy the session
    session_unset();
    session_destroy();
    // Redirect the user to the login page or any other page as needed
    header('Location: home');
    exit;
}

// Update the last activity time for the session
$_SESSION['last_activity'] = time();
?>