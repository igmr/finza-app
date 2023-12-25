const baseUrl = `http://127.0.0.1:8000`;
const urlPostAuthenticate = `${baseUrl}`;
const baseUrlBank = `${baseUrl}/app/bank`;

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
        console.log(error);
        return {
            status: 500,
            data: {},
        };
    }
};

//* ========================================================================================= *//
//* banks                                                                                     *//
//* ========================================================================================= *//

const storeBank = async (payload, token) => {
    try {
        const response = await fetch(baseUrlBank, {
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
        console.log(error);
        return {
            status: 500,
            data: {},
        };
    }
};

const getAllBanks = async (url) => {
    try {
        auxUrl = url ?? `${baseUrlBank}/list`;
        const response = await fetch(auxUrl, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
            },
        });
        const data = await response.json();
        if (data) {
            return data;
        }
        return {};
    } catch (error) {
        console.log(error);
        return {};
    }
};

const findByIdBank = async (bankId) => {
    const url = `${baseUrlBank}/info/${bankId}`;
    console.log(url);
    const response = await fetch(url, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
        },
    });
    return await response.json();
};

const updateBank = async (payload, token, bankId) => {
    try {
        const response = await fetch(`${baseUrlBank}/${bankId}`, {
            method: "PUT",
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
        console.log(error);
        return {
            status: 500,
            data: {},
        };
    }
};

const deleteBank = async (bankId, token) => {
    const url = `${baseUrlBank}/${bankId}`;
    const response = await fetch(url, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
            "X-CSRF-Token": token,
        },
    });
    return await response.json();
};

const restoreBank = async (bankId, token) => {
    const url = `${baseUrlBank}/${bankId}/restore`;
    const response = await fetch(url, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
            "X-CSRF-Token": token,
        },
    });
    return await response.json();
};
//* ========================================================================================= *//
//* end banks                                                                                     *//
//* ========================================================================================= *//
