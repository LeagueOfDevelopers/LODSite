<?php

namespace Lod\Db;

use Lod\Core\Application;
use Lod\Db\Adapter\MysqlAdapter;

class LodDatabase {

    private $db;

    private $stats;
    private $emode;
    private $exname;

    function __construct($db_config) {
        $this->db = new MysqlAdapter($db_config);
        $this->db->connect();
    }

    public function query() {
        if ($this->db->getConnection()->isConnected()) {
            return $this->rawQuery($this->prepareQuery(func_get_args()));
        }
        return !1;
    }

    /**
     * @return \mysqli
     */
    public function getDriver() {
        return $this->db->getConnection()->getDriver();
    }

    public function real_escape_string($text) {
        return $this->db->getConnection()->getDriver()->real_escape_string($text);
    }

    public function simpleQuery($string) {
        if ($this->db->getConnection()->isConnected()) {
            return $this->db->getConnection()->getDriver()->query($string);
        }
        return !1;
    }

    private function prepareQuery($args) {
        $query = '';
        $raw   = array_shift($args);
        $array = preg_split('~(\?[nsiuap])~u',$raw,null,PREG_SPLIT_DELIM_CAPTURE);
        $anum  = count($args);
        $pnum  = floor(count($array) / 2);
        if ($pnum != $anum) {
            $this->error("Number of args ($anum) doesn't match number of placeholders ($pnum) in [$raw]");
        }
        foreach ($array as $i => $part) {
            if (($i % 2) == 0) {
                $query .= $part;
                continue;
            }
            $value = array_shift($args);
            switch ($part) {
                case '?n':
                    $part = $this->escapeIdent($value);
                    break;
                case '?s':
                    $part = $this->escapeString($value);
                    break;
                case '?i':
                    $part = $this->escapeInt($value);
                    break;
                case '?a':
                    $part = $this->createIN($value);
                    break;
                case '?u':
                    $part = $this->createSET($value);
                    break;
                case '?p':
                    $part = $value;
                    break;
            }
            $query .= $part;
        }
        return $query;
    }

    private function rawQuery($query) {
        $start = microtime(TRUE);
        $res   = mysqli_query($this->db->getConnection()->getDriver(), $query);
        $timer = microtime(TRUE) - $start;
        $this->stats[] = array(
            'query' => $query,
            'start' => $start,
            'timer' => $timer,
        );
        if (!$res) {
            $error = mysqli_error($this->db->getConnection()->getDriver());
            end($this->stats);
            $key = key($this->stats);
            $this->stats[$key]['error'] = $error;
            $this->CutStats();
            $this->error("$error. Full query: [$query]");
        }
        $this->CutStats();

        return $res;
    }

    private function escapeInt($value) {
        if ($value === NULL) {
            return 'NULL';
        }
        if(!is_numeric($value)) {
            $this->error("Integer (?i) placeholder expects numeric value, ".gettype($value)." given");
            return FALSE;
        }
        if (is_float($value)) {
            $value = number_format($value, 0, '.', '');
        }
        return $value;
    }

    private function escapeString($value) {
        if ($value === NULL) {
            return 'NULL';
        }
        return "'".mysqli_real_escape_string($this->db->getConnection()->getDriver(), $value)."'";
    }

    private function escapeIdent($value) {
        if ($value) {
            return "`".str_replace("`","``",$value)."`";
        } else {
            $this->error("Empty value for identifier (?n) placeholder");
            return 0;
        }
    }

    private function createIN($data) {
        if (!is_array($data)) {
            $this->error("Value for IN (?a) placeholder should be array");
            return 0;
        }
        if (!$data) {
            return 'NULL';
        }
        $query = $comma = '';
        foreach ($data as $value) {
            $query .= $comma.$this->EscapeString($value);
            $comma  = ",";
        }
        return $query;
    }

    private function createSET($data) {
        if (!is_array($data)) {
            $this->error("SET (?u) placeholder expects array, ".gettype($data)." given");
            return 0;
        }
        if (!$data) {
            $this->error("Empty array for SET (?u) placeholder");
            return 0;
        }
        $query = $comma = '';
        foreach ($data as $key => $value) {
            $query .= $comma.$this->EscapeIdent($key).'='.$this->EscapeString($value);
            $comma  = ",";
        }
        return $query;
    }

    private function error($err) {
        $err  = __CLASS__.": ".$err;
        if ($this->emode == 'error') {
            $err .= ". Error initiated in ".$this->caller().", thrown";
            trigger_error($err, E_USER_ERROR);
        } else {
            throw new $this->exname($err);
        }
    }

    private function caller() {
        $trace  = debug_backtrace();
        $caller = '';
        foreach ($trace as $t) {
            if (isset($t['class']) && $t['class'] == __CLASS__) {
                $caller = $t['file']." on line ".$t['line'];
            } else {
                break;
            }
        }
        return $caller;
    }

    private function cutStats() {
        if (count($this->stats) > 100) {
            reset($this->stats);
            $first = key($this->stats);
            unset($this->stats[$first]);
        }
    }

    public function lastQuery() {
        $last = end($this->stats);
        return $last['query'];
    }

    public function getStats() {
        return $this->stats;
    }

    public function __destruct() {
        $this->db->getConnection()->disconnect();
    }
}