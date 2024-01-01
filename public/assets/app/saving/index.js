const btnReload = document.querySelector("#reload");
const detail = document.querySelector("#detail-list");
const pagination = document.querySelector(".reload-pagination");

btnReload.addEventListener("click", async () => {
    await buildList();
    return;
});

const btnInfo = async (id) => {
    window.location.href = `${baseUrlSaving}/${id}`;
    return;
};

const buildList = async () => {
    let content = buildHeader();
    const response = await getAllSaving();
    console.log(response.data);
    detail.innerHTML = "";
    response.data.forEach((item) => {
        content += buildItem(item);
    });
    detail.innerHTML = content;
    buildPaginate(response);
};

const buildHeader = () => {
    return `
    <div class="nk-tb-item nk-tb-head">
        <div class="nk-tb-col">
            <span class="sub-text">Id</span>
        </div>
        <div class="nk-tb-col tb-col-md">
            <span class="sub-text">Saving</span>
        </div>
        <div class="nk-tb-col">
            <span class="sub-text">Date finish</span>
        </div>
        <div class="nk-tb-col">
            <span class="sub-text">Amount</span>
        </div>
        <div class="nk-tb-col tb-col-md">
            <span class="sub-text">Created at</span>
        </div>
        <div class="nk-tb-col tb-col-md">
            <span class="sub-text">User</span>
        </div>
        <div class="nk-tb-col">
            <span class="sub-text">Status</span>
        </div>
    </div><!-- .nk-tb-item -->`;
};

const buildItem = (data) => {
    let statusClass = "text-danger";
    if (data.status == "Activo") {
        statusClass = "text-success";
    }
    let _amount = currencyFormatter({ currency: "MXN", value: data.amount });
    return `
            <div class="nk-tb-item" onclick="btnInfo(${data.saving_id})">
                <div class="nk-tb-col">
                    <span>${data.saving_id}</span>
                </div>
                <div class="nk-tb-col">
                    <span>${data.saving ?? ""}</span>
                </div>
                <div class="nk-tb-col tb-col-md">
                    <span>${data.date_finish}</span>
                </div>
                <div class="nk-tb-col text-right">
                    <span>${_amount}</span>
                </div>
                <div class="nk-tb-col tb-col-md">
                    <span>${data.created_at}</span>
                </div>
                <div class="nk-tb-col tb-col-md">
                    <span>${data.user}</span>
                </div>
                <div class="nk-tb-col">
                    <span class="tb-status ${statusClass}">${data.status}</span>
                </div>
            </div><!-- .nk-tb-item -->`;
};

const buildPaginate = (data) => {
    let content = "";
    const { links } = data;
    links.forEach((pag) => {
        content += `
        <li class="page-item">
            <button class="page-link active" aria-current="page"
                onClick="reloadList('${pag.url ?? ""}')">
                ${pag.label}
            </button>
        </li>`;
    });
    pagination.innerHTML = content;
};

const reloadList = async (url) => {
    if (!url) {
        return;
    }
    let content = buildHeader();
    const response = await getAllSaving(url);
    detail.innerHTML = "";
    response.data.forEach((item) => {
        content += buildItem(item);
    });
    detail.innerHTML = content;
    buildPaginate(response);
};

(async () => {
    await buildList();
})();
