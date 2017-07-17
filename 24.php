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
    ?>
    <table border='1' align='center'>
        <tr>
            <td width=20 align='center'><?php srand(rand(1,$seed)); echo rand(1,13);?></td>
            <td width=20 align='center'><?php srand(rand(1,$seed)); echo rand(1,13);?></td>
            <td width=20 align='center'><?php srand(rand(1,$seed)); echo rand(1,13);?></td>
            <td width=20 align='center'><?php srand(rand(1,$seed)); echo rand(1,13);?></td>
        <tr>
    </table>
    </body>
</html>
