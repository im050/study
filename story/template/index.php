<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/>
    <title><?php echo $title; ?></title>
    <link href="<?php echo CSS_PATH ?>/style.css" rel="stylesheet"/>
</head>
<body>
<div class="header">
    MemoryStory
</div>
<div class="wrap">
    <div class="content">
        <ul id="chapters" class="chapters">
            <?php
            foreach ($list as $key => $val) {
                ?>
                <li>
                    <a data-url="<?php echo $val['url']; ?>"
                       href="?action=view&view=<?php echo $val['url']; ?>"><?php echo $val['title']; ?></a>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
</div>
<div class="footer">
    <div class="page-link">
        <a href="javascript: void(0)" id="bookmark">
            最近阅读
        </a>
        <a href="#">
            返回目录
        </a>
        <a href="#">
            程序设置
        </a>
    </div>
</div>
<script>
    window.onload = function () {
        var storage = window.localStorage;
        var history = storage.getItem('history');
        var list = document.getElementsByTagName("a");
        var historyNode = null;
        for (var i in list) {
            var node = list[i];
            if (node.nodeType == 1 && node.hasAttribute("data-url")) {
                var data_url = (node.getAttribute("data-url"));
                if (data_url == history) {
                    node.setAttribute("class", 'cur');
                    historyNode = node;
                }
            }

        }

        document.getElementById("bookmark").onclick = function(){
            if (historyNode != null) {
                window.scrollTo(0, historyNode.offsetTop - 80);
            }
        }

    };
</script>
</body>
</html>