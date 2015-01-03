<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
<title>HKTV 免登入睇點播</title>
<script type="text/javascript">
    var adfly_id = 71043;
    var adfly_advert = 'int';
    var adfly_domain = 'go.eservice-hk.net';
    var frequency_cap = 5;
    var frequency_delay = 5;
    var init_delay = 3;
    var popunder = false;
</script>
<script src="https://cdn.adf.ly/js/entry.js"></script>
</head>

<body>
<?php
$url = 'http://live.eservice-hk.net/hktv?vid=';
$lists_page = $_GET['page'] ? $_GET['page'] : '1';
$lists_lim = $_GET['lim'] ? $_GET['lim'] : '6';
$lists_ofs = $lists_page * $lists_lim - $lists_lim;
$lists_json = json_decode(file_get_contents("https://ott-www.hktvmall.com/api/lists/getProgram?lim={$lists_lim}&ofs={$lists_ofs}"), true);
$lists_total_page = ceil($lists_json['total_videos']/$lists_lim);
if($lists_page <= $lists_total_page) {
    foreach($lists_json['videos'] as $program_x => $program_x_value) {
        echo "<h1>{$program_x_value['title']}</h1>";
        echo "<br>";
        echo "<img src='{$program_x_value['thumbnail']}' alt='{$program_x_value['title']}'>";
        echo "<br>";
        rsort($program_x_value['child_nodes']);
        foreach($program_x_value['child_nodes'] as $program_y => $program_y_value) {
            echo "<span>{$program_y_value['title']}</span>";
            echo " | ";
            //echo "<a href='download.php?vid={$program_y_value['video_id']}&section=&name=".urlencode($program_z_value['title'])."'>Download</a>";
            echo "<br>";
            sort($program_y_value['child_nodes']);
            foreach($program_y_value['child_nodes'] as $program_z => $program_z_value) {
                echo "<a href='{$url}{$program_z_value['video_id']}'>{$program_z_value['title']}</a>";
                //echo " | ";
                //echo "<a href='download.php?vid={$program_z_value['video_id']}&name=".urlencode($program_z_value['title'])."'>Download</a>";
                echo "<br>";
            }
        }
        echo "<br>";
    }
    if($lists_page > '1') {
        $lists_pervious_page = $lists_page - '1';
        echo "<a href='?page={$lists_pervious_page}'><&nbsp;</a>";
    }
    echo "Page {$lists_page} of {$lists_total_page}";
    if($lists_page < $lists_total_page) {
        $lists_next_page = $lists_page + '1';
        echo "<a href='?page={$lists_next_page}'>&nbsp;></a>";
    }
} else {
    echo "Page not found";
}
?>
</body>

</html>
