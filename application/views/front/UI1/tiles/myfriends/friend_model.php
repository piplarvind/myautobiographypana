<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Friend_model extends CI_Model {

    
    public function getNotificationFriend($user_id) {
        
      //  echo $this->db->dbprefix('mst_user_friends');
         $q ='(select count(*) from '.$this->db->dbprefix('mst_timeline').' as t1 where t1.user_id = u.user_id) as cnt ';
        $fields_to_pass = "u.first_name,u.user_id,u.last_name,u.user_name,u.profile_picture,user_role,t.*,".$q."";
        $this->db->select($fields_to_pass);
        $this->db->from('mst_timeline as t');
        $query = "select to_user_id from ".$this->db->dbprefix('mst_user_friends')." uf where uf.from_user_id = '".$user_id."'";
        $query1 = "select to_user_id from ".$this->db->dbprefix('mst_user_friends')." uf where uf.from_user_id = '".$user_id."'";
        $this->db->join('mst_users as u', "t.user_id = u.user_id AND (u.user_id IN (".$query." ) OR u.user_id IN (".$query1." )) ", "INNER");
        $this->db->order_by("t.timeline_posted_date", "DESC");
        $query = $this->db->get();
        return $query->result_array();
        //$this->db->last_query();
    }
     public function getMyNotificationFeed($user_id) {
        
      
        $q ='(select count(*) from '.$this->db->dbprefix('mst_timeline').' as t1 where t1.user_id = u.user_id) as cnt,c.category_name ';
        $fields_to_pass = "u.first_name,u.user_id,u.last_name,u.user_name,u.profile_picture,user_role,t.*,".$q."";
        $this->db->select($fields_to_pass);
        $this->db->from('mst_timeline as t');
        $this->db->join('mst_users as u', "t.user_id = u.user_id", "INNER");
        $this->db->join('mst_categories as c', "t.sub_category_id = c.category_id", "INNER");
        $this->db->where("t.user_id", $user_id);
        $this->db->order_by("t.timeline_posted_date", "DESC");
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result_array();
        //$this->db->last_query();
    }
    
    public function getLifeEventCountUserA($category_id, $sub_category_id,$user_id) {

        
        $this->db->select('count(t.timeline_id) as event_count');
        $this->db->from('mst_timeline as t');
        $this->db->where("t.category_id", base64_decode($category_id));
        $this->db->where("t.sub_category_id", base64_decode($sub_category_id));
        $this->db->where("t.user_id", $user_id);
        //$this->db->where("t.timeline_visibility", '1'); // Show only public post
        $query = $this->db->get();
        return $query->result_array();
    }
   
    public function getTimeLineCommentsUserB($timeline_id) {

        
        $this->db->select('ttc.*,u.first_name,u.last_name,u.user_name,u.profile_picture,u.user_role');
        $this->db->from('trans_timeline_comments as ttc');
        $this->db->join('mst_users as u', 'ttc.user_id = u.user_id', 'left');
        $this->db->where("u.user_status !=", '2');//Blocked user
        $this->db->where("ttc.timeline_id", $timeline_id);
        $this->db->where("ttc.comments_status", '1');
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
}

?>
