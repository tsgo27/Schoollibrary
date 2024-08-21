document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.querySelector('input[name="senha"]');
    
    passwordInput.addEventListener('input', function() {
        const password = passwordInput.value;
        const strengthIndicator = document.getElementById('password-strength');

        // Defina as regras para verificar a força da senha
        const hasLowerCase = /[a-z]/.test(password);
        const hasUpperCase = /[A-Z]/.test(password);
        const hasNumber = /\d/.test(password);
        const hasSpecialChar = /[!@#$%^&*]/.test(password);
        const isMinLength = password.length >= 8;

        // Calcule a força da senha com base nas regras
        let strength = 0;

        if (hasLowerCase) strength++;
        if (hasUpperCase) strength++;
        if (hasNumber) strength++;
        if (hasSpecialChar) strength++;
        if (isMinLength) strength++;

        // Defina estilos com base na força da senha
        if (strength === 5) {
            strengthIndicator.textContent = 'Senha Forte';
            strengthIndicator.style.color = 'green';
            passwordInput.style.border = '1px solid green';
        } else if (strength >= 3) {
            strengthIndicator.textContent = 'Senha Moderada';
            strengthIndicator.style.color = 'orange';
            passwordInput.style.border = '1px solid orange';
        } else {
            strengthIndicator.textContent = 'Senha Fraca';
            strengthIndicator.style.color = 'red';
            passwordInput.style.border = '1px solid red';
        }
    });
});

