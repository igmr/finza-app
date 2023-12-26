const id = document.querySelector("#id");
const code = document.querySelector("#code");
const name = document.querySelector("#name");
const gender = document.querySelector("#gender");
const observation = document.querySelector("#observation");
const status = document.querySelector("#status");
const categoryId = getId();
const btnDelete = document.querySelector("#btnDelete");
const btnRestore = document.querySelector("#btnRestore");
const btnEdit = document.querySelector("#btnEdit");
const btnBack = document.querySelector("#btnBack");

btnRestore.addEventListener("click", async () => {
    const response = await restoreCategory(categoryId, getToken());
    await loadInfo();
    showAlertSuccess(response.success, response.data.general[0]);
});

formDelete.addEventListener("submit", async (e) => {
    e.preventDefault();
    const response = await deleteCategory(categoryId, getToken());
    await loadInfo();
    showAlertSuccess(response.success, response.data.general[0]);
});

btnBack.addEventListener("click", async () => {
    window.location.href = `${baseUrlCategory}`;
    return;
});

btnEdit.addEventListener("click", async (e) => {
    e.preventDefault();
    window.location.href = `${baseUrlCategory}/${categoryId}/edit`;
    return;
});

const loadInfo = async () => {
    const data = await findByIdCategory(categoryId);
    console.log(data);
    id.value = categoryId;
    name.innerText = data.category;
    code.innerText = "";
    gender.innerText = "";
    observation.innerText = "";
    if (data.code) {
        code.innerText = `@${data.code}`;
    }
    if (data.gender) {
        gender.innerText = `@${data.gender}`;
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
