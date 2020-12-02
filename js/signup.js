function checkPassword() {
    this.p1 = document.getElementById('password').value;
    this.p2 = document.getElementById('reConfirmPassword').value;
    this.messageBox = document.getElementById('message');

    if ((this.p1 === "") || (this.p2 == "")) {
        this.messageBox.innerHTML = "";
        this.document.getElementById('submit').disabled = false;
        return;
    }
    if (!(this.p1 === this.p2)) {
        this.messageBox.innerHTML = "<span class=\"fail\">Error: Password Do Not Match</span>";
        this.document.getElementById('submit').disabled = true;
    } else {
        this.messageBox.innerHTML = "";
        this.document.getElementById('submit').disabled = false;
    }
}

function toggleDisp() {
    this.icon1 = document.getElementById('eyeIconSlash');
    this.icon2 = document.getElementById('eyeIcon');
    if (this.icon2.style.display === "none") {
        this.icon2.style.display = "block";
        this.icon1.style.display = "none";
    } else {
        this.icon2.style.display = "none";
        this.icon1.style.display = "block";
    }
}

function togglePass() {
    this.p1 = document.getElementById('password');
    this.p2 = document.getElementById('reConfirmPassword');
    if (this.p1.type === "password" && this.p2.type === "password") {
        this.p1.type = "text";
        this.p2.type = "text";
    } else {
        this.p1.type = "password";
        this.p2.type = "password";
    }
}