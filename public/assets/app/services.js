const baseUrl = `http://127.0.0.1:8000`;
const urlPostAuthenticate = `${baseUrl}`;

const fetchPostAuthenticate = async (payload, token) => {
    try {
        const response = await fetch(urlPostAuthenticate, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                "X-CSRF-Token": token,
            },
            body: JSON.stringify(payload),
        });
        const data = await response.json();
        const status = response.status;
        return {
            status,
            data,
        };
    } catch (error) {
        return {
            status: 500,
            data: {},
        };
    }
};
