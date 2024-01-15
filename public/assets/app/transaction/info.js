const status = document.querySelector("#status");
const concept = document.querySelector("#concept");
const amount = document.querySelector("#amount");
const description = document.querySelector("#description");
const reference = document.querySelector("#reference");
const created_at = document.querySelector("#created_at");
const account_from = document.querySelector("#account_from");
const bank_from = document.querySelector("#bank_from");
const account_to = document.querySelector("#account_to");
const bank_to = document.querySelector("#bank_to");
const classification = document.querySelector("#classification");
const category = document.querySelector("#category");
const saving = document.querySelector("#saving");
const debt = document.querySelector("#debt");
const user = document.querySelector("#user");

const transactionId = getId();
const btnDelete = document.querySelector("#btnDelete");
const btnRestore = document.querySelector("#btnRestore");
const btnEdit = document.querySelector("#btnEdit");
const btnBack = document.querySelector("#btnBack");

btnRestore.addEventListener("click", async () => {
    const response = await restoreTransaction(transactionId, getToken());
    console.log(response)
    await loadInfo();
    showAlertSuccess(response.success, response.data.general[0]);
});

formDelete.addEventListener("submit", async (e) => {
    e.preventDefault();
    const response = await deleteTransaction(transactionId, getToken());
    console.log(response)
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
    amount.innerText = data.amount ? _amount : "";
    description.innerText = data.description ? data.description : "";
    reference.innerText = data.reference ? data.reference : "";
    created_at.innerText = data.created_at ? data.created_at : "";
    account_from.innerText = data.account_from ? data.account_from : "";
    bank_from.innerText = data.bank_from ? data.bank_from : "";
    account_to.innerText = data.account_to ? data.account_to : "";
    bank_to.innerText = data.bank_to ? data.bank_to : "";
    classification.innerText = data.classification ? data.classification : "";
    category.innerText = data.category ? data.category : "";
    saving.innerText = data.saving ? data.saving : "";
    debt.innerText = data.debt ? data.debt : "";
    user.innerText = data.user ? data.user : "";
    observation.innerText = data.observation ? data.observation : "";

    setDelete(data.status);
};

const setDelete = (statusValue) => {
    btnRestore.classList.remove("d-none");
    btnRestore.classList.remove("d-block");
    btnDelete.classList.remove("d-none");
    btnDelete.classList.remove("d-block");
    status.classList.remove("dot-danger");
    status.classList.remove("dot-success");
    if (statusValue === "Activo") {
        // console.log("Activo");
        status.classList.add("dot-success");
        btnRestore.classList.add("d-none");
        btnDelete.classList.add("d-block");
        return;
    } else {
        // console.log("Inactivo");
        status.classList.add("dot-danger");
        btnDelete.classList.add("d-none");
        btnRestore.classList.add("d-block");
        return;
    }
};

(() => {
    loadInfo();
})();
