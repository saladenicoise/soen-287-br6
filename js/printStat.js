function printStatus(status) {
    this.statusBox = document.getElementById('statusBox');
    if (status == "signupU") { //Signup Username already taken
        this.statusBox.innerHTML = "<span class=\"fail\">Username Already Taken</span>";
    }
    if (status == "singupG" || status == "loginG") { //Captcha Failed
        this.statusBox.innerHTML = "<span class=\"fail\">Captcha Failed. Please try again</span>";
    }
    if (status == "signupE") {
        this.statusBox.innerHTML = "<span class=\"fail\">A user account with that email already exists</span>"
    }
    if (status == "singupD") { //Database Error!
        this.statusBox.innerHTML = "<span class=\"fail\">Database Error</span>";
    }
    if (status == "loginF") { //Login Fail
        this.statusBox.innerHTML = "<span class=\"fail\">Username or Password is Invalid</span>";
    }
    if (status == "addS") { //Add to menu Success
        this.statusBox.innerHTML = "<span class=\"success\">Successfully added to menu</span>";
    }
    if (status == "addF") { //Add to menu Fail
        this.statusBox.innerHTML = "<span class=\"fail\">Failed to add to menu</span>";
    }
    if (status == "notA") { //Not Admin
        this.statusBox.innerHTML = "<span class=\"fail\">You are not admin</span>";
    }
    if (status == "editS") { //Edit Sucess
        this.statusBox.innerHTML = "<span class=\"success\">Successfully edited menu item</span>";
    }
    if (status == "editF") { //Edit Fail
        this.statusBox.innerHTML = "<span class=\"fail\">Failed to edit menu item; Item does not exist</span>";
    }
    if (status == "delS") { //Delete Success
        this.statusBox.innerHTML = "<span class=\"success\">Successfully deleted menu item</span>";
    }
    if (status == "delF") { //Delete Fail
        this.statusBox.innerHTML = "<span class=\"fail\">Failed to delete menu item: Item does not exist</span>";
    }
    if (status == "customF1") { //Failed to add custom options
        this.statusBox.innerHTML = "<span class=\"fail\">Failed to add custom options: No item corresponding to customization id</span>";
    }
    if (status == "customF2") { //Failed to add custom options
        this.statusBox.innerHTML = "<span class=\"fail\">Failed to add custom options: Item already has custom options, please edit!</span>";
    }
    if (status == "customS") { //Custom Success
        this.statusBox.innerHTML = "<span class=\"success\">Successfully added custom options</span>";
    }
    if (status == "editCustomF1") { //Edit Custom Fail
        this.statusBox.innerHTML = "<span class=\"fail\">Failed to edit custom options: Item does not exist</span>";
    }
    if (status == "editCustomS") { //Edit Custom Success
        this.statusBox.innerHTML = "<span class=\"success\">Successfully edited custom options</span>";
    }
    if (status == "delCustomF") { //Delete Custom Fail
        this.statusBox.innerHTML = "<span class=\"fail\">Failed to delete custom options: Item does not exist</span>";
    }
    if (status == "delCustomS") { //Delete Custom Success
        this.statusBox.innerHTML = "<span class=\"success\">Successfully deleted custom options</span>";
    }
    if (status == "fPassF") { //Forgot password failed, user does not exist
        this.statusBox.innerHTML = "<span class=\"fail\">No user with that email found</span>"
    }
    if (status == "fPassG") { //Forgot password failed, user does not exist
        this.statusBox.innerHTML = "<span class=\"fail\">Captcha Failed</span>"
    }
    if (status == "resetPassF") { //Fail to reset
        this.statusBox.innerHTML = "<span class=\"fail\">User does not exist</span>"
    }
    if (status == "resetPassG") {
        this.statusBox.innerHTML = "<span class=\"fail\">Captcha Failed</span>"
    }
    if (status == "resetPassS") {
        this.statusBox.innerHTML = "<span class=\"success\">Sucessfully Reset Password</span>"
    }
    if (status == "resetPassT") {
        this.statusBox.innerHTML = "<span class=\"fail\">Time Limit Exceeded! Please enter your username again!</span>"
    }
}