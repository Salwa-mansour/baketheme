<?php
 //https://wpmudev.com/blog/how-to-build-your-own-wordpress-contact-form-and-why/
  //response generation function
 
   

      
  function massege_sending(){
    $GLOBALS['$response'] = "";
 
    //function to generate response
    function my_contact_form_generate_response($type, $message){
   
    //  $GLOBALS['$response'];
   
      if($type == "success") $GLOBALS['$response'] = "<div class='contact-message success'>{$message}</div>";
      else $GLOBALS['$response'] = "<div class='contact-message error'>{$message}</div>";
      echo($GLOBALS['$response']);
      // echo('masswge funtcion firaed _');
     
    }
  
      //response messages
 
      $missing_content = "Please fill in empty fields.";
      $email_invalid   = "Email Address Invalid.";
      $message_unsent  = "Message was not sent. Try Again.";
      $message_sent    = "Thanks! Your message has been sent.";
      
      //user posted variables
      $name = $_POST['message_name'];
      $email = $_POST['message_email'];
      $message = $_POST['message_text'];
      // $human = $_POST['message_human'];
      
      //php mailer variables
      $to = get_option('admin_email');
      $subject = "Someone sent a message from ".get_bloginfo('name');
      $headers = 'From: '. $email . "\r\n" .
      'Reply-To: ' . $email . "\r\n";
// --------------------------------------------------------------  
            //validate presence of name and message
            if(empty($name) || empty($message)){
                my_contact_form_generate_response("error", $missing_content);
                // echo('empty');
            }
            else //ready to go!
            {
                        //send email
                        //validate email
                    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
                    my_contact_form_generate_response("error", $email_invalid);
                    else //email is valid
                    {
                    //validate presence of name and message
                    //send email
                        $sent = wp_mail($to, $subject, strip_tags($message), $headers);
                        if($sent) my_contact_form_generate_response("success", $message_sent); //message sent!
                        else my_contact_form_generate_response("error", $message_unsent); //message wasn't sent
                    }

            }
            // --------------
          

  }

  if(isset($_POST['contact-form-submit'])) {
    massege_sending();
//   echo('meh');
  }
//   else{
//    $GLOBALS['contact-form-submit']=0;
//   }
   
   
   
?>
<div id="respond">
                <!-- <?php //echo $response.'--woo'; ?> -->
                <h2>conact us</h2>

                <form action="<?php the_permalink(); ?>" method="post">
                   
                        <!-- <label for="name">Name: <span>*</span> </label> -->
                        <input type="text" name="message_name" value="<?php echo esc_attr($_POST['message_name']); ?>" placeholder="name" >
                    
                        
                       
                             <!-- <label for="message_email">Email: <span>*</span> </label> -->
                        <input type="text" name="message_email" value="<?php echo esc_attr($_POST['message_email']); ?>" placeholder="email">
                         
                          
                      
                            <!-- <label for="message_text">Message: <span>*</span> </label> -->
                        <textarea type="text"  name="message_text" placeholder="massege" ><?php echo esc_textarea($_POST['message_text']); ?></textarea>
                       
                             
                       
                                <!--
                                     <label for="message_human">Human Verification: <span>*</span></label>
                        <span><input type="text" style="width: 60px;" name="message_human"> + 3 = 5</span>
                                 -->
                    
                       
                                
                        <input type="hidden" name="submitted" value="1">
                       
                        <input type="submit" name="contact-form-submit" value="Submit">
                        
                </form>
            </div>