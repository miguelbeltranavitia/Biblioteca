var c = console;

// this function generates the pdf using the table
function pdfSatisfaccion() {
  var columns = ["Pregunta", "Muy de acuerdo", "De acuerdo", "En desacuerdo", "Muy en desacuerdo"];
  var data = tableToJson($("#tSatisfaccion").get(0), columns);
  var _columns = ["Comentarios Adicionales", "Tipo de Usuario"];
  var _data = tableToJson($("#tComentariosSatisfaccion").get(0), columns);

  var doc = new jsPDF('landscape');
  doc.setTextColor(100)
  doc.text(20, 20, 'Reporte Encuesta Satisfacción.')

  doc.autoTable(columns, data, {margin:{top:30}});
  doc.addPage()
  doc.setTextColor(100)
  doc.text(20, 20, 'Comentarios adicionales en cuanto a encuesta de Satisfacción.')
  doc.autoTable(_columns, _data, {margin:{top:30}});
  doc.addPage()
  var canvas = document.querySelector('#bar-chart');
  var canvasImg = canvas.toDataURL("image/png", 1.0);
  var canvas2 = document.querySelector('#bar-chart2');
  var canvasImg2 = canvas2.toDataURL("image/png", 1.0);
  var canvas3 = document.querySelector('#bar-chart3');
  var canvasImg3 = canvas3.toDataURL("image/png", 1.0);
  var canvas4 = document.querySelector('#bar-chart4');
  var canvasImg4 = canvas4.toDataURL("image/png", 1.0);
  var canvas5 = document.querySelector('#bar-chart5');
  var canvasImg5 = canvas5.toDataURL("image/png", 1.0);
  

  doc.addImage(canvasImg, 'PNG', 10, 10, 135, 75 );
  doc.addImage(canvasImg2, 'PNG', 145, 10, 135, 75 );
  doc.addImage(canvasImg3, 'PNG', 10, 100, 135, 75 );
  doc.addImage(canvasImg4, 'PNG', 145, 100, 135, 75 );
  doc.addPage()
  doc.addImage(canvasImg5, 'PNG', 10, 10, 135, 75 );
  
  doc.save("ReporteSatisfaccion.pdf");
}

    function pdfSalida(){
        var columns = ["Pregunta", "Si", "No"]; 
        var data = tableToJson($("#tSalida").get(0), columns); 

        var doc = new jsPDF();
        doc.setTextColor(100)
        doc.text(20, 20, 'Reporte Encuesta Salida.')
        doc.autoTable(columns, data, {margin:{top:30}});
        doc.addPage()
        doc.setTextColor(100)
        doc.text(20, 20, 'Comentarios adicionales en cuanto a encuesta de Salida.')
        
        doc.fromHTML($("#cSatisfaccion").html(),20,30,{
            'width':170
        });
    
        doc.save("ReporteSalida.pdf");
    }
    function pdfGenero(){
        var columns = ["Proceso", "Masculino", "Femenino", "Total"];
        var data = tableToJson($("#tGenero").get(0), columns);

        var doc = new jsPDF();
        doc.setTextColor(100)
        doc.text(20, 20, 'Reporte Filtro Género.')
        doc.autoTable(columns, data, {margin:{top:30}});
        doc.save("ReporteFiltroGenero.pdf");
}
        function pdfEscuela(){
            var columns = ["Escuela", "Carrera", "Cantidad"];
            var data = tableToJson($("#tEscuela").get(0), columns);

            var doc = new jsPDF('landscape');
            doc.setTextColor(100)
            doc.text(20, 20, 'Reporte Filtro Escuela y Carrera.')
            doc.autoTable(columns, data, {margin:{top:30}});
            doc.save("ReporteFiltroCarrera.pdf");
        }

// This function will return table data in an Array format
function tableToJson(table, columns) {
  var data = [];
  // go through cells
  for (var i = 1; i < table.rows.length; i++) {
    var tableRow = table.rows[i];
    var rowData = [];
    for (var j = 0; j < tableRow.cells.length; j++) {
    	rowData.push(tableRow.cells[j].innerHTML)
    }
    data.push(rowData);
  }
    
  return data;
}


