// import { jsPDF } from "jspdf";
// const doc = new jsPDF({
//     orientation: "p",
//     unit: "mm",
//     format: [297, 210]
//   });
// var doc = new jsPDF('p','mm','a4');
// doc.addHTML($('#table'), 3, 3, function() {
//     console.log('export');
//   doc.save('web.pdf');
// });
// const doc = new jsPDF();

// doc.text("Hello world!", 10, 10);
// doc.save("a4.pdf");
    $('#ordemnome').click(function(){
        var doc = new jsPDF("p", "pt", "letter"),
        source = $("#template_invoice")[0],
        margins = {
        top: 40,
        bottom: 60,
        left: 40,
        right:0,
        width: 1022
        };
        doc.fromHTML(
        source, // HTML string or DOM elem ref.
        margins.left, // x coord
        margins.top, {
            // y coord
            width: margins.width // max width of content on PDF
        },
        function(dispose) {
            // dispose: object with X, Y of the last line add to the PDF
            //          this allow the insertion of new lines after html
            doc.save("Test.pdf");
        },
        margins
        );
    })
  