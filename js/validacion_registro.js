document.getElementById('registroForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevenir el envío del formulario por defecto

    // Obtener los valores de los campos del formulario
    var usuario = document.getElementById('usuario').value;
    var nombre = document.getElementById('nombre').value;
    var apellido = document.getElementById('apellido').value;
    var cedula = document.getElementById('cedula').value;
    var descripcion_per = document.getElementById('descripcion_per').value;
    var correo = document.getElementById('correo').value;
    var clave = document.getElementById('clave').value;

    // Validaciones de longitud
    if (usuario.length < 4 || usuario.length > 10) {
        alert('El nombre de usuario debe tener entre 4 y 10 caracteres.');
        return;
    }
    if (nombre.length < 4 || nombre.length > 20) {
        alert('El nombre debe tener entre 4 y 20 caracteres.');
        return;
    }
    if (apellido.length < 4 || apellido.length > 20) {
        alert('El apellido debe tener entre 4 y 20 caracteres.');
        return;
    }
    if (cedula.length < 8 || cedula.length > 9) {
        alert('La cédula debe tener entre 8 y 9 caracteres.');
        return;
    }
    if (descripcion_per.length === 0) {
        alert('La descripción no puede estar vacía.');
        return;
    }
    if (!validateEmail(correo)) {
        alert('El correo electrónico no es válido.');
        return;
    }
    if (clave.length === 0) {
        alert('La clave no puede estar vacía.');
        return;
    }
    if (usuario === nombre) {
        alert('El nombre de usuario y el nombre no pueden ser iguales.');
        return;
    }
    if (usuario === apellido) {
        alert('El nombre de usuario y el apellido no pueden ser iguales.');
        return;
    }
    if (nombre === apellido) {
        alert('El nombre y el apellido no pueden ser iguales.');
        return;
    }

    // Validar si los valores ya existen en la base de datos
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../Noticias/Admin/validar_usuarios.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.exists) {
                alert('El nombre de usuario, la cédula o el correo ya están registrados.');
            } else {
                // Si no existe, enviar el formulario
                document.getElementById('registroForm').submit();
            }
        }
    };
    var data = "usuario=" + encodeURIComponent(usuario) + "&cedula=" + encodeURIComponent(cedula) + "&correo=" + encodeURIComponent(correo);
    xhr.send(data);
});

function validateEmail(email) {
    var re = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return re.test(String(email).toLowerCase());
}

function generateRandomCode(length) {
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var result = '';
    var charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}