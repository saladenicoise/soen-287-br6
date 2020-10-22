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
        this.messageBox.innerHTML = "<span style=\"color: red\">Error: Password Do Not Match</span>";
        this.document.getElementById('submit').disabled = true;
    } else {
        this.messageBox.innerHTML = "<span style=\"color: greenyellow\">Passwords Match</span>";
        this.document.getElementById('submit').disabled = false;
    }
}