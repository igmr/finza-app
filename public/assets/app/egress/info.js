const status = document.querySelector("#status");
const concept = document.querySelector("#concept");
const amount = document.querySelector("#amount");
const accountBank = document.querySelector("#account-bank");

const egressId = getId();
const btnDelete = document.querySelector("#btnDelete");
const btnRestore = document.querySelector("#btnRestore");
const btnEdit = document.querySelector("#btnEdit");
const btnBack = document.querySelector("#btnBack");

btnRestore.addEventListener("click", async () => {
    const response = await restoreEgress(egressId, getToken());
    await loadInfo();
    showAlertSuccess(response.success, response.data.general[0]);
});

formDelete.addEventListener("submit", async (e) => {
    e.preventDefault();
    const response = await deleteEgress(egressId, getToken());
    await loadInfo();
    showAlertSuccess(response.success, response.data.general[0]);
});

btnBack.addEventListener("click", async () => {
    window.location.href = `${baseUrlEgress}`;
    return;
});

btnEdit.addEventListener("click", async (e) => {
    e.preventDefault();
    window.location.href = `${baseUrlEgress}/${egressId}/edit`;
    return;
});

const loadInfo = async () => {
    const data = await findByIdEgress(egressId);
    const _amount = currencyFormatter({ currency: "MXN", value: data.amount });

    id.value = egressId;
    concept.innerText = data.concept;
    amount.innerText = "";
    if (data.amount) {
        amount.innerHTML = `${_amount} <span>/MXN</span>`;
    }
    accountBank.innerHTML = `${data.account}/${data.bank}`;
    if (data.account == data.bank) {
        accountBank.innerHTML = data.bank;
    }
    console.log(data);
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
