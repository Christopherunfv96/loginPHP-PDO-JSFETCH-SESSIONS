let formData = document.getElementById('formData');
const container = document.querySelector(".alert-container")
formData.addEventListener('submit', (e) => {
    e.preventDefault();
    let data = new FormData(formData);
    let username = data.get('username');
    let password = data.get('password');
    let terms = data.get('terms');
    username = clearWhiteSpaces(username);
    password = clearWhiteSpaces(password);
    let boolean1 = validateMinLength(2, username);
    let boolean2 = validateMinLength(2, password);
    let boolean3 = validateMaxLength(20, username);
    let boolean4 = validateMaxLength(20, password);
    let boolean5 = termsIsChecked(terms);
    let prueba = validateAllIsCorrect(boolean1, boolean2, boolean3, boolean4, boolean5);
    if(prueba === true){
        fetch("./validarLogin.php", {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({username: username, password: password, terms: terms})
        })
            .then(response => response.json())
            .then(data => {
                if (data.success === 1) {
                    console.log("REDIRIGIENDO A HOME.PHP");
                    location.href = 'home.php';
                } else {
                    console.log(data.message); // Cualquier mensaje de error del backend
                }
            })
            .catch(e => console.log(e))
    }
  });

function validateMinLength(minLength, input) {
    let inputLength = input.length;
    return minLength <= inputLength;
}

function validateMaxLength(maxLength, input) {
    let inputLength = input.length;
    return maxLength >= inputLength;
}

function termsIsChecked(inputCheck) {
    return inputCheck === "true";
}

function clearWhiteSpaces(input) {
    input = input.trim();
    return input;
}

function validateAllIsCorrect(boolean1, boolean2, boolean3, boolean4, boolean5) {
    let textError = '';
    if (boolean1 === false) {
        textError += "<br>El nombre de usuario no cumple la longitud minima :(2)";
        console.log(textError);
        createErrorAlert(textError);
    }
    if (boolean2 === false) {
        textError += "<br> La contraseña no cumple la longitud minima :(2)";
        console.log(textError);
        createErrorAlert(textError);
    }
    if (boolean3 === false) {
        textError += "<br> El nombre de usuario sobrepasó la longitud maxima :(20)";
        console.log(textError);
        createErrorAlert(textError);
    }
    if (boolean4 === false) {
        textError += "<br> La contraseña sobrepasó la longitud maxima :(20)";
        console.log(textError);
        createErrorAlert(textError);
    }
    if (boolean5 === false) {
        textError += "<br> Por favor, acepte los términos y condiciones ";
        console.log(textError);
        createErrorAlert(textError);
    }
    if (boolean1 && boolean2 && boolean3 && boolean4 && boolean5) {
        console.log(" TODO ESTÁ CORRECTO EN EL FRONTEND");
        return true;
    } else {
        console.log(" HAY ERRORES EN EL FRONTEND, NO SE HARÁ LA PETICIÓN AL SERVIDOR");
        return false;
    }
}

function createErrorAlert(textError) {
    let divHtml = `<div class="row px-0 pt-4 rowAlert"><div class="col-12"><div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                <strong>Lo sentimos, cuenta con los siguientes errores :</strong>  ${textError}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div></div></div>`;
    const divAlert = document.createElement("div");
    divAlert.innerHTML = divHtml;
    let elementToInsert = divAlert.firstElementChild;
    elementToInsert.classList.add("rowAlert");
    // Selecciono todos los elementos rowAlert para REMOVERLOS y no agregar más de 1 alerta
    let elementsCreated = document.querySelectorAll(".rowAlert").forEach((box) => {
        box.remove();
    });
    container.prepend(elementToInsert);
    setTimeout(() => {
        // Hacemos que cada 3 segundos se borre la ALERTA, pero antes de borrarla, verificamos que
        // la htmlColecction de los elementos "alert" NO sea nula, puesto que ya la borramos arriba
        if (document.querySelector(".alert") != null) {
            document.querySelector(".alert").remove();
        }
    }, 3000);
}