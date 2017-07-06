<html>
    <head>
        <link rel='icon' href='book.ico'>
        <link rel='apple-touch-icon' href='iphone_icon.png'>
        <title>买没买过</title>
        <link rel='stylesheet' type='text/css' href='book.css'>
    </head>
    <body>
<?php
date_default_timezone_set("Asia/Shanghai");
/*
echo "<html>" . "\n";
echo "<head>" . "\n";
echo "<link href='book.ico' rel='shortcut ico'>" . "\n";
echo "<link rel='apple-touch-icon' href='iphone_icon.png'>" . "\n";
echo "<title>买没买过</title>" . "\n";
echo "<link rel='stylesheet' type='text/css' href='book.css'>" . "\n";
echo "</head>" . "\n";
*/


$filename = "book.txt";
$update_time = date("Y-m-d", filemtime($filename));
$fp = fopen($filename, "r");
$last_num = false;
$current_num = false;
$total = 0;
//$found_rows[];
while ( $line = fgets($fp) ) {
    $row = explode(",", $line);
    $last_num = $current_num;
    $current_num = is_numeric($row[0]);
    if ($current_num && $last_num) {
        $total = intval($row[0]);
    }
}
fclose($fp);
$status = "更新时间 " . $update_time . " 共 " . $total . " 本";
?>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <div class='table-b'><table border='0'><tr><td><?php echo $status;?></td></tr></table></div>
            <input type='text' name='bookname'  id='searched_content' title='书名' />
            <input type='submit' name='submit' value='Go' id='search' title='gogogo' />
        </form>
<?php
/*
echo "<div class='table-b'><table border='0'><tr><td>". $status . "</td></tr></table>" . "\n";
echo "<input type='text' name='bookname'  id='searched_content' title='书名' />" . "\n";
echo "<input type='submit' value='Go' class='button' id='search' title='gogogo' />" . "\n";
*/
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search_name = trim($_POST["bookname"]);
    $fp = fopen($filename, "r");
    $tblStr = "";
    while ( $line = fgets($fp) ) {
        $row = explode(",", $line);
        $pos = strpos($row[3], $search_name);
        if ($pos === false) {
        } else {
            $found_rows[] = $row;
        }
    }
    fclose($fp);
    if (count($found_rows) > 0) {
        foreach ($found_rows as $row) {
            $tblStr .= "            <tr><td class='table-x'>" . "序号" . "</td><td>" . $row[0] . "</td></tr>" . "\n";
            $tblStr .= "            <tr><td class='table-x'>" . "编号" . "</td><td>" . $row[1] . "</td></tr>" . "\n";
            $tblStr .= "            <tr><td class='table-x'>" . "书名" . "</td><td>" . $row[3];			
            if ($row[4].length>0) {
                $tblStr .= (" - " . $row[4]);
            };
            $tblStr .= "</td></tr>" . "\n";
            $tblStr .= "            <tr><td class='table-x'>" . "作者" . "</td><td>" . $row[5] . "</td></tr>" . "\n";
            $tblStr .= "            <tr><td class='table-x'>" . "ISBN" . "</td><td>" . "<a target='_blank' href='https://book.douban.com/subject_search?search_text=" . $row[13] . "'>" . $row[13] . "</a>" . "</td></tr>" . "\n";
            $tblStr .= "            <tr><td class='table-x'>" . "状态" . "</td><td>" . $row[2] . "</td></tr>" . "\n";
            $tblStr .= "            <tr><td class='table-x'>" . "出版日期" . "</td><td>" . $row[7] . "</td></tr>" . "\n";
            $tblStr .= "            <tr><td class='table-x'>" . "购买日期" . "</td><td>" . $row[16] . "</td></tr>" . "\n";
            if ($row[17].length>0) {
                $tblStr .= "            <tr><td class='table-x'>" . "阅读日期" . "</td><td>" . $row[17] . "</td></tr>" . "\n";
            };
            if ($row[18].length>0) {
                $tblStr .= "            <tr><td class='table-x'>" . "" . "</td><td>" . $row[18] . "</td></tr>" . "\n";
            };
            if ($row[19].length>0) {
                $tblStr .= "            <tr><td class='table-x'>" . "打分" . "</td><td>" . $row[19] . "</td></tr>" . "\n";
            };
            if ($row[20].length>0) {
                $tblStr .= "            <tr><td class='table-x'>" . "简评" . "</td><td>" . $row[20] . "</td></tr>" . "\n";
            };
            if ($row[21].length>0) {
                $tblStr .= "            <tr><td class='table-x'>" . "江湖地位" . "</td><td>" . $row[21] . "</td></tr>" . "\n";
            };

            $tblStr .= "            <tr><td>----------</td></tr>" . "\n";
        }
        $tblStr .= "        </table></div>" . "\n";
        $tblStr = "        <div class='table-b'><table border='0'>" . "\n" . "            <tr><td>" . "【找到 " . count($found_rows) . " 本 \"". $search_name . "\"】" . "</td></tr>" . "\n" . $tblStr;
    } else {
        $tblStr = "        <div class='table-b'><table><tr></tr><tr><td>没买过 \"" . $search_name . "\" </td></tr></table></div>" . "\n";
    }
    echo $tblStr;
}
?>
    </body>
<html>
