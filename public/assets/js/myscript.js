$(document).ready(function () {
    // flash category
    const flashData = $(".flash-data").data("flashdata");
    if (flashData) {
        Swal.fire({
            title: "Data Category",
            text: "Berhasil " + flashData,
            icon: "success",
        });
    }

    $(".tombol-hapus").on("click", function (e) {
        e.preventDefault();

        Swal.fire({
            title: "Apakah anda yaqin?",
            text: "data category dihapus",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Hapus Data!",
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).closest("form").submit();
            }
        });
    });

    // flash user
    const flashUser = $(".flash-user").data("flash-user");
    if (flashUser) {
        Swal.fire({
            title: "Data User",
            text: "Berhasil " + flashUser,
            icon: "success",
        });
    }

    $(".hapus-user").on("click", function (e) {
        e.preventDefault();

        Swal.fire({
            title: "Apakah anda yaqin?",
            text: "data user dihapus",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Hapus Data!",
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).closest("form").submit();
            }
        });
    });

    // flash article
    const flashArticle = $(".flash-article").data("flash-article");
    if (flashArticle) {
        Swal.fire({
            title: "Data Artikel",
            text: "Berhasil " + flashArticle,
            icon: "success",
        });
    }

    $(".hapus-article").on("click", function (e) {
        e.preventDefault();

        Swal.fire({
            title: "Apakah anda yaqin?",
            text: "data article dihapus",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Hapus Data!",
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).closest("form").submit();
            }
        });
    });
});
