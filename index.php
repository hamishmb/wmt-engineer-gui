<!DOCTYPE html>
<?php include_once 'includes/db.php'; ?>
<?php include_once 'includes/functions.php'; ?>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>WMT Engineers GUI</title>
    </head>

<?php

// Engineer GUI
// Copyright (C) 2020-21 Wimborne Model Town
// This program is free software: you can redistribute it and/or modify it
// under the terms of the GNU General Public License version 3 or,
// at your option, any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.

$tables = array('SystemStatus', 'EventLog', 'SystemTick', 'NASControl', 'SUMPReadings', 'SUMPControl',
                'G3Readings', 'G3Control', 'G4Readings', 'G4Control', 'G5Readings', 'G5Control',
                'G6Readings', 'G6Control', 'VALVE1Readings', 'VALVE1Control', 'VALVE2Readings',
                'VALVE2Control', 'VALVE3Readings', 'VALVE3Control', 'VALVE4Readings',
                'VALVE4Control', 'VALVE5Readings', 'VALVE5Control', 'VALVE6Readings',
                'VALVE6Control', 'VALVE7Readings', 'VALVE7Control', 'VALVE8Readings',
                'VALVE8Control', 'VALVE9Readings', 'VALVE9Control', 'VALVE10Readings',
                'VALVE10Control', 'VALVE11Readings', 'VALVE11Control', 'VALVE12Readings',
                'VALVE12Control');

$tables_friendly = array('System Status', 'Events', 'Ticks', 'NASControl', 'SUMP', 'SUMPControl',
                         'G3 (Hanham)', 'G3Control', 'G4 (Wendy)', 'G4Control', 'G5 (Gazebo)',
                         'G5Control', 'G6 (Stage)', 'G6Control', 'VALVE1 (Hanham)',
                         'VALVE1Control', 'VALVE2 (Hanham)', 'VALVE2Control',
                         'VALVE3 (Hanham)', 'VALVE3Control', 'VALVE4 (Wendy)', 'VALVE4Control',
                         'VALVE5 (Gazebo)', 'VALVE5Control', 'VALVE6 (Matrix)', 'VALVE6Control',
                         'VALVE7 (Matrix)', 'VALVE7Control', 'VALVE8 (Matrix)', 'VALVE8Control',
                         'VALVE9 (Matrix)', 'VALVE9Control', 'VALVE10 (TBD)', 'VALVE10Control',
                         'VALVE11 (TBD)', 'VALVE11Control', 'VALVE12 (Stage)', 'VALVE12Control',);

if (isset($_GET['table'])) {
    $table = $_GET['table'];

    //Check that this is a valid table.
    //If not, we will die with an error.
    if (!in_array($table, $tables)) {
        die('Invalid Table Name');

    }

    //If so, get the index of the shortname, and find the user friendly name for it.
    $index = array_search($table, $tables);

    $table_friendly_name = $tables_friendly[$index];

} else {
    $table = 'SystemStatus';
    $index = array_search($table, $tables);
    $table_friendly_name = $tables_friendly[$index];
}

?>

    <body>
        <div id="form">
            <form method="get">
                <label for="table-select">Select a table:</label>

                <!-- Populate this choice box with all the tables and their friendly names --> 
                <select id="table-select" name="table">
                    <?php

                    foreach ($tables_friendly as $friendly_name) {
                        //Get the actual table name for the value.
                        $index = array_search($friendly_name, $tables_friendly);

                        $name = $tables[$index];

                        //Figure out if we should make this option selected.
                        $selected = ($name == $table);

                        if ($selected) {
                            echo "<option value='" . $name . "' selected>" . $friendly_name . "</option>";

                        } else {
                            echo "<option value='" . $name . "'>" . $friendly_name . "</option>";
                        }
                    }

                    ?>
                </select>

                <input type="submit" value="Show">
            </form>
        </div>

        <div id="table">
            <?php display_table($table, $table_friendly_name); ?>
        </div>

        <p style="text-align: center;">Version <?php echo $VERSION; ?></p>

        <script type="text/javascript">
            window.onload = setTimeout(function(){
                location.reload();
            },30000)
        </script>
        
    </body>
</html>
