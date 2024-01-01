const period = document.querySelector("#period");
const category = document.querySelector("#category");
const form = document.querySelector("form");

form.addEventListener("submit", async (e) => {
    e.preventDefault();
    const formData = new FormData(form);
    const payload = formDataToObject(formData);
    const { status, data } = await storeDebt(payload, getToken());
    if (status == 201) {
        window.location.href = baseUrlDebt;
        return;
    } else {
        console.log(data);
        showErrorsDebtForm(data.errors);
        return;
    }
});

const buildSelects = async () => {
    const data = periods();
    data.forEach((item) => {
        const option = document.createElement("option");
        option.value = item.id;
        option.text = item.text;
        period.add(option, null);
    });
    const categories = await selectCategory();

    categories.forEach((item) => {
        const opt = document.createElement("option");
        opt.value = item.category_id;
        opt.text = `${item.category} - ${item.gender}`;
        category.add(opt, null);
    });
};

(async () => {
    console.log("data1");
    buildSelects();
})();
