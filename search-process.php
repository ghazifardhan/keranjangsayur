<?php
if(isset($_GET['term']) && !empty($_GET['term']))
{
    $result = array(
        array('id'=>1, 'value'=>'jakarta'),
        array('id'=>2, 'value'=>'jabar')
    );
    echo json_encode($result);
}
 
if(isset($_GET['act']) && $_GET['act']=='getkota')
{
    if($_GET['idkota'] == 1)
    {
        echo <<<OPT
            <option value="senen">senen</option>
            <option value="gambir">gambir</option>
            <option value="cikini">cikini</option>
OPT;
    }
    elseif($_GET['idkota'] == 2)
    {
        echo <<<OPT
            <option value="bogor">bogor</option>
            <option value="bandung">bandung</option>
OPT;
    }
    else
    {
        echo '';
    }
}