const form = document.querySelector("form");

form.addEventListener("submit", async (e) => {
    e.preventDefault();
    const formData = new FormData(form);
    const payload = formDataToObject(formData);
    const { status, data } = await storeGender(payload, getToken());
    if (status == 201) {
        window.location.href = baseUrlGender;
        return;
    } else {
        console.log(data);
        showErrorsGenderForm(data.errors);
        return;
    }
});
