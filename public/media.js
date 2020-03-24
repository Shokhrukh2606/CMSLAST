//
// $(document).ready(function () {
//     var infoMedia = $("#mediaModal .modal-content .info ul")
//     var addButton = $("#addM")
//     var form = $("#sendM")
//     updateDOM()
//     form.submit(
//         function (e) {
//             var it = $(this)
//             e.preventDefault();
//             let formData = new FormData($(this)[0]);
//             $.ajax(it.attr("action"), {
//                 data: formData,
//                 type: 'post',
//                 enctype: 'multipart/form-data',
//                 cache: false,
//                 contentType: false,
//                 processData: false,
//                 timeout: 60000
//             }).then(function (res) {
//                 console.log(res)
//                 updateDOM()
//             })
//         })
//     addButton.click(function (e) {
//         e.preventDefault()
//         $("#filesinput").trigger("click")
//     })
//     $("#filesinput").on('change', function () {
//         form.trigger("submit")
//     })
//
//
//     function updateDOM() {
//         $.ajax({
//                 url: baseUrl + '/posts/mediaGet/' + pID
//             }
//         ).then(function (res) {
//             if (res.length) {
//                 console.log(res)
//                 if (infoMedia.hasClass("used")) {
//                     $.each(res, function () {
//                         let self = $(this)
//                         infoMedia.empty()
//                         infoMedia.append('<li><div class="checkbox">' +
//                             '  <label><input type="checkbox" value=""></label>' +
//                             '</div><img src="' + self.src + '" /><div class="actionsPanel"><i class="fa fa-window-close" data-imgid="' + self.imgID + '"></i></div></li>')
//                     })
//                 } else {
//                     $.each(res, function () {
//                         let self = $(this)
//                         infoMedia.append('<li><div class="checkbox">' +
//                             '  <label><input type="checkbox" value=""></label>' +
//                             '</div><img src="' + self.src + '"/><div class="actionsPanel"><i class="fa fa-window-close" data-imgid="' + self.imgID + '"></i></div></li>')
//                     })
//                     infoMedia.addClass("used")
//                 }
//                 $(".fa-window-close").click(function () {
//                     $.ajax(baseUrl + '/posts/mediaDelete/' + $(this).data("imgid")).then(function (res) {
//                         console.log(res)
//                         updateDOM()
//                     })
//                 })
//             } else {
//                 infoMedia.empty()
//             }
//         }).catch(function () {
//             console.log("error occured")
//         })
//     }
// })