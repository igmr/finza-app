const alertError = document.querySelector("#alert-error");
const listError = document.querySelector("#list-error");

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