$(function() {
    $("#eliminarModal").on("show.bs.modal", function (e) {
         console.log("entre");
         $("#eliminarModalLabel").html($(e.relatedTarget).data('title'));
         $("#elim-title").html($(e.relatedTarget).data('title'));
         $("#elim-id").val($(e.relatedTarget).data('id'));
    });
});
