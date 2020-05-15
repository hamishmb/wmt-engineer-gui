<!--
# Engineer GUI functions
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

function die_if_not_successful_query($result) {
    global $connection;

    if (!$result) {
        die("Query Failed: " . mysql_error($connection));
    }
}

function display_table($table, $table_friendly_name) {
    global $connection;

    ?>

    <article>
        <table>
            <caption><h2><?php echo $table_friendly_name; ?></h2></caption>
            <tr>
                <th>System ID</th>
                <th>Pi Status</th>
                <th>Software Status</th>
                <th>Current Action</th>
            </tr>

    <?php

    //Get everything except the first row.
    $query = "SELECT * FROM " . $table;

    $data_query = mysql_query($query, $connection);
    die_if_not_successful_query($data_query);

    while ($row = mysql_fetch_assoc($data_query)) {
        $ID = $row['System ID'];
        $pi_status = $row['Pi Status'];
        $sw_status = $row['Software Status'];
        $action = $row['Current Action'];
        
    ?>


        <tr>
            <td><?php echo $ID; ?></td>
            <td><?php echo $pi_status; ?></td>
            <td><?php echo $sw_status; ?></td>
            <td><?php echo $action; ?></td>
        </tr>

        <?php } ?>

        </table>
        <br>
    </article>

<?php

}

?>
