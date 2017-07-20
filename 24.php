<html>
<head>
    <link rel='icon' href='/ico/24.ico'>
    <link rel='apple-touch-icon' href='/ico/24.jpg'>
    <title>24点</title>
</head>
<body>
<?php
$Tab4 = "    ";
$seed = 200000;
srand(rand(1,time()-$seed*rand(1,50)));
for ($i=0; $i<=3; ++$i) {
    srand(rand(1,$seed)); 
    $value[] = rand(1,13);
};
set_time_limit(0);   
$result = 24;  
$list = array();  
//$value=array(9,4,7,7);
makeValue($value);   
$res = "无解";
if (count($list)>=1) {
    $res = "有解";
}
?>
    <table border='1' align='center'>
        <tr>
<?php
for ($i=0; $i<=3; ++$i) {
    echo $Tab4.$Tab4.$Tab4 . "<td width=20 align='center'>" . $value[$i] . "</td>" . "\n";
}
?>
        </tr>
    </table>
    <div align='center'><?php echo $res;?></div>
</body>
</html>

<?php
// echo "<pre>";   
// print_r($list);  

function makeValue($values, $set=array())   
{   
    $words = array("+", "-", "*", "/");   
    if(sizeof($values)==1)   
    {   
        $set[] = array_shift($values);   
        return makeSpecial($set);   
    }   

    foreach($values as $key=>$value)   
    {   
        $tmpValues = $values;   
        unset($tmpValues[$key]);   
        foreach($words as $word)   
        {   
            makeValue($tmpValues, array_merge($set, array($value, $word)));   
        }   
    }   
}   

function makeSpecial($set)   
{   
    $size = sizeof($set);  

    if($size<=3 || !in_array("/", $set) && !in_array("*", $set))   
    {   
        return makeResult($set);   
    }  

    for($len=3; $len<$size-1; $len+=2)   
    {   
        for($start=0; $start<$size-1; $start+=2)   
        {   
            if(!($set[$start-1]=="*" || $set[$start-1]=="/" || $set[$start+$len]=="*" || $set[$start+$len]=="/"))   
                continue;   
            $subSet = array_slice($set, $start, $len);   
            if(!in_array("+", $subSet) && !in_array("-", $subSet))   
                continue;   
            $tmpSet = $set;   
            array_splice($tmpSet, $start, $len-1);   
            $tmpSet[$start] = "(".implode("", $subSet).")";   
            makeSpecial($tmpSet);   
        }   
    }   
}  
function makeResult($set)   
{   
    global $result, $list;   
    $str = implode("", $set);   
    @eval("\$num=$str;");   
    if($num==$result && !in_array($str, $list))   
        $list[] = $str;   
}  
?>  
