<style>
    form textarea {
        width: 80%;
        height: 25%;
    }
</style>
<?php
require_once "mdb-head.php"
?>
<form method="POST">
    <pre><code><textarea name="body"></textarea></code></pre>
    <input type="submit"/>
</form>
<?php
    // Implementing CRUD (CREATE READ UPDATE DELETE)

    // READ
    $log = json_decode(file_get_contents("log.json"), true);
    if (isset($_POST["body"])) {
        if (!isset($_POST["key"])) {
            // CREATE
            $l["body"] = $_POST["body"];
            $l["date"] = gmdate("D, d M Y H:i:s", time())." GMT";
            array_unshift($log, $l);
        } elseif(!$_POST["delete"]) {
            // UPDATE
            $log[$_POST["key"]]["body"] = $_POST["body"];
        } else {
            // DELETE
            unset($log[$_POST["key"]]);
        }
        file_put_contents("log.json", json_encode($log, JSON_PRETTY_PRINT));
    }
    foreach ($log as $k=>$l) {
?>
        <form method="POST">
            <h3><?=$l["date"]?></h3>
            <pre><code><textarea name="body"><?=$l["body"]?></textarea></code></pre>
            <input name="key" value="<?=$k?>" type="hidden"/>
            <input id="delete-<?=$k?>" name="delete" type="checkbox" value="1"/>
            <label for="delete-<?=$k?>">Delete</label>
            <input type="submit" value="Update"/>
        </form>
<?php
    }
require_once "mdb-foot.php"
?>
