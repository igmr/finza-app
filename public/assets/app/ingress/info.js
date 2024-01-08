const status = document.querySelector("#status");
const concept = document.querySelector("#concept");
const amount = document.querySelector("#amount");
const description = document.querySelector("#description");
const reference = document.querySelector("#reference");
const account = document.querySelector("#account");
const classification = document.querySelector("#classification");
const debt = document.querySelector("#debt");
const user = document.querySelector("#user");
const observation = document.querySelector("#observation");

const ingressId = getId();
const btnDelete = document.querySelector("#btnDelete");
const btnRestore = document.querySelector("#btnRestore");
const btnEdit = document.querySelector("#btnEdit");
const btnBack = document.querySelector("#btnBack");

btnRestore.addEventListener("click", async () => {
    const response = await restoreIngress(ingressId, getToken());
    await loadInfo();
    showAlertSuccess(response.success, response.data.general[0]);
});

formDelete.addEventListener("submit", async (e) => {
    e.preventDefault();
    const response = await deleteIngress(ingressId, getToken());
    await loadInfo();
    showAlertSuccess(response.success, response.data.general[0]);
});

btnBack.addEventListener("click", async () => {
    window.location.href = `${baseUrlIngress}`;
    return;
});

btnEdit.addEventListener("click", async (e) => {
    e.preventDefault();
    window.location.href = `${baseUrlIngress}/${ingressId}/edit`;
    return;
});

const loadInfo = async () => {
    const data = await findByIdIngress(ingressId);
    console.log(data);
    const _amount = currencyFormatter({ currency: "MXN", value: data.amount });

    concept.innerText = data.concept ? data.concept : "";
    amount.innerText = data.amount ? _amount : "";
    description.innerText = data.description ? data.description : "";
    reference.innerText = data.reference ? data.reference : "";
    account.innerText = data.account ? data.account : "";
    classification.innerText = data.classification ? data.classification : "";
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
