var passwordInput = document.getElementById("ss");
var capsLockAlert = document.getElementById("caps-lock-alert");

passwordInput.addEventListener("keyup", function(event) {
   if (event.getModifierState && event.getModifierState("CapsLock")) {
      capsLockAlert.style.display = "block";
   } else {
      capsLockAlert.style.display = "none";
   }
});