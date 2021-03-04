 <?php  
 defined('BASEPATH') OR exit('No direct script access allowed'); 
 // ci_controller surveille que la personne modifie depuis le code la personne ne peut pas avoir acces via l'url 
 class Main extends CI_Controller {  
      //functions  
   
      public function index(){  
          $this->load->helper('url'); // ici nous avons chargez des helpers que l'on a set dans autoload.php ligne 92
           $this->load->model("main_model");  //Ici load notre main_model 
           $data["fetch_data"] = $this->main_model->fetch_data();  
           //Ici vous chargez votre vew form.php afin d'afficher votre formulaire 
           $this->load->view("form", $data);  
      }  


      public function form_validation()  
      {   
           //Ici vous chargez librairie de codeIgniter qui vous aide a sécuriser votre form et vous pouvez également créer vos regex ici 
           $this->load->library('form_validation');  
           $this->form_validation->set_rules("firstname", "Firstname", 'required');  
           $this->form_validation->set_rules("lastname", "Lastname", 'required');
           $this->form_validation->set_rules("birthdate", "birthdate", 'required');  
           $this->form_validation->set_rules("phone", "phone", 'required');
           $this->form_validation->set_rules("mail", "mail", 'required');    
           if($this->form_validation->run())  
           {  
                //Ici on demande de stocker nos informations post dans un tableau  
                $this->load->model("main_model");  
                $data = array(  
                     "firstname"     =>$this->input->post("firstname"),  
                     "lastname"          =>$this->input->post("lastname"),
                     "birthdate"     =>$this->input->post("birthdate"),  
                     "phone"          =>$this->input->post("phone"),
                     "mail"          =>$this->input->post("mail")   
                ); 
                
               //Ici on affiche les informations modifier grace au formulaire c'est votre update de votre CRUD
                if($this->input->post("update"))  
                {  
                     $this->main_model->update_data($data, $this->input->post("hidden_id"));  
                     redirect(base_url() . "main/updated");  
                }  
                if($this->input->post("insert"))  
                {  
                     //Ici vous inserer vos informations dans votre base de données que vous avez set dans database.php
                     $this->main_model->insert_data($data);  
                     redirect(base_url() . "main/inserted");  
                }  
           }  
           else  
           {  
                //false  
                $this->index();  
           }  
      }  

      //Ici vous avez une fonction qui sert a insérer des données dans votre database. C'est le create de votre CRUD
      public function inserted()  
      {  
           $this->index();  
      }  

       //Ici vous supprimer vos informations c'est le delete de votre CRUD
      public function delete_data(){  
           $id = $this->uri->segment(3);  
           $this->load->model("main_model");  
           $this->main_model->delete_data($id);  
           redirect(base_url() . "main/deleted");  
      }  
      public function deleted()  
      {  
           $this->index();  
      }  
      public function update_data(){  
           $user_id = $this->uri->segment(3);  
           $this->load->model("main_model");  
           $data["user_data"] = $this->main_model->fetch_single_data($user_id);  
           $data["fetch_data"] = $this->main_model->fetch_data();  
           $this->load->view("form", $data);  
      }  
      public function updated()  
      {  
           $this->index();  
      }  
 }  