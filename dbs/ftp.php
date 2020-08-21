<?php

class ftp 
{
    private $ftp_conn;
    public function __construct()
    {
        $ftp_server = "ftpupload.net";
        $ftp_username="epiz_26525166";
        $ftp_userpass="pvdj5D8ipF";
        $this->ftp_conn = ftp_connect($ftp_server,21,90) or die("Could not connect to $ftp_server");
        $login = ftp_login($this->ftp_conn, $ftp_username, $ftp_userpass);
        if($login)
        {
            // echo "connected";
        }
        ftp_pasv($this->ftp_conn, true);
        if(ftp_chdir($this->ftp_conn, "/htdocs/photos"))
        {
            // echo "Current directory is now: " . ftp_pwd($this->ftp_conn) . "\n";
        }
        else { 
            // echo "Couldn't change directory\n";
        }
    }

    // public function getconn()
    // {
    //     return $ftp_conn;
    // }

    public function __destruct()
    {
        ftp_close($this->ftp_conn);
    }


    public function putfile($filename,$filepath)
    {
        $source_file=$filepath;
        $remote_file_path = time().$filename;
        if(!empty($filename))
        {$upload = ftp_put($this->ftp_conn, $remote_file_path, $source_file, FTP_BINARY); 
        if (!$upload) { 
        return "FTP_upload_has_failed!";
        } else {
        return $remote_file_path;
        }}
    }

    public function getfile($filename,$newfilename)
    {
        if(!empty($filename)&& !file_exists("pic/". $newfilename))
        {$download = ftp_get($this->ftp_conn,"pic/". $newfilename,$filename, FTP_BINARY); 
        if (!$download) { 
        return "fail";
        } else {
        return "success";
        }
        }
    }

    public function delpic($filename)
    {
        if(!empty($filename))
       {
        if (ftp_delete($this->ftp_conn, $filename)) {
            echo "$file deleted successful\n";
           } else {
            echo "could not delete $file\n";
           }
       }  
     }
}

?>