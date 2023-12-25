const alertError = document.querySelector("#alert-error");
const listError = document.querySelector("#list-error");
const alertSuccess = document.querySelector("#alert-success");
const listSuccess = document.querySelector("#list-success");

const showErrorsPostAuthenticateForm = (errors) => {
    listError.innerHTML = "";
    let content = "";
    if (errors.email) {
        content += `<b>Email</b>`;
        content += `<ul>`;
        for (const item in errors.email) {
            content += `<li>${errors.email[item]}</li>`;
        }
        content += `</ul>`;
    }
    if (errors.password) {
        content += `<b>Password</b>`;
        content += `<ul>`;
        for (const item in errors.password) {
            content += `<li>${errors.password[item]}</li>`;
        }
        content += `</ul>`;
    }
    listError.innerHTML = content;
    alertError.classList.remove("d-none");
};

const showErrorsBankForm = (errors) => {
    console.log(errors);
    listError.innerHTML = "";
    let content = "<b>List Errors</b><br/>";
    if (errors.abbreviature) {
        content += `<b>Abbreviature</b>`;
        content += `<ul>`;
        for (const item in errors.abbreviature) {
            content += `<li>${errors.abbreviature[item]}</li>`;
        }
        content += `</ul>`;
    }
    if (errors.name) {
        content += `<b>Name</b>`;
        content += `<ul>`;
        for (const item in errors.name) {
            content += `<li>${errors.name[item]}</li>`;
        }
        content += `</ul>`;
    }
    if (errors.observation) {
        content += `<b>Observation</b>`;
        content += `<ul>`;
        for (const item in errors.observation) {
            content += `<li>${errors.observation[item]}</li>`;
        }
        content += `</ul>`;
    }
    listError.innerHTML = content;
    alertError.classList.remove("d-none");
};

const showAlertSuccess = (statusValue, textValue) => {
    alertError.classList.add("d-none");
    alertSuccess.classList.add("d-none");
    listSuccess.innerText = "";
    if (statusValue) {
        listSuccess.innerText = textValue;
        alertSuccess.classList.remove("d-none");
    } else {
        listError.innerText = textValue;
        alertSuccess.classList.remove("d-none");
    }
};
