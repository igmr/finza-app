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

const showErrorsGenderForm = (errors) => {
    listError.innerHTML = "";
    let content = "<b>List Errors</b><br/>";
    if (errors.general) {
        content += `<b>General</b>`;
        content += `<ul>`;
        for (const item in errors.general) {
            content += `<li>${errors.general[item]}</li>`;
        }
        content += `</ul>`;
    }
    if (errors.code) {
        content += `<b>Code</b>`;
        content += `<ul>`;
        for (const item in errors.code) {
            content += `<li>${errors.code[item]}</li>`;
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
    alertError.classList.remove("d-none");
    listError.innerHTML = content;
};

const showErrorsCategoryForm = (errors) => {
    listError.innerHTML = "";
    let content = "<b>List Errors</b><br/>";
    console.log(errors);
    if (errors.gender) {
        content += `<b>Gender</b>`;
        content += `<ul>`;
        for (const item in errors.gender) {
            content += `<li>${errors.gender[item]}</li>`;
        }
        content += `</ul>`;
    }
    if (errors.code) {
        content += `<b>Code</b>`;
        content += `<ul>`;
        for (const item in errors.code) {
            content += `<li>${errors.code[item]}</li>`;
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

const showErrorsClassificationForm = (errors) => {
    listError.innerHTML = "";
    let content = "<b>List Errors</b><br/>";
    if (errors.general) {
        content += `<b>General</b>`;
        content += `<ul>`;
        for (const item in errors.general) {
            content += `<li>${errors.general[item]}</li>`;
        }
        content += `</ul>`;
    }
    if (errors.code) {
        content += `<b>Code</b>`;
        content += `<ul>`;
        for (const item in errors.code) {
            content += `<li>${errors.code[item]}</li>`;
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
    alertError.classList.remove("d-none");
    listError.innerHTML = content;
};

const showErrorsAccountForm = (errors) => {
    listError.innerHTML = "";
    let content = "<b>List Errors</b><br/>";
    if (errors.bank) {
        content += `<b>Bank</b>`;
        content += `<ul>`;
        for (const item in errors.bank) {
            content += `<li>${errors.bank[item]}</li>`;
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

const showErrorsBudgetForm = (errors) => {
    listError.innerHTML = "";
    let content = "<b>List Errors</b><br/>";
    if (errors.account) {
        content += `<b>Account</b>`;
        content += `<ul>`;
        for (const item in errors.account) {
            content += `<li>${errors.account[item]}</li>`;
        }
        content += `</ul>`;
    }
    if (errors.period) {
        content += `<b>Period</b>`;
        content += `<ul>`;
        for (const item in errors.period) {
            content += `<li>${errors.period[item]}</li>`;
        }
        content += `</ul>`;
    }
    if (errors.name) {
        content += `<b>Budget name</b>`;
        content += `<ul>`;
        for (const item in errors.name) {
            content += `<li>${errors.name[item]}</li>`;
        }
        content += `</ul>`;
    }
    if (errors.amount) {
        content += `<b>Amount</b>`;
        content += `<ul>`;
        for (const item in errors.amount) {
            content += `<li>${errors.amount[item]}</li>`;
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
