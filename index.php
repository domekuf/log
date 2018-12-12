<form method="POST">
    <textarea name="new"></textarea>
    <input type="submit"/>
</form>
<?php
    $log = json_decode(file_get_contents("log.json"), true);
    if (isset($_POST["new"])) {
        $l["body"] = $_POST["new"];
        $l["date"] = gmdate("D, d M Y H:i:s", time())." GMT";
        array_unshift($log, $l);
        file_put_contents("log.json", json_encode($log, JSON_PRETTY_PRINT));
    }
    foreach ($log as $l) {
?>
        <h2><?=$l["date"]?></h2>
        <p><?=$l["body"]?></p>
<?php
    }
?>
