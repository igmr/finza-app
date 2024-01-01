const id = document.querySelector("#id");
const name = document.querySelector("#name");
const amount = document.querySelector("#amount");
const date_finish = document.querySelector("#date_finish");
const observation = document.querySelector("#observation");
const status = document.querySelector("#status");
const savingId = getId();
const btnDelete = document.querySelector("#btnDelete");
const btnRestore = document.querySelector("#btnRestore");
const btnEdit = document.querySelector("#btnEdit");
const btnBack = document.querySelector("#btnBack");

btnRestore.addEventListener("click", async () => {
    const response = await restoreSaving(savingId, getToken());
    await loadInfo();
    showAlertSuccess(response.success, response.data.general[0]);
});

formDelete.addEventListener("submit", async (e) => {
    e.preventDefault();
    const response = await deleteSaving(savingId, getToken());
    await loadInfo();
    showAlertSuccess(response.success, response.data.general[0]);
});

btnBack.addEventListener("click", async () => {
    window.location.href = `${baseUrlSaving}`;
    return;
});

btnEdit.addEventListener("click", async (e) => {
    e.preventDefault();
    window.location.href = `${baseUrlSaving}/${savingId}/edit`;
    return;
});

const loadInfo = async () => {
    const data = await findByIdSaving(savingId);
    const _amount = currencyFormatter({ currency: "MXN", value: data.amount });
    console.log(data);
    id.value = savingId;
    name.innerText = data.saving;
    amount.innerText = "";
    if (data.amount) {
        amount.innerText = _amount;
    }
    date_finish.innerText = "";
    if (data.date_finish) {
        date_finish.innerText = data.date_finish;
    }
    observation.innerText = "";
    if (data.observation) {
        observation.innerText = data.observation;
    }
    setDelete(data.status);
    // console.log(data);
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
