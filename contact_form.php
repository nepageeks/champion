<?php
        if ($_POST)
        {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $comments = $_POST['comments'];
			$phone = $_POST['phone'];
			$company = $_POST['company'];
			$subject = $_POST['subject'];
            $message = "Message from $name\nEmail: $email\nPhone: $phone\nCompany: $company\nSubject: $subject\nMessage: $comments";
			$headers = "From: $email" . "\r\n" .
   				"Reply-To: $email" . "\r\n" .
   				"X-Mailer: PHP/" . phpversion();
            mail("phil@blacklocustdesign.com", "Message from $name", $message, $headers);
			mail("$email", "Your message has been sent", "Thank you for contacting Champion Builders, Inc. We have received your message and will respond to you shortly.", "From: phil@blacklocustdesign.com"); 
            echo "<h4>Your Message was sent. Thank you.</h4>";
        }
        else
        {
        ?>

<form method="post" action="<?= $PHP_SELF ?>"
name="ContactForm" onsubmit="return ValidateContactForm();">
  <p>Name:<span>*</span><br />
    <input type="text" name="name" style="width: 200px;" />
  </p>
  
  <p>Email Address:<span>*</span><br />
    <input type="text" name="email" style="width: 250px;" />
  </p>
  
    <p>Company/Website:<br />
    <input type="text" name="company" style="width: 250px;" />
  </p>
  
  <p>Phone:<br />
    <input type="text" name="phone" />
  </p>
  
  <p>Subject:<br />
    <input type="text" name="subject" style="width: 350px;" />
  </p>
  
  <p>Message:<span>*</span><br />
    <textarea name="comments" cols="50" rows="5" style="width: 520px;"></textarea>
  </p>
  
  <p style="float: left; width: 200px; margin-top: 7px;"><span>*</span> Required Field</p>
  <p style="float: right; margin: 0;">
    <input type="reset" value="Reset" name="reset"> <input type="submit" value="Submit" name="submit">
  </p>
</form>
<?php
        }
        ?>
