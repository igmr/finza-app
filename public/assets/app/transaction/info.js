const concept = document.querySelector("#concept");
const amount = document.querySelector("#amount");
const status = document.querySelector("#status");
const accountBankFrom = document.querySelector("#account-bank-from");
const classification = document.querySelector("#classification");
const accountBankTo = document.querySelector("#account-bank-to");
const categoryGender = document.querySelector("#category-gender");

const transactionId = getId();
const btnDelete = document.querySelector("#btnDelete");
const btnRestore = document.querySelector("#btnRestore");
const btnEdit = document.querySelector("#btnEdit");
const btnBack = document.querySelector("#btnBack");

btnRestore.addEventListener("click", async () => {
    const response = await restoreTransaction(transactionId, getToken());
    console.log(response);
    await loadInfo();
    showAlertSuccess(response.success, response.data.general[0]);
});

formDelete.addEventListener("submit", async (e) => {
    e.preventDefault();
    const response = await deleteTransaction(transactionId, getToken());
    console.log(response);
    await loadInfo();
    showAlertSuccess(response.success, response.data.general[0]);
});

btnBack.addEventListener("click", async () => {
    window.location.href = `${baseUrlTransaction}`;
    return;
});

btnEdit.addEventListener("click", async (e) => {
    e.preventDefault();
    window.location.href = `${baseUrlTransaction}/${transactionId}/edit`;
    return;
});

const loadInfo = async () => {
    const data = await findByIdTransaction(transactionId);
    console.log(data);
    const _amount = currencyFormatter({ currency: "MXN", value: data.amount });
    concept.innerText = data.concept ? data.concept : "";
    amount.innerHTML = `${_amount} <span>/MXN</span>`;
    accountBankFrom.innerText = `${data.account_from}/${data.bank_from}`;
    if (data.account_from == data.bank_from) {
        accountBankFrom.innerText = data.bank_from;
    }
    classification.innerText = data.classification;
    accountBankTo.innerText = `${data.account_to}/${data.bank_to}`;
    if (data.account_to == data.bank_to) {
        accountBankTo.innerText = data.bank_to;
    }
    categoryGender.innerText = `${data.category}/${data.gender}`;

    setDelete(data.status);
};

const setDelete = (statusValue) => {
    btnRestore.classList.remove("d-none");
    btnRestore.classList.remove("d-block");
    btnDelete.classList.remove("d-none");
    btnDelete.classList.remove("d-block");
    status.innerText = "";
    status.classList.remove("badge-primary");
    status.classList.remove("badge-danger");
    status.classList.remove("badge-success");
    if (statusValue === "Activo") {
        // console.log("Activo");
        status.innerText = "Active";
        status.classList.add("badge-success");
        btnRestore.classList.add("d-none");
        btnDelete.classList.add("d-block");
        return;
    } else {
        // console.log("Inactivo");
        status.innerText = "Inactive";
        status.classList.add("badge-danger");
        btnDelete.classList.add("d-none");
        btnRestore.classList.add("d-block");
        return;
    }
};

(() => {
    loadInfo();
})();
