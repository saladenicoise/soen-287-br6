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
    if (this.p1.type === "password") {
        this.p1.type = "text";
    } else {
        this.p1.type = "password";
    }
}