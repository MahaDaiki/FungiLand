
var passwordInputs = document.querySelectorAll(".password-input");

passwordInputs.forEach(function(input) {
  var togglePassword = input.nextElementSibling.querySelector(".toggle-password"); 
  

  togglePassword.addEventListener("click", function() {
    if (input.type === "password") {
      input.type = "text";
      togglePassword.querySelector("i").classList.remove("fa-eye");
      togglePassword.querySelector("i").classList.add("fa-eye-slash");
    } else {
      input.type = "password";
      togglePassword.querySelector("i").classList.remove("fa-eye-slash");
      togglePassword.querySelector("i").classList.add("fa-eye");
    }
  });
});
