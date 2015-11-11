<?
    include_once 'db.php';

    $db = new db();

    for(;;)
    {
        $result = $db->mysqli->query("select remove_packet from system where 1");
        $row = $result->fetch_array(MYSQL_ASSOC);
        $sleep_count = $row['remove_packet'];

        $move_data_sql = "INSERT INTO backup_packets SELECT * FROM packets";

        $db->mysqli->query($move_data_sql);

        $truncate_sql = "TRUNCATE table packets";

        $db->mysqli->query($truncate_sql);

        sleep($sleep_count);
    }
?>