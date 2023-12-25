const id = document.querySelector("#id");
const name = document.querySelector("#name");
const abbreviature = document.querySelector("#abbreviature");
const observation = document.querySelector("#observation");
const status = document.querySelector("#status");
const bankId = getId();
const btnDelete = document.querySelector("#btnDelete");
const btnRestore = document.querySelector("#btnRestore");
const btnEdit = document.querySelector("#btnEdit");
const btnBack = document.querySelector("#btnBack");

btnRestore.addEventListener("click", async () => {
    const response = await restoreBank(bankId, getToken());
    await loadInfo();
    showAlertSuccess(response.success, response.data.general[0]);
});

formDelete.addEventListener("submit", async (e) => {
    e.preventDefault();
    const response = await deleteBank(bankId, getToken());
    await loadInfo();
    showAlertSuccess(response.success, response.data.general[0]);
});

btnBack.addEventListener("click", async () => {
    window.location.href = `${baseUrlBank}`;
    return;
});

btnEdit.addEventListener("click", async (e) => {
    e.preventDefault();
    window.location.href = `${baseUrl}/app/bank/${bankId}/edit`;
    return;
});

const loadInfo = async () => {
    const data = await findByIdBank(bankId);
    id.value = bankId;
    name.innerText = data.bank;
    abbreviature.innerText = "";
    if (data.abbreviature) {
        abbreviature.innerText = `@${data.abbreviature}`;
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
