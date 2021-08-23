<?php defined('BASEPATH') OR exit('No direct script access allowed');
    class Model_dashboard extends CI_Model{
        private function getGrade(){
            return $this->db->select("grade")->group_by("grade")->get("tbklsjab")->result();
        }

        function getKlsJab(){
            $grade = $this->getGrade();
            $kde = [];
            //Get All Grade
            foreach($grade as $row){
                //If grade 0 then skip them;
                if($row->grade == 0){ continue; }
                //Get all kdeklsjab that using that grade
                $data = $this->db->select("kdeklsjab")->get_where("tbklsjab", ["grade" => $row->grade])->result();
                //Set Grade
                $set["grade"] = $row->grade;
                $total = 0;
                //Get All total pegawai that using that kdeklsjab
                foreach($data as $row2){
                    $total += $this->getTotalPeg($row2->kdeklsjab);
                }
                //Set Total 
                $set["total"] = $total;
                if(!in_array($set, $kde)){
                    array_push($kde, $set);
                }
            }
            return $kde;
        }

        private function getTotalPeg($kdeklsjab){
            $data = $this->db->select("COUNT(*) as total")->get_where("tmpegrem", ["kdeklsjab" => $kdeklsjab])->row_array();
            return $data['total'];
        }
    }
?>