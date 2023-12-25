const form = document.querySelector("form");

form.addEventListener("submit", async (e) => {
    e.preventDefault();
    const formData = new FormData(form);
    const payload = formDataToObject(formData);
    const { status, data } = await storeBank(payload, getToken());
    if (status == 201) {
        window.location.href = baseUrlBank;
        return;
    } else {
        console.log(data);
        showErrorsBankForm(data.errors);
        return;
    }
});
