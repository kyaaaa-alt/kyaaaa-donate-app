const container = document.querySelector("#paginated-list");
const listItems = document.querySelectorAll(".page .contributors");
const nextBtn = document.querySelector("#next-button");
const prevBtn = document.querySelector("#prev-button");
const paginationNumbers = document.querySelector("#pagination-numbers");
const itemsInPage = 4;
const pagesNumber = Math.ceil(listItems.length / itemsInPage);
let currentPage = 1;

function pagination() {
    container.innerHTML = "";
    const start = (currentPage - 1) * itemsInPage;
    const end = start + itemsInPage;
    const dataToAdd = Array.from(listItems);

    dataToAdd.slice(start, end).forEach((el) => {
        container.append(el);
    });
}

function createNumberBtn() {
    const btnArray = [];
    for (let i = 1; i <= pagesNumber; i++) {
        const btn = document.createElement("button");
        btn.innerHTML = i;
        btn.classList.add("pagination-number");
        paginationNumbers.append(btn);
        btnArray.push(btn);
        btnArray[0].classList.add("active");
        btn.addEventListener("click", () => {
            btnArray.forEach((btn) => {
                btn.classList.remove("active");
            });
            btn.classList.toggle("active");
            currentPage = +btn.innerHTML;
            pagination();
        });
        nextBtn.addEventListener("click", () => {
            btnArray.forEach((btn) => {
                btn.classList.remove("active");
                btnArray[currentPage - 1].classList.add("active");
            });
        });
        prevBtn.addEventListener("click", () => {
            btnArray.forEach((btn) => {
                btn.classList.remove("active");
                btnArray[currentPage - 1].classList.add("active");
            });
        });
    }
}

nextBtn.addEventListener("click", () => {
    if (currentPage === pagesNumber) {
        return false;
    }
    currentPage += 1;
    pagination();
});

prevBtn.addEventListener("click", () => {
    if (currentPage === 1) {
        return false;
    }
    currentPage -= 1;
    pagination();
});

pagination();
createNumberBtn();
