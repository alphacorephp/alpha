<?php

/**
 * Form Libraries
**/
class lib_form {
    
    function in($action,$method)
    {
        echo '<form action="'.$action.'" method="'.$method.'" >';
    }

    function form_in_ret($action,$method)
    {
        return '<form action="'.$action.'" method="'.$method.'" >';
    }
    
    function form_out()
    {
        echo "</form>";
    }

    function form_out_ret()
    {
        return "</form>";
    }
    
    function input_text($name)
    {
        echo '<input type="text" name="'.$name.'" />';
    }
    
    function input_text_ret($name)
    {
        return '<input type="text" name="'.$name.'" />';
    }
    
    function input_hidden($value)
    {
        echo '<input type="hidden" name="method" value="'.$value.'" />';
    }
    
    function input_hidden_ret($value)
    {
        return '<input type="hidden" name="method" value="'.$value.'" />';
    }
    
    function input_text_val($name,$val)
    {
        echo '<input type="text" name="'.$name.'" value="'.$val.'" />';
    }

    function input_text_val_ret($name,$val)
    {
        return '<input type="text" name="'.$name.'" value="'.$val.'" />';
    }
    
    function input_text_req($name)
    {
        echo '<input type="text" name="'.$name.'" required="required" />';
    }

    function input_text_req_ret($name)
    {
        return '<input type="text" name="'.$name.'" required="required" />';
    }
    
    function input_password($name)
    {
        echo '<input type="password" name="'.$name.'" required="required" />';
    }

    function input_password_ret($name)
    {
        return '<input type="password" name="'.$name.'" required="required" />';
    }

    function input_email($name)
    {
        echo '<input type="email" name="'.$name.'" required="required" />';
    }

    function input_email_ret($name)
    {
        return '<input type="email" name="'.$name.'" required="required" />';
    }

    function input_submit($name)
    {
        echo '<input type="submit" name="'.$name.'" required="required" />';
    }
    
    function input_submit_ret($name)
    {
        return '<input type="submit" name="'.$name.'" required="required" />';
    }

    function input_reset()
    {
        echo '<input type="reset" required="required" />';
    }

    function input_reset_ret()
    {
        return '<input type="reset" required="required" />';
    }

    function line_break()
    {
        echo '<br />';
    }

    function line_break_ret()
    {
        return '<br />';
    }
}

/**
 * Table Libraries
**/

class lib_table {
    
    function start_table($border,$width)
    {
        echo '<table border="'.$border.'" width="'.$width.'">';
    }

    function start_table_style($border,$width,$class)
    {
        echo '<table border="'.$border.'" width="'.$width.'" class="'.$class.'">';
    }
    
    function stop_table()
    {
        echo '</table>';
    }
    
    function tr_in()
    {
        echo '<tr>';
    }
    
    function tr_out()
    {
        echo '</tr>';
    }
    
    function td($val)
    {
        echo '<td>'.$val.'</td>';
    }

    function td_colspan($colspan, $val)
    {
        echo '<td colspan="'.$colspan.'">'.$val.'</td>';
    }

}

/**
 * Post Methods Libraries
**/

class post_method {
    
    function m_01()
    {
        echo "Hello method 01<br>";
        $d=$_POST['uname'];
        echo "It's ".$d;
    }
}

class lib_session {
    
    function session_in()
    {
        session_start();
    }
    
    function session_out()
    {
        session_destroy();
    }
    
    function session_set_new($name, $val)
    {
        $_SESSION[$name]=$val;
    }
    
    function session_assign_to_var($name,$var)
    {
        $$var=$_SESSION[$name];
        return $$var;
    }
}

class lib_mysql {
    
    function con_new($host,$user,$pass)
    {
        mysql_connect($host,$user,$pass);
    }
    
    function db_select($db_name)
    {
        mysql_select_db($db_name);
    }
    
    function query_manual_override($sql)
    {
        $result = mysql_query($sql);
        return $result;
    }
    
    function query_select_one($table,$target)
    {
        $sql = "SELECT $target FROM $table";
        $result = mysql_fetch_array(mysql_query($sql));
        return $result[0];
    }

    function query_select_one_condition($table,$target,$col_match,$match)
    {
        $sql = "SELECT $target FROM $table WHERE $col_match=$match";
        $result = mysql_fetch_array(mysql_query($sql));
        return $result[0];
    }

    function query_select_all($table)
    {
        $sql = "SELECT * FROM $table";
        $result = mysql_query($sql);
        return $result;
    }

    function query_select_all_condition($table,$col_match,$match)
    {
        $sql = "SELECT * FROM $table WHERE $col_match=$match";
        $result = mysql_query($sql);
        return $result;
    }
    
    function query_data_compare($table,$data1,$data2,$col1,$col2)
    {
        $sql = "SELECT $col2 FROM $table WHERE $col1=$data1";
        $query=mysql_query($sql);
        $result=mysql_fetch_array($query);
        if($data2==$result[0])
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    function query_select_multiple_ar($args,$table)
    {
        $numargs = sizeof($args);
        $pre_sql="";
        for($i=0;$i<$numargs;$i++)
        {
            if($i==0)
            {
                $pre_sql = "$args[$i]";
            }
            else
            {
                $pre_sql = $pre_sql.","."$args[$i]";
            }
        }
        $sql = "SELECT $pre_sql FROM $table";
        $result = mysql_query($sql);
        return $result;
    }
    
}

class lib_display_query extends lib_table
{
    function display_table_clear($data,$table_width)
    {
        $num=mysql_num_rows($data);
        $this->start_table(1,$table_width);
        for($i=0;$i<$num;$i++)
        {
            $this->tr_in();
            $row=mysql_fetch_row($data);
            $loop=sizeof($row);
            for($j=0;$j<$loop;$j++)
            {
                $this->td($row[$j]);
            }
            $this->tr_out();
        }
        $this->stop_table();
    }
}


?>