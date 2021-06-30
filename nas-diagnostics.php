<!DOCTYPE html>
<?php include_once 'includes/db.php'; ?>
<?php include_once 'includes/functions.php'; ?>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>WMT Engineers GUI - NAS Box Diagnostics</title>
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

?>

    <body>
        <?php include_once 'nav.html'; ?>
        <h4>Uptime</h4>
        <p>
        <?php
        $output = null;
        $retval = null;
        
        exec('cat /proc/uptime', $output, $retval);

        foreach($output as $line) {
            echo $line . "<br />";

        }
        ?>
        </p>

        <h4>CPU and Memory Usage</h4>
        <p>
        <?php
        $output = null;
        $retval = null;
        
        exec('top -bn1', $output, $retval);

        foreach($output as $line) {
            echo $line . "<br />";

        }
        ?>
        </p>

        <h4>RAID Array Status</h4>
        <p>
        <?php
        $output = null;
        $retval = null;
        
        exec('mdadm -D /dev/md1', $output, $retval);

        foreach($output as $line) {
            echo $line . "<br />";

        }
        ?>
        </p>

        <h4>Free Space</h4>
        <p>
        <?php
        $output = null;
        $retval = null;
        
        exec('df -h', $output, $retval);

        foreach($output as $line) {
            echo $line . "<br />";

        }
        ?>
        </p>

        <p style="text-align: center;">Version <?php echo $VERSION; ?></p>

        <script type="text/javascript">
            window.onload = setTimeout(function(){
                location.reload();
            },30000)
        </script>
        
    </body>
</html>
