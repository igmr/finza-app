const id = document.querySelector("#id");

const name = document.querySelector("#name");
const amount = document.querySelector("#amount");
const period = document.querySelector("#period");
const categoryGender = document.querySelector("#category_gender");
const observation = document.querySelector("#observation");

const status = document.querySelector("#status");
const debtId = getId();
const btnDelete = document.querySelector("#btnDelete");
const btnRestore = document.querySelector("#btnRestore");
const btnEdit = document.querySelector("#btnEdit");
const btnBack = document.querySelector("#btnBack");

btnRestore.addEventListener("click", async () => {
    const response = await restoreDebt(debtId, getToken());
    await loadInfo();
    showAlertSuccess(response.success, response.data.general[0]);
});

formDelete.addEventListener("submit", async (e) => {
    e.preventDefault();
    const response = await deleteDebt(debtId, getToken());
    await loadInfo();
    showAlertSuccess(response.success, response.data.general[0]);
});

btnBack.addEventListener("click", async () => {
    window.location.href = `${baseUrlDebt}`;
    return;
});

btnEdit.addEventListener("click", async (e) => {
    e.preventDefault();
    window.location.href = `${baseUrlDebt}/${debtId}/edit`;
    return;
});

const loadInfo = async () => {
    const data = await findByIdDebt(debtId);
    const _amount = currencyFormatter({ currency: "MXN", value: data.amount });

    id.value = debtId;
    name.innerText = data.debt;
    amount.innerText = _amount;
    period.innerText = "";
    if (data.period) {
        period.innerText = `@${data.period}`;
    }
    categoryGender.innerText = "";
    if (data.category) {
        categoryGender.innerText = `${data.category} / ${data.gender}`;
    }
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
