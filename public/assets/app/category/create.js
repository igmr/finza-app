const select = document.querySelector("select");
const form = document.querySelector("form");

form.addEventListener("submit", async (e) => {
    e.preventDefault();
    const formData = new FormData(form);
    const payload = formDataToObject(formData);
    const { status, data } = await storeCategory(payload, getToken());

    if (status == 201) {
        window.location.href = baseUrlCategory;
        return;
    } else {
        console.log(data);
        showErrorsCategoryForm(data.errors);
        return;
    }
});

const buildSelect = async () => {
    const data = await selectGender();
    select.innerHTML = "";
    data.forEach((item) => {
        const option = document.createElement("option");
        option.value = item.id;
        option.text = item.name;
        select.add(option);
    });
    return;
};

(async () => {
    await buildSelect();
})();
