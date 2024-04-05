
document.getElementById('signupLink').addEventListener('click', function() {
    document.getElementById('loginForm').style.display = 'none';
    document.getElementById('signup-form').style.display = 'block';
});

document.getElementById('loginLink').addEventListener('click', function() {
    document.getElementById('signup-form').style.display = 'none';
    document.getElementById('loginForm').style.display = 'block';
});


class User {
    constructor(firstName, lastName, newUsername, newPassword, age) {
      this.firstName = firstName;
      this.lastName = lastName;
      this.newUsername = newUsername;
      this.newPassword = newPassword;
      this.age = age;
    }
    toString() {
        return `First Name: ${this.firstName}\nLast Name: ${this.lastName}\nUsername: ${this.newUsername}\nAge: ${this.age}`;
    }
}

let objekti;

function pasKlikimit() {
  var firstName = document.getElementById('firstname').value;
  var lastName = document.getElementById('lastname').value;
  var newUsername = document.getElementById('newUsername').value;
  var newPassword = document.getElementById('newPassword').value;
  var age = parseFloat(document.getElementById('age').value);

  return new User(firstName, lastName, newUsername, newPassword, age);
}

document.addEventListener('DOMContentLoaded', function () {
    var buttonSignup = document.getElementById('signupButton');
  
    buttonSignup.onclick = function () {
      objekti = pasKlikimit();
  
      var firstName = objekti.firstName;
      var lastName = objekti.lastName;
      var newUsername = objekti.newUsername;
      var newPassword = objekti.newPassword;
      var age = objekti.age;
  
   
      if (firstName.trim() === '' || lastName.trim() === '' || newUsername.trim() === '' || newPassword.trim() === '') {
        alert('Please fill in all required fields.');
        return false;
      }
      if (isNaN(age) || age <= 16) {
        alert('Please enter a valid age. To create an account you have to be at least 16 years old.');
        return false;
      }
  
      
      var stringu = objekti.toString();
      alert('You have successfully created an account!\n' + stringu);
  
   
      setTimeout(function () {
        window.location.reload();
      }, 100);
  
      console.log("button clicked");
    };
});

  

function validateLoginForm() {
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;

    if (email.trim() === '' || password.trim() === '') {
        alert('Please enter both email and password.');
        return false;
    }
    return true;
}




document.getElementById('loginFormButton').addEventListener('click', function(event) {
    if (!validateLoginForm()) {
        event.preventDefault(); 
    }
});