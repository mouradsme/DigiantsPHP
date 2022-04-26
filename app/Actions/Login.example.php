<?php 

// Action file example:
    return array(
        'action' => 'login', // action name, AJAX calls this as an action to point to this file
        'callback' => function() {
            global $functions, $Database, $Lang;
            // Preprocess the Client $_POST array using the pre-defined function for preprocessing
            // and extract the indexes as varaibles:
            extract($functions->preprocessArray($_POST));
            // Normally, no login has been performed, so we init the following boolean and set it to false:
            $LoginAllowed = false;
            // Check if the user exsits in the Database, and store the result in a SESSION varaible if that's the case:
            $User = $Database->query("SELECT * FROM users WHERE user_username = ? ", [$username])->fetchAll(PDO::FETCH_ASSOC);
            
            if (count($User) > 0) $LoginAllowed = true;
            if ($LoginAllowed) {
                $_SESSION['reclam_logged_in'] = true;
                $_SESSION['client_number'] = $number;
                return ['status' => 'success', 'message' => 'allow'];
            } else {
                return ['status' => 'error', 'message' => 'errorCode'];
            }
            // Returning results has to follow the structure (as you can see above and below):
            // This will be converted to JSON so that AJAX can handle the response
            // The message can be any type of data you need (String, boolean, array, object...)
            return ['status' => 'error', 'message' => 'errorCode'];
            
        }
    );
?>