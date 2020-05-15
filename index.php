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
        <form action="./index.php" method="GET">
            <label for="table">Select a table:</label>

            <!-- Populate this choice box with all the tables and their friendly names --> 
            <select id="table">
                <?php

                foreach ($tables_friendly as $friendly_name) {
                    //Get the actual table name for the value.
                    $index = array_search($tables_friendly, $friendly_name);

                    $name = $tables_friendly[$index];

                    echo "<option value='" . $name . "'>" . $table_name . "</option>";
                }

                ?>
            </select>
        </form>
    </body>
</html>
