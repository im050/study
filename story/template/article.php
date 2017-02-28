<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/>
    <title><?php echo $title; ?></title>
    <link href="<?php echo CSS_PATH ?>/style.css" rel="stylesheet" />
</head>
<body>
<div class="header">
    <?php echo $article->title; ?>
</div>
<div class="wrap">
    <div class="content">
        <?php echo $article->content; ?>
    </div>
</div>
<div class="footer">
    <div class="page-link">
        <a href="<?php echo '?action=view&view=' . $article->preFileName; ?>">
            << 上一页
        </a>
        <a href="<?php echo 'index.php' ?>">
            回到目录
        </a>
        <a href="<?php echo '?action=view&view=' . $article->nextFileName; ?>">
            下一页 >>
        </a>
    </div>
</div>
<script>
    var storage = window.localStorage;
    window.onload = function(){
        storage.setItem("history", '<?php echo $_GET['view']; ?>');
        var historyScrollY = storage.getItem("historyScrollY");
        var recordInfo = historyScrollY.split(",");
        if (recordInfo[0] == '<?php echo $_GET['view']; ?>') {
            window.scrollTo(0, recordInfo[1]);
        }
    }

    window.onscroll = function(){
        storage.setItem("historyScrollY", "<?php echo $_GET['view']; ?>," + window.scrollY);
    }
</script>
</body>
</html>