const btnReload = document.querySelector("#reload");
const detail = document.querySelector("#detail-list");
const pagination = document.querySelector(".reload-pagination");

btnReload.addEventListener("click", async () => {
    await buildList();
    return;
});

const btnInfo = async (id) => {
    window.location.href = `${baseUrlClassification}/${id}`;
    return;
};

const buildList = async () => {
    let content = buildHeader();
    const response = await getAllClassifications();
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
            <span class="sub-text">Code</span>
        </div>
        <div class="nk-tb-col">
            <span class="sub-text">Classification</span>
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
    return `
            <div class="nk-tb-item" onclick="btnInfo(${data.classification_id})">
                <div class="nk-tb-col">
                    <span>${data.classification_id}</span>
                </div>
                <div class="nk-tb-col tb-col-md">
                    <span>${data.code ?? ""}</span>
                </div>
                <div class="nk-tb-col">
                    <span>${data.classification}</span>
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
    const response = await getAllClassifications(url);
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
