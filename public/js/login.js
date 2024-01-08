document.addEventListener('DOMContentLoaded', () => {
    const checkbox = document.getElementById('recordar_contraseña');

    checkbox.addEventListener('click', () => {
        if (checkbox.checked) {
            checkbox.classList.add('checked');
        } else {
            checkbox.classList.remove('checked');
        }
    });
});