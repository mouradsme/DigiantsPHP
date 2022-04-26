<?php 
// Route file example:
    return array(
        'id' => 'home',         // Route id, has to be unique
        'route' => 'home',      // The route that is read from the Server $_Get['page] variable
        'template' => 'Home',   // The HTML template name (found in the template folder)
        'assets'   => array(    // The assets (css & js) used by this route
            'css' => array('main.min.css'),
            'js'  => array('main.min.js')
        ),
        
        'callback' => function() {
            global $Database, $Routes, $functions;
            // The Callback serves as a preprocessor where all data and information are handled and prepared
            // before sending the response back to the client;
            // with The $Database object, queries can be made to fetch data from the database; here's an example:
            
             $id = $_GET['id'];
             $dbData = $Database->query("SELECT * FROM table WHERE id = ?;", [$id])->fetchAll(PDO::FETCH_ASSOC);
            
            // Now the fetched data can be passed onto the template file as follows:
            $Routes->Pass('Data', $dbData);
            // Using Twigin the Template file, you can read the data using this: {{Passed.Data}}
        }
    );
?>