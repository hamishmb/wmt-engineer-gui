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
    if ($table == "SystemStatus") {
        display_systemstatus($table, $table_friendly_name);

    } else if ($table == "EventLog") {
        display_eventlog($table, $table_friendly_name);

    } else if ($table == "SystemTick") {
        display_systemtick($table, $table_friendly_name);

    } else if (preg_match("/Readings/i", $table)){
        display_readingstable($table, $table_friendly_name);

    } else if (preg_match("/Control/i", $table)){
        display_controltable($table, $table_friendly_name);

    }
}

function display_systemstatus($table, $table_friendly_name) {
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
    $query = "SELECT * FROM " . $table . " ORDER BY ID DESC LIMIT 0, 50";

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

function display_eventlog($table, $table_friendly_name) {
    global $connection;

    ?>

    <article>
        <table>
            <caption><h2><?php echo $table_friendly_name; ?></h2></caption>
            <tr>
                <th>Site ID</th>
                <th>Severity</th>
                <th>Event</th>
                <th>Device Time</th>
            </tr>

    <?php

    //Get everything except the first row.
    $query = "SELECT * FROM " . $table . " ORDER BY ID DESC LIMIT 0, 50";

    $data_query = mysql_query($query, $connection);
    die_if_not_successful_query($data_query);

    while ($row = mysql_fetch_assoc($data_query)) {
        $ID = $row['Site ID'];
        $severity = $row['Severity'];
        $event = $row['Event'];
        $time = $row['Device Time'];
        
    ?>

        <tr>
            <td><?php echo $ID; ?></td>
            <td><?php echo $severity; ?></td>
            <td><?php echo $event; ?></td>
            <td><?php echo $time; ?></td>
        </tr>

        <?php } ?>

        </table>
        <br>
    </article>

<?php

}

function display_systemtick($table, $table_friendly_name) {
    global $connection;

    ?>

    <article>
        <table>
            <caption><h2><?php echo $table_friendly_name; ?></h2></caption>
            <tr>
                <th>Tick</th>
                <th>System Time</th>
            </tr>

    <?php

    //Get everything except the first row.
    $query = "SELECT * FROM " . $table . " ORDER BY ID DESC LIMIT 0, 50";

    $data_query = mysql_query($query, $connection);
    die_if_not_successful_query($data_query);

    while ($row = mysql_fetch_assoc($data_query)) {
        $tick = $row['Tick'];
        $time = $row['System Time'];
        
    ?>

        <tr>
            <td><?php echo $tick; ?></td>
            <td><?php echo $time; ?></td>
        </tr>

        <?php } ?>

        </table>
        <br>
    </article>

<?php

}

function display_readingstable($table, $table_friendly_name) {
    global $connection;

    ?>

    <article>
        <table>
            <caption><h2><?php echo $table_friendly_name; ?></h2></caption>
            <tr>
                <th>Probe ID</th>
                <th class="nonessential">Tick</th>
                <th class="nonessential">Measure Time</th>
                <th>Value</th>
                <th class="nonessential">Status</th>
            </tr>

    <?php

    //Get everything except the first row.
    $query = "SELECT * FROM " . $table . " ORDER BY `Tick` DESC, `Probe ID` DESC LIMIT 0, 50";

    $data_query = mysql_query($query, $connection);
    die_if_not_successful_query($data_query);

    while ($row = mysql_fetch_assoc($data_query)) {
        $ID = $row['Probe ID'];
        $tick = $row['Tick'];
        $time = $row['Measure Time'];
        $value = $row['Value'];
        $status = $row['Status'];
        
    ?>

        <tr>
            <td><?php echo $ID; ?></td>
            <td class="nonessential"><?php echo $tick; ?></td>
            <td class="nonessential"><?php echo $time; ?></td>
            <td><?php echo $value; ?></td>
            <td class="nonessential"><?php echo $status; ?></td>
        </tr>

        <?php } ?>

        </table>
        <br>
    </article>

<?php

}

function display_controltable($table, $table_friendly_name) {
    global $connection;

    ?>

    <article>
        <table>
            <caption><h2><?php echo $table_friendly_name; ?></h2></caption>
            <tr>
                <th>Device ID</th>
                <th>Device Status</th>
                <th>Request</th>
                <th>Locked By</th>
            </tr>

    <?php

    //Get everything except the first row.
    $query = "SELECT * FROM " . $table . " ORDER BY `Device ID` ASC LIMIT 0, 50";

    $data_query = mysql_query($query, $connection);
    die_if_not_successful_query($data_query);

    while ($row = mysql_fetch_assoc($data_query)) {
        $ID = $row['Device ID'];
        $status = $row['Device Status'];
        $request = $row['Request'];
        $lockedby = $row['Locked By'];
        
    ?>

        <tr>
            <td><?php echo $ID; ?></td>
            <td><?php echo $status; ?></td>
            <td><?php echo $request; ?></td>
            <td><?php echo $lockedby; ?></td>
        </tr>

        <?php } ?>

        </table>
        <br>
    </article>

<?php

}

?>
