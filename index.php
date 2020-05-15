<!DOCTYPE html>
<!--
# Engineer GUI
# Copyright (C) 2020 Wimborne Model Town
# This program is free software: you can redistribute it and/or modify it
# under the terms of the GNU General Public License version 3 or,
# at your option, any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.
-->

<?php include_once 'includes/db.php'; ?>
<?php include_once 'includes/functions.php'; ?>

<?php


//TODO not everything here yet.
$tables = array('SystemStatus', 'EventLog', 'SUMPReadings', 'G3Readings', 'G4Readings', 'G6Readings', 'V4Readings');
$tables_friendly = array('System Status', 'Events', 'SUMP', 'G3', 'G4', 'G6', 'V4');

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

<html lang="en">
    <head>
        <meta charset="utf-8">
    </head>

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
    </body>
</html>
