
function ValidateContactForm()
{
    var name = document.ContactForm.name;
    var email = document.ContactForm.email;
    var state = document.ContactForm.state;
	var comments = document.ContactForm.comments;

    if (name.value == "")
    {
        window.alert("Please enter your name.");
        name.focus();
        return false;
    }
   
    if (email.value == "")
    {
        window.alert("Please enter a valid e-mail address.");
        email.focus();
        return false;
    }
    if (email.value.indexOf("@", 0) < 0)
    {
        window.alert("Please enter a valid e-mail address.");
        email.focus();
        return false;
    }
    if (email.value.indexOf(".", 0) < 0)
    {
        window.alert("Please enter a valid e-mail address.");
        email.focus();
        return false;
    }
    if (state.value == "")
    {
        window.alert("Please provide a state.");
        state.focus();
        return false;
    }
	    if (comments.value == "")
    {
        window.alert("Please add a message.");
        comments.focus();
        return false;
    }
    return true;
}
