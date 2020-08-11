<?php

/**
 * Server-side file.
 * This file is an infinitive loop. Seriously.
 * It gets the file data.txt's last-changed timestamp, checks if this is larger than the timestamp of the
 * AJAX-submitted timestamp (time of last ajax request), and if so, it sends back a JSON with the data from
 * data.txt (and a timestamp). If not, it waits for one seconds and then start the next while step.
 *
 * Note: This returns a JSON, containing the content of data.txt and the timestamp of the last data.txt change.
 * This timestamp is used by the client's JavaScript for the next request, so THIS server-side script here only
 * serves new content after the last file change. Sounds weird, but try it out, you'll get into it really fast!
 */

include_once('database.php');

set_time_limit(0);

while (true) {

    // 客戶端發Request
    $last_ajax_call = isset($_GET['max']) ? $_GET['max'] : null;

    // 取得當前資料庫資料
    $sql = "select * from `admin`";
    $data = $dbgo->query($sql);
    $row = $data->fetchAll(PDO::FETCH_ASSOC);
    $max_id = array();
    foreach ($row as $key => $value) {
        array_push($max_id, $value['id']);
    }
    // 取出最大id
    $max_id = max($max_id);

    // 如果當前數值大於客戶端的request表示新增
    if ($last_ajax_call == null || $max_id > $max) {

        $result = array(
            'data_from_database' => json_encode($row),
            'id' => $max_id
        );

        // 將資料轉成JSON格式，並呈現結果
        $json = json_encode($result);
        echo $json;

        break;

    } else {

        sleep(5);
        continue;
    }
}
