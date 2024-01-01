const form = document.querySelector("form");

form.addEventListener("submit", async (e) => {
    e.preventDefault();
    const formData = new FormData(form);
    const payload = formDataToObject(formData);
    
    const { status, data } = await storeSaving(payload, getToken());
    if (status == 201) {
        window.location.href = baseUrlSaving;
        return;
    } else {
        console.log(data);
        showErrorsSavingForm(data.errors);
        return;
    }
});
