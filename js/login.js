function validateForm() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
   
    let emailpattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    let passwordpattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    
    if (!emailpattern.test(username)) {
        alert("Invalid email");
        return false;
    }
    
    if (!passwordpattern.test(password)) {
        alert("Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character and must be at least 8 characters long");
        return false;
    }

    // user dummy email :- admin@gmail.com 
    // user dummy password :- Password@123
    if (username === "admin@gmail.com" && password === "Password@123") {        
        window.location.href = "index.html"; 
        return false; 
    }

    alert("Incorrect credentials. Try admin@gmail.com with Password@123");
    return false;
}   