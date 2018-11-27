 var token = $("#token");
 var tipoencuesta = $("#tipoEncuesta1");
 var fechadesde = $("#fecha_desde1");
 var fechahasta = $("#fecha_hasta1");
 var turno = $("#turno1");

$('#formulario').submit(function(e){
    console.log("Error");
    e.preventDefault();
    var formData =$(this).serializeArray();
    $.ajax({
          url:'/ObtenerReporte',
          headers: {
            'X-CSRF-TOKEN':token.val()
          },
          dataType:'json',
          data:formData,
          type:'POST',
          success: function (response){
            var valor = ''
            var uno = [];
            var dos = [];
            var tres = [];
            var cuatro = [];
            var cinco = [];
            $.each(response, function(index, value){
              if(value.ID===undefined)
              {
                console.log('Error');
              }
              else
              {
                valor += "<tr>"+
                "<td>" + value.PREGUNTA + "</td>"+
                "<td>" + value.MUYDEACUERDO + "</td>"+
                "<td>" + value.DEACUERDO + "</td>"+ 
                "<td>" + value.ENDESACUERDO + "</td>"+
                "<td>" + value.MUYENDESACUERDO + "</td>"+
                "</tr>";
               console.log("VEC "+uno)
                if(uno.length < 4){
                  uno.push(value.MUYDEACUERDO);     
                  uno.push(value.DEACUERDO); 
                  uno.push(value.ENDESACUERDO); 
                  uno.push(value.MUYENDESACUERDO); 
                }else if(dos.length < 4){
                  dos.push(value.MUYDEACUERDO);     
                  dos.push(value.DEACUERDO); 
                  dos.push(value.ENDESACUERDO); 
                  dos.push(value.MUYENDESACUERDO);
                }
                else if(tres.length < 4){
                  tres.push(value.MUYDEACUERDO);     
                  tres.push(value.DEACUERDO); 
                  tres.push(value.ENDESACUERDO); 
                  tres.push(value.MUYENDESACUERDO);
                }
                else if(cuatro.length < 4){
                  cuatro.push(value.MUYDEACUERDO);     
                  cuatro.push(value.DEACUERDO); 
                  cuatro.push(value.ENDESACUERDO); 
                  cuatro.push(value.MUYENDESACUERDO);
                }
                else if(cinco.length < 4){
                  cinco.push(value.MUYDEACUERDO);     
                  cinco.push(value.DEACUERDO); 
                  cinco.push(value.ENDESACUERDO); 
                  cinco.push(value.MUYENDESACUERDO);
                }
              }   
            })
            $("#tbodyUsuario").html(valor);
           
            $('#bar-chart').replaceWith('<canvas id="bar-chart"></canvas>');
            new Chart(document.getElementById("bar-chart"), {
              type: 'bar',
              scaleOverride : true,
              scaleStartValue : 0,
              data: {
                labels: ["Muy de Acuerdo", "De Acuerdo", "En Desacuerdo", "Muy En Desacuerdo" ],
                datasets: [{    
                  backgroundColor: 'rgb(19, 141, 117)',
                  data: uno
                  }]
              },
              options: {
                scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero:true
                      }
                  }]
                },
                legend: { display: false },
                title: {
                  display: true,
                  text: 'El servicio que se brinda se adapta a mis necesidades como usuario.'
                }
              }
          });

          $('#bar-chart2').replaceWith('<canvas id="bar-chart2"></canvas>');
          new Chart(document.getElementById("bar-chart2"), {
            type: 'bar',
            scaleOverride : true,
            scaleStartValue : 0,
            data: {
              labels: ["Muy de Acuerdo", "De Acuerdo", "En Desacuerdo", "Muy En Desacuerdo" ],
              datasets: [{    
                backgroundColor: 'rgb(40, 116, 166)',
                data: dos
                }]
            },
            options: {
              scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
              },
              legend: { display: false },
              title: {
                display: true,
                text: 'El servicio otorgado cumplió con mis necesidades y expectativas solicitadas.'
              }
            }
          });
          
          $('#bar-chart3').replaceWith('<canvas id="bar-chart3"></canvas>');
          new Chart(document.getElementById("bar-chart3"), {
            type: 'bar',
            scaleOverride : true,
            scaleStartValue : 0,
            data: {
              labels: ["Muy de Acuerdo", "De Acuerdo", "En Desacuerdo", "Muy En Desacuerdo" ],
              datasets: [{    
                backgroundColor: 'rgb(108, 52, 131)',
                data: tres
                }]
            },
            options: {
              scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
              },
              legend: { display: false },
              title: {
                display: true,
                text: 'La respuesta al servicio solicitado se obtuvo dentro del plazo establecido.'
              }
            }
          });

          $('#bar-chart4').replaceWith('<canvas id="bar-chart4"></canvas>');
          new Chart(document.getElementById("bar-chart4"), {
            type: 'bar',
            scaleOverride : true,
            scaleStartValue : 0,
            data: {
              labels: ["Muy de Acuerdo", "De Acuerdo", "En Desacuerdo", "Muy En Desacuerdo" ],
              datasets: [{    
                backgroundColor: 'rgb(52, 73, 94)',
                data: cuatro
                }]
            },
            options: {
              scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
              },
              legend: { display: false },
              title: {
                display: true,
                text: 'Los procesos para que se me brinde el servicio son eficientes'
              }
            }
          });

          $('#bar-chart5').replaceWith('<canvas id="bar-chart5"></canvas>');
          new Chart(document.getElementById("bar-chart5"), {
            type: 'bar',
            scaleOverride : true,
            scaleStartValue : 0,
            data: {
              labels: ["Muy de Acuerdo", "De Acuerdo", "En Desacuerdo", "Muy En Desacuerdo" ],
              datasets: [{    
                backgroundColor: 'rgb(131, 145, 146)',
                data: cinco
                }]
            },
            options: {
              scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
                },
              legend: { display: false },
              title: {
                display: true,
                text: 'La disposición del personal que me brinda el servicio es adecuada.'
              }
            }
          });
          },
          error: function(){
            console.log('Ha ocurrido un error');
          }
       });   
       $.ajax({
        url:'/ObtenerReporte',
        headers: {
          'X-CSRF-TOKEN':token.val()
        },
        dataType:'json',
        data:{"fecha_desde":fechadesde.val(),"fecha_hasta":fechahasta.val(),"tipoEncuesta":"satisfaccionTotal","turno":turno.val()},
        type:'POST',
        success: function (response){
          console.log(response);
          var valor = ''
          var datos = [];
          var i=0;
          $.each(response, function(index, value){
            i++;
            if(value.ID===undefined)
            {
              console.log('Error');
            }
            else
            {
              if(datos.length<=5){ 
                datos.push(value.RESPUESTA);   
              }else{
                valor += "<tr>";
                valor+=especificar(datos,0, '34495E');
                valor+=especificar(datos,1, '5a7da0');
                valor+=especificar(datos,2, '9f6eb3');
                valor+=especificar(datos,3, '6890ab');
                valor+=especificar(datos,4, '5aab9b');
                valor+= "<td style='background-color: #34495E; color: #fff'>" +datos[5]+ "</td>";
                valor += "</tr>";
                console.log(datos);
                datos =[];
                datos.push(value.RESPUESTA); 
              }
            }   
          })
          valor += "<tr>";
          valor+=especificar(datos,0, '34495E');
          valor+=especificar(datos,1, '5a7da0');
          valor+=especificar(datos,2, '9f6eb3');
          valor+=especificar(datos,3, '6890ab');
          valor+=especificar(datos,4, '5aab9b');
          valor+= "<td style='background-color: #34495E; color: #fff'>" +datos[5]+ "</td>";
          valor += "</tr>";
          $("#tbodyEspecifico").html(valor);
        },
        error: function(){
          console.log('Ha ocurrido un error');
        }
     });    
       
       $.ajax({
        url:'/ObtenerComentarios',
        headers: {
          'X-CSRF-TOKEN':token.val()
        },
        dataType:'json',
        data:formData,
        type:'POST',
        success: function (response){
          var valor = ''
          $.each(response, function(index, value){
            if(value.RESPUESTA===undefined)
            {
              console.log('Error');
            }
            else
            {
              valor += "<tr>"+
              "<td>" + value.RESPUESTA + "</td>"+
              "<td>" + value.TIPO_USUARIO + "</td>"+
              "</tr>";
            }   
          })
          $("#tbodyTipoUs").html(valor);
        },
        error: function(){
          console.log('Ha ocurrido un error');
        }
     });    

});
$('#formSalida').submit(function(e){
  console.log('Error');
  e.preventDefault();
  var formData =$(this).serializeArray();
  $.ajax({
        url:'/ObtenerReporte',
        headers: {
          'X-CSRF-TOKEN':token.val()
        },
        dataType:'json',
        data:formData,
        type:'POST',
        success: function (response){
          var valor = ''
          $.each(response, function(index, value){
            if(value.ID===undefined)
            {
              console.log('Error');
            }
            else
            {
              valor += "<tr>"+
              "<td>" + value.PREGUNTA + "</td>"+
              "<td>" + value.SI + "</td>"+
              "<td>" + value.NO + "</td>"+  
              "</tr>";
            }   
          })
          $("#tbodySalida").html(valor);
        },
        error: function(){
          console.log('Ha ocurrido un error');
        }
     });   
     
     $.ajax({
      url:'/ObtenerComentarios',
      headers: {
        'X-CSRF-TOKEN':token.val()
      },
      dataType:'json',
      data:formData,
      type:'POST',
      success: function (response){
        var valor1 = ''
        var valor2=''
        var valor3=''
        $.each(response, function(index, value){
          if(value.ID===undefined)
          {
            console.log('Error');
          }
          else 
          {
            if(value.ID==3){
            valor1+=  "<li>"+  value.RESPUESTA + "</li>";
            }
            else if (value.ID==5){
              valor2+= "<li>"+value.RESPUESTA + "</li>";
            }
            else if (value.ID==7){
              valor3+= "<li>"+value.RESPUESTA + "</li>";
          }
        }   
        })
        $("#Salida1").html(valor1);
        $("#Salida2").html(valor2);
        $("#Salida3").html(valor3);
      },
      error: function(){
        console.log('Ha ocurrido un error');
      }
   });    

});

$('#formProcesos').submit(function(e){
  console.log('Error');
  e.preventDefault();
  var formData =$(this).serializeArray();
  $.ajax({
        url:'/ObtenerFiltro',
        headers: {
          'X-CSRF-TOKEN':token.val()
        },
        dataType:'json',
        data:formData,
        type:'POST',
        success: function (response){
          var valor = ''
          $.each(response, function(index, value){
            if(value.DESCRIPCION===undefined)
            {
              console.log('Error');
            }
            else
            {
              valor += "<tr>"+
              "<td>" + value.DESCRIPCION + "</td>"+
              "<td>" + value.MASCULINO + "</td>"+
              "<td>" + value.FEMENINO + "</td>"+
              "<td>" + value.TOTAL + "</td>"+  
              "</tr>";
            }   
          })
          $("#tbodyProcesos").html(valor);
        },
        error: function(){
          console.log('Ha ocurrido un error');
        }
     });
     
  });
  $('#formCarrera').submit(function(e){
    console.log('Error');
    e.preventDefault();
    var formData =$(this).serializeArray();
    $.ajax({
          url:'/ObtenerFiltro',
          headers: {
            'X-CSRF-TOKEN':token.val()
          },
          dataType:'json',
          data:formData,
          type:'POST',
          success: function (response){
            var valor = ''
            $.each(response, function(index, value){
              if(value.DESC_ESCUELA===undefined)
              {
                console.log('Error');
              }
              else
              {
                valor += "<tr>"+
                "<td>" + value.DESC_ESCUELA + "</td>"+
                "<td>" + value.DESC_CARRERA + "</td>"+
                "<td>" + value.CANTIDAD + "</td>"+ 
                "</tr>";
              }   
            })
            $("#tbodyCarrera").html(valor);
          },
          error: function(){
            console.log('Ha ocurrido un error');
          }
       });
       
    });
  
    
    function especificar( datos, posicion, color){
      console.log("color "+color);
      var valor='';
      if(datos[posicion]=="MUY DE ACUERDO"){
       valor+=
      "<td style='background-color: #"+  color +"; color: #fff' >" + 1 + "</td>"+
      "<td style='background-color: #"+  color +"; color: #fff' ></td>"+
      "<td style='background-color: #"+  color +"; color: #fff' ></td>"+
      "<td style='background-color: #"+  color +"; color: #fff' ></td>";
     
      }else if(datos[posicion]=="DE ACUERDO"){
        valor+=
       "<td style='background-color: #"+  color +"; color: #fff' ></td>"+
       "<td style='background-color: #"+  color +"; color: #fff' >" + 1 + "</td>"+
       "<td style='background-color: #"+  color +"; color: #fff' ></td>"+
       "<td style='background-color: #"+  color +"; color: #fff' ></td>";
       
      
      }else if(datos[posicion]=="EN DESACUERDO"){
        valor+=
        "<td style='background-color: #"+  color +"; color: #fff' ></td>"+
        "<td style='background-color: #"+  color +"; color: #fff' ></td>"+
        "<td style='background-color: #"+  color +"; color: #fff' >" + 1 + "</td>"+
        "<td style='background-color: #"+  color +"; color: #fff' ></td>";
      
      }else if(datos[posicion]=="MUY EN DESACUERDO"){
        valor+=
        "<td style='background-color: #"+  color +"; color: #fff' ></td>"+
        "<td style='background-color: #"+  color +"; color: #fff' ></td>"+
        "<td style='background-color: #"+  color +"; color: #fff' ></td>"+
       "<td style='background-color: #"+  color +"; color: #fff' >" + 1 + "</td>";
      
      }  
      return valor; 
    }



    $(document).ready(function(){
        
        $('a[data-toggle="tab"]').on('show.affectedDiv.tab', function(e) {
            localStorage.setItem('activeTab', $(e.target).attr('href'));
        });
        var activeTab = localStorage.getItem('activeTab');
        if(activeTab){
            $('#myTab a[href="' + activeTab + '"]').tab('show');
        }
    });

    