<?php

/**
 * Basic HTML Liberaries
**/

class lib_html
{
    function line_break()
    {
        echo '<br />';
    }

    function line_break_ret()
    {
        return '<br />';
    }

    function horizon_line()
    {
        echo '<hr>';
    }

    function horizon_line_ret()
    {
        return '<hr>';
    }
}

/**
 * Form Libraries
**/
class lib_form extends lib_html {
    
    function form_start($action,$method)
    {
        echo '<form action="'.$action.'" method="'.$method.'" >';
    }

    function form_start_ret($action,$method)
    {
        return '<form action="'.$action.'" method="'.$method.'" >';
    }
    
    function form_stop()
    {
        echo "</form>";
    }

    function form_out_ret()
    {
        return "</form>";
    }
    
    function form_input_text($name)
    {
        echo '<input type="text" name="'.$name.'" />';
    }
    
    function form_input_text_ret($name)
    {
        return '<input type="text" name="'.$name.'" />';
    }
    
    function form_input_hidden($value)
    {
        echo '<input type="hidden" name="method" value="'.$value.'" />';
    }
    
    function form_input_hidden_ret($value)
    {
        return '<input type="hidden" name="method" value="'.$value.'" />';
    }
    
    function form_input_text_val($name,$val)
    {
        echo '<input type="text" name="'.$name.'" value="'.$val.'" />';
    }

    function form_input_text_val_ret($name,$val)
    {
        return '<input type="text" name="'.$name.'" value="'.$val.'" />';
    }
    
    function form_input_text_req($name)
    {
        echo '<input type="text" name="'.$name.'" required="required" />';
    }

    function form_input_text_req_ret($name)
    {
        return '<input type="text" name="'.$name.'" required="required" />';
    }
    
    function form_input_password($name)
    {
        echo '<input type="password" name="'.$name.'" required="required" />';
    }

    function form_input_password_ret($name)
    {
        return '<input type="password" name="'.$name.'" required="required" />';
    }

    function form_input_email($name)
    {
        echo '<input type="email" name="'.$name.'" required="required" />';
    }

    function form_input_email_ret($name)
    {
        return '<input type="email" name="'.$name.'" required="required" />';
    }

    function form_input_submit($name)
    {
        echo '<input type="submit" name="'.$name.'" required="required" />';
    }
    
    function form_input_submit_ret($name)
    {
        return '<input type="submit" name="'.$name.'" required="required" />';
    }

    function form_input_reset()
    {
        echo '<input type="reset" required="required" />';
    }

    function form_input_reset_ret()
    {
        return '<input type="reset" required="required" />';
    }
}

/**
 * Table Libraries
**/

class lib_table extends lib_form {
    
    function table_start($border,$width)
    {
        echo '<table border="'.$border.'" width="'.$width.'">';
    }

    function table_start_style($border,$width,$class)
    {
        echo '<table border="'.$border.'" width="'.$width.'" class="'.$class.'">';
    }
    
    function table_stop()
    {
        echo '</table>';
    }
    
    function table_tr_start()
    {
        echo '<tr>';
    }
    
    function table_tr_stop()
    {
        echo '</tr>';
    }
    
    function table_td($val)
    {
        echo '<td>'.$val.'</td>';
    }

    function table_td_colspan($colspan, $val)
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

class lib_mysql extends lib_table {
    
    function sql_con_new($host,$user,$pass)
    {
        mysql_connect($host,$user,$pass);
    }

    function sql_con_default()
    {
        mysql_connect("localhost","root","");
    }
    
    function sql_db_select($db_name)
    {
        mysql_select_db($db_name);
    }
    
    function sql_manual_override($sql)
    {
        $result = mysql_query($sql);
        return $result;
    }
    
    function sql_select_one($table,$target)
    {
        $sql = "SELECT $target FROM $table";
        $result = mysql_fetch_array(mysql_query($sql));
        return $result[0];
    }

    function sql_select_one_condition($table,$target,$col_match,$match)
    {
        $sql = "SELECT $target FROM $table WHERE $col_match=$match";
        $result = mysql_fetch_array(mysql_query($sql));
        return $result[0];
    }

    function sql_select_all($table)
    {
        $sql = "SELECT * FROM $table";
        $result = mysql_query($sql);
        return $result;
    }

    function sql_select_all_condition($table,$col_match,$match)
    {
        $sql = "SELECT * FROM $table WHERE $col_match=$match";
        $result = mysql_query($sql);
        return $result;
    }
    
    function sql_data_compare($table,$data1,$data2,$col1,$col2)
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

    function sql_select_multiple_cols($args,$table)
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

class lib_display_query extends lib_mysql
{
    function display_table_clear($data,$table_width)
    {
        $num=mysql_num_rows($data);
        $this->table_start(1,$table_width);
        for($i=0;$i<$num;$i++)
        {
            $this->table_tr_start($data);
            $row=mysql_fetch_row($data);
            $loop=sizeof($row);
            for($j=0;$j<$loop;$j++)
            {
                $this->table_td($row[$j]);
            }
            $this->table_tr_stop();
        }
        $this->table_stop();
    }
}


?>