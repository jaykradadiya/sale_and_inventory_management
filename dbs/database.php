<?php
if(!isset($_SESSION["empEmail"]))
{
    session_start();
}
define("host","localhost");
define("user","root");
define("password","");
define("database_name","pos");

class database{
    private $connection;
    public function con()
    {
        $this->connection= mysqli_connect(host,user,password);
        mysqli_select_db( $this->connection,database_name);
        if( $this->connection)
        {
            // echo="connected";
            return  $this->connection;
        }
         return "Database_not_connect";
    }
    
}

// $d=new db();
// $d->con();

?>