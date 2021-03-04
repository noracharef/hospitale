<html>  
 <head>  
   <title>CodeIgniter</title>  
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />  
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
 </head>  
 <body>  
 <div class="container">  
      <br /><br /><br />  
      <h3 align="center">Formulaire destiné aux patients</h3><br />
      <h4 align="center">Merci de renseigner vos informations</h4>  
      <form method="post" action="<?php echo base_url()?>main/form_validation">  
      
           <?php 
           $this->load->library('form_validation'); 
          // Ici uri correspond au router il redirige vers inserted pour afficher les informations que vous venez d'inserer en passant par le formulaire
           if($this->uri->segment(2) == "inserted")  
           {  
       
                echo '<p class="text-success">Votre patient est bien ajouté</p>';  
           }  
          // Ici uri correspond au router il redirige vers updated pour afficher les informations que vous venez de modifier
           if($this->uri->segment(2) == "updated")  
           {  
                echo '<p class="text-success">Data mise à jour</p>';  
           }  
           ?>  
           <?php  
           if(isset($user_data))  
           {  
                foreach($user_data->result() as $row)  
                {  
           ?>  
           <div class="form-group">  
                <label>Votre prénom :</label>  
                <input type="text" name="firstname" value="<?php echo $row->firstname; ?>" class="form-control" />  
                <span class="text-danger"><?php echo form_error("firstname"); ?></span>  
           </div>  
           <div class="form-group">  
                <label>Votre nom : </label>  
                <input type="text" name="lastname" value="<?php echo $row->lastname; ?>" class="form-control" />  
                <span class="text-danger"><?php echo form_error("lastname"); ?></span>  
           </div>  
           <div class="form-group">  
                <label>Votre date de naissance : </label>  
                <input type="date" name="birthdate" value="<?php echo $row->birthdate; ?>" class="form-control" />  
                <span class="text-danger"><?php echo form_error("birthdate"); ?></span>  
           </div>  
           <div class="form-group">  
                <label>Votre numéro de telephone : </label>  
                <input type="text" name="phone" value="<?php echo $row->phone; ?>" class="form-control" />  
                <span class="text-danger"><?php echo form_error("phone"); ?></span>  
           </div>  
           <div class="form-group">  
                <label>Votre email : </label>  
                <input type="text" name="mail" value="<?php echo $row->mail; ?>" class="form-control" />  
                <span class="text-danger"><?php echo form_error("mail"); ?></span>  
           </div>  
           <div class="form-group">  
                <input type="hidden" name="hidden_id" value="<?php echo $row->id; ?>" />  
                <input type="submit" name="update" value="Envoyer" class="btn btn-info" />  
           </div>       
           <?php       
                }  
           }  
           else  
           {  
           ?>  
              <div class="form-group">  
                <label>Votre prénom :</label>  
                <input type="text" name="firstname" class="form-control" />  
                <span class="text-danger"><?php echo form_error("firstname"); ?></span>  
           </div>  
           <div class="form-group">  
                <label>Votre nom : </label>  
                <input type="text" name="lastname" class="form-control" />  
                <span class="text-danger"><?php echo form_error("lastname"); ?></span>  
           </div>  
           <div class="form-group">  
                <label>Votre date de naissance : </label>  
                <input type="date" name="birthdate" class="form-control" />  
                <span class="text-danger"><?php echo form_error("birthdate"); ?></span>  
           </div>  
           <div class="form-group">  
                <label>Votre numéro de telephone : </label>  
                <input type="text" name="phone" lass="form-control" />  
                <span class="text-danger"><?php echo form_error("phone"); ?></span>  
           </div>  
           <div class="form-group">  
                <label>Votre email : </label>  
                <input type="text" name="mail" class="form-control" />  
                <span class="text-danger"><?php echo form_error("mail"); ?></span>  
           </div>  
           <div class="form-group">  
           <input type="submit" name="insert" value="Envoyer" class="btn btn-info" />
           </div>      
           <?php  
           }  
           ?>  
      </form>
      <br /><br />  
      <h3>Listes des patients</h3><br />  
      <div class="table-responsive">  
           <table class="table table-bordered">  
                <tr>  
                     <th>ID</th>  
                     <th>Prénom</th>  
                     <th>Nom </th>  
                     <th>Date de naissance </th>  
                     <th>téléphone</th>  
                     <th>Email </th>  
                     <th>Effacer</th>  
                     <th>Modifier</th>  
                </tr>  
           <?php  

           // Ici vous avez le tableau qui afficher les données des patients récuperées de votre base de donnée. 
           if($fetch_data->num_rows() > 0)  
           {  
                foreach($fetch_data->result() as $row)  
                {  
           ?>  
                <tr>  
                     <td><?php echo $row->id; ?></td>  
                     <td><?php echo $row->firstname; ?></td>  
                     <td><?php echo $row->lastname; ?></td>  
                     <td><?php echo $row->birthdate; ?></td>
                     <td><?php echo $row->phone; ?></td>
                     <td><?php echo $row->mail; ?></td>
                     <td><a href="#" class="delete_data" id="<?php echo $row->id; ?>">Effacer</a></td>  
                     <td><a href="<?php echo base_url(); ?>main/update_data/<?php echo $row->id; ?>">Modifier</a></td>  
                </tr>  
           <?php       
                }  
           }  
           else  
           {  
           ?>  
                <tr>  
                     <td colspan="5">Aucune data</td>  
                </tr>  
           <?php  
           }  
           ?>  
           </table>  
      </div>  
      <script>  
      // Ici vous avez les conditions d'affichage pour votre suppression de données. 
      $(document).ready(function(){  
           $('.delete_data').click(function(){  
                var id = $(this).attr("id");  
                if(confirm("Vous souhaitez supprimer ces données ?"))  
                {  
                     window.location="<?php echo base_url(); ?>main/delete_data/"+id;  
                }  
                else  
                {  
                     return false;  
                }  
           });  
      });  
      </script>  
 </div>  
 </body>  
 </html> 