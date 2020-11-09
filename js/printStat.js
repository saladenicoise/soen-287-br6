function printStatus(status) {
    this.statusBox = document.getElementById('statusBox');
    if (status == "signupU") { //Signup Username already taken
        this.statusBox.innerHTML = "<span class=\"fail\">Username Already Taken</span>"
    }
    if (status == "singupG" || status == "loginG") { //Captcha Failed
        this.statusBox.innerHTML = "<span class=\"fail\">Captcha Failed. Please try again</span>"
    }
    if (status == "singupD") { //Database Error!
        this.statusBox.innerHTML = "<span class=\"fail\">Database Error</span>"
    }
    if (status == "loginF") { //Login Fail
        this.statusBox.innerHTML = "<span class=\"fail\">Username or Password is Invalid</span>"
    }
    if (status == "addS") { //Add to menu Success
        this.statusBox.innerHTML = "<span class=\"success\">Successfully added to menu</span>"
    }
    if (status == "addF") { //Add to menu Fail
        this.statusBox.innerHTML = "<span class=\"fail\">Failed to add to menu</span>"
    }
    if (status == "notA") { //Not Admin
        this.statusBox.innerHTML = "<span class=\"fail\">You are not admin</span>"
    }
    if (status == "editS") { //Edit Sucess
        this.statusBox.innerHTML = "<span class=\"success\">Successfully edited menu item</span>"
    }
    if (status == "editF") { //Edit Fail
        this.statusBox.innerHTML = "<span class=\"fail\">Failed to edit menu item</span>"
    }
    if (status == "delS") { //Delete Success
        this.statusBox.innerHTML = "<span class=\"success\">Successfully deleted menu item</span>"
    }
    if (status == "delF") { //Delete Fail
        this.statusBox.innerHTML = "<span class=\"fail\">Failed to delete menu item</span>"
    }

}