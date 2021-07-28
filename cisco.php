<?php


class Cisco
{

    private $_hostname;
    private $_password;
    private $_username;
    private $_connection;
    private $_data;
    private $_timeout;
    private $_prompt;
    private $_inter_port;
    private $nomor;
    private $nama;
    private $port;
    private $port2;

    public function __construct($hostname, $password, $username = "", $timeout = 10)
    {
        $this->_hostname = $hostname;
        $this->_password = $password;
        $this->_username = $username;
        $this->_timeout = $timeout;
    } // __construct


    public function connect()
    {

        $this->_connection = fsockopen($this->_hostname, 2334, $errno, $errstr, $this->_timeout);
        if ($this->_connection === false) {
            die("Error: Connection Failed for $this->_hostname\n");
        } // if
        stream_set_timeout($this->_connection, $this->_timeout);
        $this->_readTo(':');
        if (substr($this->_data, -9) == 'Username:') {
            $this->_send($this->_username);
            $this->_readTo(':');
        } // if
        $this->_send($this->_password);
        $this->_prompt = '>';
        $this->_readTo($this->_prompt);
        if (strpos($this->_data, $this->_prompt) === false) {
            fclose($this->_connection);
            die("Error: Authentication Failed for $this->_hostname\n");
        } // if
    } // connect

    public function get_list_acl($password1)
    {
        $this->_send('sh access-list');
        $this->_readTo($this->_prompt);
        $result = array();
        $this->_data = explode("\n", $this->_data);
        array_shift($this->_data);
        array_pop($this->_data);
        $result = array();
        foreach ($this->_data as $key => $entry) {
            if (substr($entry, 0, 8) == 'Standard') {
                array_push($result, substr($entry, 23));
            }
            //array_push($result,substr($entry,0,8));

            // if
        } // foreach
        //$this->_data = $result;
        return $result;
    }


    public function grouping_acl($password1, $port, $name, $direction)
    {
        $result = false;
        if ($this->_prompt != '#') {
            $this->_send('en');
            $this->_readTo(':');
            $this->_send($password1);
        } // if
        if ($this->_data !== false) {
            $this->_prompt = '#';

            $this->_send('configure terminal');
            $this->_readTo($this->_prompt);

            $this->_send('interface ' . $port);
            $this->_readTo($this->_prompt);

            $this->_send('ip access-group ' . $name . ' ' . $direction);
            $this->_readTo($this->_prompt);
            $result = true;
        }

        return $result;
    }

    public function del_acl($password1, $name)
    {
        if ($this->_prompt != '#') {
            $this->_send('en');
            $this->_readTo(':');
            $this->_send($password1);
        }
            $this->_send('configure terminal');
            $this->_readTo($this->_prompt);

            $this->_send('no ip access-list standar ' . $name);
            $this->_readTo($this->_prompt);
            $result = true;
        
        return $result;
    }
    

    public function sh_acl($password1)
    {
        if ($this->_prompt != '#') {
            $this->_send('en');
            $this->_readTo(':');
            $this->_send($password1);
        }
        $this->_send('sh run');
        $this->_readTo($this->_prompt);
        echo '<pre>';
        echo $this->_data;
        echo '</pre>';
   
    }

    public function ungrouping_acl($password1, $port, $name, $direction)
    {
        $result = false;
        if ($this->_prompt != '#') {
            $this->_send('en');
            $this->_readTo(':');
            $this->_send($password1);
        } // if
        if ($this->_data !== false) {
            $this->_prompt = '#';

            $this->_send('configure terminal');
            $this->_readTo($this->_prompt);

            $this->_send('interface ' . $port);
            $this->_readTo($this->_prompt);

            $this->_send('no ip access-group ' . $name . ' ' . $direction);
            $this->_readTo($this->_prompt);
            $result = true;
        }

        return $result;
    }

    public function create_acl($password1, $name_acl, $host, $kondisi, $ip, $wildcard)
    {
        /*print_r(array(
        "name" => $name_acl,
        "hots" => $host,
        "kondisi" => $kondisi,
        "ip" => $ip,
        "wildcard" => $wildcard,
    ));
    die();*/

        $result = false;
        if ($this->_prompt != '#') {
            $this->_send('en');
            $this->_readTo(':');
            $this->_send($password1);
        } // if
        if ($this->_data !== false) {
            $this->_prompt = '#';

            $this->_send('configure terminal');
            $this->_readTo($this->_prompt);

            $this->_send('ip access-list standard ' . $name_acl);
            $this->_readTo($this->_prompt);

            if ($kondisi == 'permit') {
                if ($host == 'network') {
                    $this->_send('permit ' . $ip . ' ' . $wildcard);
                    $this->_readTo($this->_prompt);
                } else if ($host == 'host') {
                    $this->_send('permit host ' . $ip);
                    $this->_readTo($this->_prompt);
                } else if ($host == "any") {
                    $this->_send('permit any ');
                    $this->_readTo($this->_prompt);
                }
            } else {
                if ($host == 'network') {
                    $this->_send('deny ' . $ip . ' ' . $wildcard);
                    $this->_readTo($this->_prompt);
                } else if ($host == 'host') {
                    $this->_send('deny host ' . $ip);
                    $this->_readTo($this->_prompt);
                } else {
                    $this->_send('deny any ');
                    $this->_readTo($this->_prompt);
                }
            }

            $result = true;
        } // if

        $this->_readTo($this->_prompt);
        return $result;
    } // enable

    public function geta_acl($password1, $name_acl)
    {
        /*print_r(array(
        "name" => $name_acl,
        "hots" => $host,
        "kondisi" => $kondisi,
        "ip" => $ip,
        "wildcard" => $wildcard,
    ));
    die();*/

        $result = false;
        if ($this->_prompt != '#') {
            $this->_send('en');
            $this->_readTo(':');
            $this->_send($password1);
        } // if
        if ($this->_data !== false) {
            $this->_prompt = '#';

            $this->_send('configure terminal');
            $this->_readTo($this->_prompt);

            $this->_send('sh access-list');
            $this->_readTo($this->_prompt);
            $result = true;
        } // if

        $this->_readTo($this->_prompt);
        return $result;
    } // if




    public function close()
    {
        $this->_send('quit');
        fclose($this->_connection);
    } // close


    private function _send($command)
    {
        fputs($this->_connection, $command . "\r\n");
    } // _send


    private function _readTo($char)
    {
        // Reset $_data
       
        $this->_data = "";
        while (($c = fgetc($this->_connection)) !== false) {
            $this->_data .= $c;
            if ($c == $char[0]) break;
            if ($c == '-') {
                // Continue at --More-- prompt
                if (substr($this->_data, -8) == '--More--') fputs($this->_connection, ' ');
             //   echo  $this->_data, -8;
            } // if
        } // while
        // Remove --More-- and backspace
        $this->_data = str_replace('--More--', "", $this->_data);
        $this->_data = str_replace(chr(8), "", $this->_data);
        // Set $_data as false if previous command failed.
        if (strpos($this->_data, '% Invalid input detected') !== false) $this->_data = false;
    } // _readTo		

}//penutup class
