<?php  

// Ici vous créez votre model 
 class Main_model extends CI_Model  
 {  
      function test_main()  
      {  
           echo "This is model function";  
      }  

     // Ici la fonction sert a insérer des données dans votre database. Celle que vous avez enregistrée dans votre fichier database.php
      function insert_data($data)  
      {  
           $this->db->insert("patients", $data);  
      }  

      // Ici vous aller afficher toutes données de votre table patients. C'est le read de votre CRUD 
      function fetch_data()  
      {  
           $this->db->select("*");  
           $this->db->from("patients");  
           $query = $this->db->get();  
           return $query;  
      }  

      // Ici c'est une fonction pour supprimer les information du patient.  C'est le delete de votre CRUD
      function delete_data($id){  
           $this->db->where("id", $id);  
           $this->db->delete("patients");  
      }  

     //Ici la fonction sert a afficher un seul patient notamment pour pouvoir modifier les infos pour la suite. C'est le read de votre CRUD
      function fetch_single_data($id)  
      {  
           $this->db->where("id", $id);  
           $query = $this->db->get("patients");  
           return $query;  
      } 
      
      // Ici c'est une fonction pour modifier les information du client. C'est le update de votre CRUD 
      function update_data($data, $id)  
      {  
           $this->db->where("id", $id);  
           $this->db->update("patients", $data);  
     
      }  
 }  