document.getElementById('cpf').addEventListener('input', function () {
    let cpf = this.value;

    
    cpf = cpf.replace(/\D/g, '');

    
    if (cpf.length <= 11) {
        cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
        cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
        cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    }

    this.value = cpf;
});

document.getElementById('registerForm').addEventListener('submit', function (event) {
    event.preventDefault();
    const cpfInput = document.getElementById('cpf');
    const cpfError = document.getElementById('cpfError');

    if (validateCPF(cpfInput.value)) {
        cpfError.style.display = 'none';
        alert('CPF válido!');
        
    } else {
        cpfError.textContent = 'CPF inválido';
        cpfError.style.display = 'block';
    }
});

function validateCPF(cpf) {
    cpf = cpf.replace(/\D/g, '');

    if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) {
        return false;
    }

    let soma = 0;
    for (let i = 0; i < 9; i++) {
        soma += parseInt(cpf.charAt(i)) * (10 - i);
    }
    let resto = 11 - (soma % 11);
    if (resto === 10 || resto === 11) {
        resto = 0;
    }
    if (resto !== parseInt(cpf.charAt(9))) {
        return false;
    }

    soma = 0;
    for (let i = 0; i < 10; i++) {
        soma += parseInt(cpf.charAt(i)) * (11 - i);
    }
    resto = 11 - (soma % 11);
    if (resto === 10 || resto === 11) {
        resto = 0;
    }
    return resto === parseInt(cpf.charAt(10));
}
