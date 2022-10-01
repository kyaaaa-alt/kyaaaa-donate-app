/**
 *
 * @param totalPages
 * @param page
 * @param maxLength
 * @returns {unknown[]}
 */
function getPageList(totalPages, page, maxLength) {
    if (maxLength < 5) throw "maxLength must be at least 5";

    function range(start, end) {
        return Array.from(Array(end - start + 1), (_, i) => i + start);
    }

    const sideWidth = maxLength < 9 ? 1 : 2;
    const leftWidth = (maxLength - sideWidth*2 - 3) >> 1;
    const rightWidth = (maxLength - sideWidth*2 - 2) >> 1;
    if (totalPages <= maxLength) {
        // no breaks in list
        return range(1, totalPages);
    }
    if (page <= maxLength - sideWidth - 1 - rightWidth) {
        // no break on left of page
        return range(1, maxLength-sideWidth-1)
            .concat([0])
            .concat(range(totalPages-sideWidth+1, totalPages));
    }
    if (page >= totalPages - sideWidth - 1 - rightWidth) {
        // no break on right of page
        return range(1, sideWidth)
            .concat([0])
            .concat(range(totalPages - sideWidth - 1 - rightWidth - leftWidth, totalPages));
    }
    // Breaks on both sides
    return range(1, sideWidth)
        .concat([0])
        .concat(range(page - leftWidth, page + rightWidth))
        .concat([0])
        .concat(range(totalPages-sideWidth+1, totalPages));
}

$(function(){
    var numberOfItems = document.querySelectorAll('.data .contributors').length;
    var limitPerPage = 5;
    var totalPages = Math.ceil(numberOfItems / limitPerPage);
    var paginationSize = 7;
    var currentPage;
    function showPage(whichPage){
        if(whichPage < 1 || whichPage > totalPages) return false;
        currentPage = whichPage;
        var hideElement = document.querySelectorAll('.data .contributors').style.display = "none";
        hideElement.slice((currentPage - 1) * limitPerPage, currentPage * limitPerPage).style.display = "initial";
        $(".pagination li").slice(1, -1).remove();
        getPageList(totalPages, currentPage, paginationSize).forEach(item => {
            $("<li>").addClass("page-item").addClass(item ? "current-page" : "dots").toggleClass("active", item === currentPage).append($("<a>").addClass("page-link").attr({href: "javascript:void(0)"}).text(item || "...")).insertBefore(".next-page");
        });
        $(".previous-page").toggleClass("disable", currentPage === 1);
        $(".next—page").toggleClass("disable", currentPage === totalPages);
        return true;
    }
    $(".pagination").append(
        $("<li>").addClass("page-item").addClass("previous-page").append($("<a>").addClass("page-link").attr({href:"javascript:void(0)"}).text("<<")),
        $("<li>").addClass("page-item").addClass("next-page").append($("<a>").addClass("page-link").attr({href:"javascript:void(0)"}).text(">>"))
    );
    $(".data").show();
    showPage(1);
    $(document).on("click", ".pagination li.current-page:not(.active)", function(e){
        e.preventDefault()
        showPage(+$(this).text());
    });
    $(".previous-page").on("click", function(e){
        e.preventDefault()
        showPage(currentPage - 1);
    });
    $(".next-page").on("click", function(e){
        e.preventDefault()
        showPage(currentPage + 1);
    });
});