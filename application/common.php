<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 防xss 过滤


function SafeFilter (&$arr)
{

    $ra=Array('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/','/script/','/javascript/','/vbscript/','/expression/','/applet/','/meta/','/xml/','/blink/','/link/','/style/','/embed/','/object/','/frame/','/layer/','/title/','/bgsound/','/base/','/onload/','/onunload/','/onchange/','/onsubmit/','/onreset/','/onselect/','/onblur/','/onfocus/','/onabort/','/onkeydown/','/onkeypress/','/onkeyup/','/onclick/','/ondblclick/','/onmousedown/','/onmousemove/','/onmouseout/','/onmouseover/','/onmouseup/','/onunload/');

    if (is_array($arr))
    {
        foreach ($arr as $key => $value)
        {
            if (!is_array($value))
            {
                if (!get_magic_quotes_gpc())             //不对magic_quotes_gpc转义过的字符使用addslashes(),避免双重转义。
                {
                    $value  = addslashes($value);           //给单引号（'）、双引号（"）、反斜线（\）与 NUL（NULL 字符）加上反斜线转义
                }
                $value       = preg_replace($ra,'',$value);     //删除非打印字符，粗暴式过滤xss可疑字符串
                $arr[$key]     = htmlentities(strip_tags($value)); //去除 HTML 和 PHP 标记并转换为 HTML 实体
            }
            else
            {
                SafeFilter($arr[$key]);
            }
        }
    }
}

function is_empty_data()
{
    $num_info = func_num_args();  //返回传递给该函数参数的个数
    $data = func_get_args();  // 返回包含所有参数的数组
    $num = 0;

    foreach ($data as $k => $v) {
        if (!empty($v)||$v!= null ||$v=== 0) {
            $num++;
        }
    }
    if ($num != $num_info) {
        $data=array(
            'status'=>0,
            'message'=>'请传递正确参数'
        );
        exit(json_encode($data));
    } else {
        $is_ture = 1;
        return $is_ture;

    }

}