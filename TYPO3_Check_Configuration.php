<!--
Name: TYPO3 Check Server Compatibility
Desc: You can check the current server configuration and compatibility for the seletec TYPO3 version. Also, You can check the Database connection and Check if the server can send the Email or not.
Developer: NITSAN Technologies Pvt. Ltd.
Date: 25th April 2018
Contact: info@nitsan.in
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TYPO3: Check Server Configurations</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
        }
        body {
            height: 100%;
            width: 100%;
            font-size: 14px;
            color: #222222;
            font-family: "Roboto",sans-serif;
        }
        .wrapper {
            max-width: 1170px;
            width: 100%;
            margin: 0 auto;
        }
        .text-center {
            text-align: center;
        }
        .form-wrapper {
            margin: 20px 0;
            display: inline-block;
            width: 100%;
            position: relative;
        }
        input, select {
            color: inherit;
            font-size: 13px;
            font-weight: 400;
            height: 36px;
            line-height: normal;
            margin: 0;
            min-width: 165px;
            outline: medium none !important;
            padding: 0 10px;
        }
        select {
            min-width: 187px;
        }
        input[type="submit"] {
            background-color: #ee8433;
            border: 1px solid #ee8433;
            border-radius: 0;
            color: #fff;
            box-shadow: none;
            cursor: pointer;
            font-weight: 700;
            min-width: 105px;
            -webkit-transition: all 0.3s ease-in-out 0s;
            transition: all 0.3s ease-in-out 0s;
            outline: none;
        }
        label {
            color: rgba(0, 0, 0, 0.7);
            display: inline-block;
            font-size: 16px;
            font-weight: 500;
            margin: 0 0 13px;
            width: 100%;
        }
        .inline-label {
            float: left;
            margin: 8px 20px 8px 0;
            width: auto;
        }
        select option {
            outline: none;
            padding-left: 5px;
        }
        select:focus {
            outline: none !important;	
        }
        img {
            max-width: 100%;
            height: auto;
        }
        .infor-table-wrapper {
            overflow: auto;
            width: 100%;
        }
        table {
            background-color: #fafafa;
            border: 1px solid #cccccc;
            margin-bottom: 18px;
            max-width: 100%;
            width: 100%;
            text-align: left;
            border-collapse: collapse;
            border-spacing: 0;
        }
        table > thead > tr {
            background-color: #ededed;
        }
        th,td {
            border: 1px solid #cccccc;
            line-height: 1.5;
            padding: 9px 15px;
            vertical-align: middle;
        }
        table th {
            border-bottom: 1px solid #cccccc;
            border-top: 0 none;
        }
        .clearfix:after {
            clear: both;
            content: "";
            display: block;
        }   
        .text-right {
            text-align: right;
        }
        .bg-red {
            background-color: #f2dede;
            color: #a94442;
        }
        .bg-green {
            background-color: #dff0d8;
            color: #3c763d;
        }	
        .bg-red td,
        .bg-green td {
            color: #fff !important;
        }
        h1 {
            font-size: 28px;
            margin: 0;
        }
        .headline {
            margin: 50px 0 40px;
            text-align: center;
        }
        *::after, *::before {
            box-sizing: border-box;
        }
        .row::after, .row::before {
            content: " ";
            display: table;
        }
        .row::after {
            clear: both;
        }
        .row {
            margin-left: -15px;
            margin-right: -15px;
        }
        [class*='col-'] {
            min-height: 1px;
            padding-left: 15px;
            padding-right: 15px;
            position: relative;
            float: left;
        }
        [class*="col-"] input {
            min-width: 1px;
            width: 100%;
        }
        .col-12 {
            width: 100%;
        }
        .col-3 {
            width: 25%;
        }
        .col-4 {
            width: 33.3333%;
        }
        .col-6 {
            width: 50%;
        }
        .col-2 {
            width: 14.14%;
        }
        .alert {
            border: 1px solid transparent;
            border-radius: 4px;
            margin-bottom: 20px;
            padding: 15px;
        }
        .alert-success {
            background-color: #dff0d8;
            border-color: #d6e9c6;
            color: #3c763d;
        }
        .alert-info {
            background-color: #d9edf7;
            border-color: #bce8f1;
            color: #31708f;
        }
        .alert-warning {
            background-color: #fcf8e3;
            border-color: #faebcc;
            color: #8a6d3b;
        }
        .alert-danger {
            background-color: #f2dede;
            border-color: #ebccd1;
            color: #a94442;
        }
        .center table {
        	width: 100%;
        }
    </style>
</head>
<?php
/**
Name: get_current_mysql_version
Parameters: NULL
Return: String
Desc: It return the current Installed MySQL version.
**/
function get_current_mysql_version(){
    $output = shell_exec( 'mysql -V' );
    preg_match('@[0-9]+\.[0-9]+\.[0-9]+@', $output, $version);
    return $version[0];
}

/**
Name: check_email
Parameters: text
Return: Boolean
Desc: Check whether server can send Email or not.
**/
function check_email( $toEmailAddress ) {
    $emailSubject = "NS Test Server Email";
    $emailText = "Hello, Yes the E-mail is working properly on this server. Enjoy!!!";
    return mail ($toEmailAddress, $emailSubject, $emailText);
}

/**
Name: show_message
Parameters: message, message type (alert-success, alert-danger, alert-info, alert-warning)
Return: HTML Text
Desc: Show Bootstrap different messages.
**/
function show_message ( $msg, $msgType ) {
    return "<div class='alert ".$msgType."'>".$msg."</div>";
}

/**
Name: get_typo3_version_config
Parameters: null
Return: array
Desc: get all predefined array with parameters
**/
function get_typo3_version_config () {
    return array(
                '4' => array(
                                'php_min' => '5.2',
                                'php_max' => '5.5',
                                'sql_min' => '5.0',
                                'sql_max' => '5.5',
                                'ImageMagick' => '-',
                                'gd' => '-', 
                                'mbstring' => '-', 
                                'max_execution_time' => '240',
                                'memory_limit' => '128M',
                                'max_input_vars' => '1500',
                                'upload_max_filesize' => '200M',
                                'post_max_size' => '800M'
                            ),
                '6' => array(
                                'php_min' => '5.3',
                                'php_max' => '0',
                                'sql_min' => '5.1',
                                'sql_max' => '5.6',
                                'ImageMagick' => '-',
                                'gd' => '-',
                                'mbstring' => '-',
                                'max_execution_time' => '240',
                                'memory_limit' => '128M',
                                'max_input_vars' => '1500',
                                'upload_max_filesize' => '200M',
                                'post_max_size' => '800M'
                            ),
                '7' => array(
                                'php_min' => '5.5',
                                'php_max' => '0',
                                'sql_min' => '5.5',
                                'sql_max' => '5.7.20',
                                'ImageMagick' =>'-',
                                'gd' => '-',
                                'mbstring' => '-',
                                'max_execution_time' => '240',
                                'memory_limit' => '128M',
                                'max_input_vars' => '1500',
                                'upload_max_filesize' => '200M',
                                'post_max_size' => '800M'
                            ),
                '8' => array(
                                'php_min' => '7',
                                'php_max' => '0',
                                'sql_min' => '5.0',
                                'sql_max' => '5.7.20',
                                'ImageMagick' => '-',
                                'gd' => '-',
                                'mbstring' => '-',
                                'max_execution_time' => '240',
                                'memory_limit' => '128M',
                                'max_input_vars' => '1500',
                                'upload_max_filesize' => '200M',
                                'post_max_size' => '800M'
                            ),
                '9' => array(
                                'php_min' => '7.2',
                                'php_max' => '0',
                                'sql_min' => '5.0',
                                'sql_max' => '5.7.20',
                                'ImageMagick' => '-',
                                'gd' => '-',
                                'mbstring' => '-',
                                'max_execution_time' => '240',
                                'memory_limit' => '128M',
                                'max_input_vars' => '1500',
                                'upload_max_filesize' => '200M',
                                'post_max_size' => '800M'
                            ),
            );
}
?>
<body>
    <div class="wrapper">
        <div class="headline">
            <h1>Check Server Configuration</h1>
        </div>
        <div class="form-wrapper">
            <form action="TYPO3_Check_Configuration.php" method="get">
                <label>Select TYPO3 Version:</label>
                <select name="version" id="typo3-version" required onchange="this.form.submit()">
                    <option value="">Select</option>
                    <?php
                    $TYPO3Version = array( '4' => 'TYPO3 4.X', '6' => 'TYPO3 6.X', '7' => 'TYPO3 7.X', '8' => 'TYPO3 8.X', '9' => 'TYPO3 9.X');
                    foreach ($TYPO3Version as $key => $value) {
                        $VersionSelected = ( isset($_GET['version']) && $_GET['version'] == $key) ? "selected=selected" : "";
                        echo "<option value=".$key." ".$VersionSelected.">".$value."</option>";
                    }
                    ?>
                </select>
                <!--<input name="server_config_test" value="Go" type="submit">-->
            </form>
        </div>
        <div class="infor-table-wrapper">
            <?php
            if (isset($_GET['version'])) {
                $selected_val = $_GET['version'];               
                echo show_message ( "You have selected: <b>TYPO3 " . $selected_val . ".X </b>", "alert-success");
                ?>
                <table>
                    <thead>
                        <tr>
                            <th width="20%">Modules</th>
                            <th width="8%" class="text-center">Installed (Yes/No)</th>
                            <th width="8%" class="text-center">Current Version</th>
                            <th width="8%" class="text-center">Required Version</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $VersionInfo = get_typo3_version_config();
                        if( isset( $_GET['version']) ) {
                        	$value = $VersionInfo[$selected_val];
                        	foreach ($value as $module => $module_value) {
                        		if( $module_value == '-' ) {
                                    if( $module == 'ImageMagick' ) {
                                        exec('convert -version',$output);
                                        $installed = ($output) ? "Yes" : "No";
                                        $color = ($output) ? "green" : "red";
                                    } else {
                                        $installed = (extension_loaded($module)) ? "Yes" : "No";
                                        $color = (extension_loaded($module)) ? "green" : "red";
                                    }                        			
                        			$current = "-";
                        			$required = "-";
                        			$title = ucwords(str_replace('_',' ',$module));
                        		} elseif ( $module =='php_min' ) {
                        			$installed = (phpversion()) ? "Yes" : "No";
                        			$color = (version_compare(PHP_VERSION, $value[php_min]) >= 0) ? "green" : "red";
                        			$current = substr(phpversion(), 0, 6);
                        			$required = ">=".$value[php_min];
                        			$title = "PHP";
		                        	if( $value[php_max] > 0 ){
		                        		if($color == green) $color = (version_compare(PHP_VERSION, $value[php_max]) < 0) ? "green" : "red";
			                        	$highvalue = " to ".$value[php_max];
			                        	$required = $value[php_min].$highvalue;
		                        	}
                        		} elseif ( $module == 'sql_min' ) {
                        			$mysqlcurrent = get_current_mysql_version();
                        			$installed = ($mysqlcurrent > 0) ? "Yes" : "No";
                        			$color = (version_compare($mysqlcurrent, $value[sql_min]) >= 0) ? "green" : "red";
                        			$current = $mysqlcurrent;
                        			$required = ">=".$value[sql_min];
                        			$title = "Mysql";
		                        	if( $value[sql_max] > 0 ) {
		                        		if( $color == green ) {
			                        		$color = (version_compare($mysqlcurrent, ($value[sql_max]+1)) <= 0) ? "green" : "red";
			                        	}
			                        	$highvalue = " to ".$value[sql_max];
			                        	$required = $value[sql_min].$highvalue;

		                        	}

                        		} else {
                        			$installed = (ini_get($module) > 0) ? "Yes" : "No";
                        			$color = (ini_get($module) >= $module_value) ? "green" : "red";
                        			$current = ini_get($module);
                        			$required = $module_value;
                        			$title = ucwords(str_replace('_',' ',$module));
                        		}
                        		
	                        	if( $module !== 'php_max' ) { 
	                        		if( $module !== 'sql_max' ) { 
	                        	?>
	                        		<tr>
			                            <td><?php echo $title;?></td>
			                            <td class="text-center"><?php echo $installed;?></td>
			                            <td class="text-center bg-<?php echo $color; ?>"><?php echo $current; ?></td>
			                            <td class="text-center bg-<?php echo $color; ?>"><?php echo $required; ?></td>
			                        </tr>
			                    <?php
			                		}
			                	}
                        	}
                        }
                    ?>                        
                    </tbody>
                </table>
                <?php
            }
            ?>
        </div>

        <!-- Starting of Check Database Connection details -->
        <div class="form-wrapper">

            <?php
            if (isset($_POST['check_db_connection']) ) {
            	$host = $_POST['host'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $database = $_POST['database'];
                $port = $_POST['port'];

                if (!empty($_POST['port']) ) {
                	$con = mysqli_connect((isset($_POST['host'])) ? $_POST['host'] : "localhost", $username, $password, $database, $port); // Check the connection is successfull or not.
                } else {
                	$con = mysqli_connect((isset($_POST['host'])) ? $_POST['host'] : "localhost", $username, $password, $database); // Check the connection is successfull or not.
                }

                echo $DBConnectionMsg = ($con) ? show_message("Database Connection is successful", "alert-success") : show_message( "Error: Connection can not be done. Please check your credentials again", "alert-danger");
            }
            ?>
            <form action="TYPO3_Check_Configuration.php" method="post" name="form_DB_connection">
                <div class="row">
                    <div class="col-12">
                        <label>Database Connection details:</label>
                    </div>                        
                    <div class="col-2">
                        <input type="text" name="host" placeholder="Host" value="<?php echo $host = (isset($_POST['host'])) ? $_POST['host'] : '';?>"  />
                    </div>
                    <div class="col-2">
                        <input type="text" required name="username" placeholder="User name" value="<?php echo $DBuserName = (isset($_POST['username'])) ? $_POST['username'] : '';?>" />
                    </div>
                    <div class="col-2">
                        <input type="text" required name="password" placeholder="Password" value="<?php echo $DBPassWord = (isset($_POST['password'])) ? $_POST['password'] : '';?>"/>
                    </div>
                    <div class="col-2">
                        <input type="text" required name="database" placeholder="Database Name" value="<?php echo $DBName = (isset($_POST['database'])) ? $_POST['database'] : '';?>"/>
                    </div>
                    <div class="col-2">
                        <input type="number" name="port" placeholder="Port" value="<?php echo $port = (isset($_POST['port'])) ? $_POST['port'] : '';?>"/>
                    </div>
                    <div class="col-2">
                        <input type="submit" name="check_db_connection" value="Test" />
                    </div>
                </div>
            </form>
        </div>
        <!-- Ending of Check Database Connection details -->

        <!-- Starging of Check the Email functionality -->
        <div class="form-wrapper">
            <?php
            $emailText = ""; // Set default email text as blank.
            if ( isset( $_POST['check_email_button'] ) ) { //Check if the Check Email function is submitted or not.
                $emailText = $_POST['email']; 
                echo $emailResultMsg = ( !check_email( $_POST['email'] ) ) ? show_message( "Error: Email not sent. Please check your Email configuration.", "alert-danger") : show_message("Email sent successfully. Please check your inbox", "alert-success");
            }
            ?>
            <form action="TYPO3_Check_Configuration.php" method="post" name="check_email">
                <label>Check Email:</label>
                <input type="email" name="email" placeholder="Enter your E-mail address" required value="<?php echo $emailText; ?>" /> 
                <input name="check_email_button" value="Send" type="submit">
            </form>
            
        </div>
        <!-- Ending of Check the Email functionality -->

        <!-- Starging of php info -->
        <div class="form-wrapper">
            
            <form action="TYPO3_Check_Configuration.php" method="post" name="check_email">
                <label>Show full server configurations:</label>                
                <input name="check_phpinfo_button" value="PHP Info" type="submit">
            </form>
            <?php
            
                if ( isset( $_POST['check_phpinfo_button'] ) ) { //Check if the Check Email function is submitted or not.
                    phpinfo();
                }
            ?>    
        </div>        
        <!-- Ending of php info -->
    </div>
</body>
</html>
