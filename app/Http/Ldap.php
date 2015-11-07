<?php

namespace App\Http;
/* Mapping attr:
   uid = NIP
   l = E-Mail
   o = Username
   description = JSON of additional data
*/
class Ldap {
    protected $ds;
    protected $dn = 'dc=sso,dc=esdm,dc=go,dc=id';
    protected $objectclass = ['domain','top','uidObject'];
    
    public function __construct($dn = false,$objectclass = false) {
        if ($dn) {
            $this->dn = $dn;
        }
        if ($objectclass) {
            $this->objectclass = $objectclass;
        }
        $this->ds = ldap_connect(config('ldap.ldap_host'), config('ldap.ldap_port'))
                or die("Could not connect to ".config('ldap.ldap_host'));
        ldap_set_option($this->ds, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_bind($this->ds, config('ldap.ldap_user'), config('ldap.ldap_pass'));
    }
    
    public function listAll($attributes = null) {
        $filter    = '(|(uid=*))';
        if ($attributes) $sr = ldap_search($this->ds, $this->dn, $filter, $attributes);
        else $sr = ldap_search($this->ds, $this->dn, $filter);
        return ldap_get_entries($this->ds, $sr);
    }
    
    public function findByFilter($filter = 'uid=*',$one = false, $attributes = null) {
        if ($attributes) $sr = ldap_search($this->ds, $this->dn, $filter, $attributes);
        else $sr = ldap_search($this->ds, $this->dn, $filter);
        $result = ldap_get_entries($this->ds, $sr);
        if ($one) {
            if ($result['count'] == 0) return null;
            return $result[0];
        } else {
            return $result;
        }
    }
    
    public static function hash($password) {
        $salt = str_random(4);
        return '{SSHA}' . base64_encode(sha1( $password.$salt, TRUE ). $salt);
    }
    
    public function update($entry,$attrs) {
        return ldap_modify($this->ds,$entry['dn'],$attrs);
    }
    
    public function create($attrs) {
        if (!isset($attrs['uid'])) return false;
        $entry = array_merge(['objectclass'=>$this->objectclass],$attrs);
        try {
            return ldap_add($this->ds,"dc=".$attrs['uid'].",".$this->dn,$entry);
        } catch (\Exception $e) {
            return false;
        }
    }
    
    public function __destruct() {
        ldap_close($this->ds);
    }
}
?>