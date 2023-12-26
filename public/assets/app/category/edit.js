const form = document.querySelector("form");
const btnBack = document.querySelector("#btnBack");
const categoryId = getId();
const inputCode = document.querySelector("#code");
const inputName = document.querySelector("#name");
const inputGender = document.querySelector("#gender");
const inputObservation = document.querySelector("#observation");

form.addEventListener("submit", async (e) => {
    try {
        e.preventDefault();
        const formData = new FormData(form);
        const payload = formDataToObject(formData);
        const { status, data } = await updateCategory(payload, getToken(), categoryId);
        if (status == 200) {
            window.location.href = `${baseUrlCategory}/${categoryId}`;
            return;
        }
        console.log(status);
        console.log(data);
        showErrorsCategoryForm(data.errors);
        return;
    } catch (exception) {
        console.log(exception);
    }
});


btnBack.addEventListener("click", () => {
    window.location.href = `${baseUrlCategory}/${categoryId}`;
    return;
});

const loadForm = async () => {
    const data = await findByIdCategory(categoryId);
    await buildSelect(data.gender_id);
    inputCode.value = data.code;
    inputName.value = data.category;
    inputObservation.value = data.observation;
};

const buildSelect = async (selected) => {
    const data = await selectGender();
    inputGender.innerHTML = "";
    data.forEach((item) => {
        const option = document.createElement("option");
        option.value = item.id;
        option.text = item.name;
        if (item.id == selected) {
            option.selected = true;
        }
        inputGender.add(option);
    });
};

(() => {
    loadForm();
    alertError.classList.add("d-none");
})();
