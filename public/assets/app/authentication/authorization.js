const form = document.querySelector("form");
const redirectTo = `${baseUrl}/app`;

form.addEventListener("submit", async (e) => {
    e.preventDefault();
    const formData = new FormData(form);
    const payload = formDataToObject(formData);
    const { status, data } = await fetchPostAuthenticate(payload, getToken());
    if (status == 200) {
        window.location.href = redirectTo;
        return;
    } else {
        showErrorsPostAuthenticateForm(data.errors);
        return;
    }
});
