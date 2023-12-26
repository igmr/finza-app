const form = document.querySelector("form");

form.addEventListener("submit", async (e) => {
    e.preventDefault();
    const formData = new FormData(form);
    const payload = formDataToObject(formData);
    const { status, data } = await storeClassification(payload, getToken());
    if (status == 201) {
        window.location.href = baseUrlClassification;
        return;
    } else {
        console.log(data);
        showErrorsClassificationForm(data.errors);
        return;
    }
});
