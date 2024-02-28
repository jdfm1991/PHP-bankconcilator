document.getElementById('optbank').disabled = true;
document.getElementById('preview').disabled = true;
confirmation = false
codbank = '-'
$('#dataview').hide();
$("#waittime").removeClass("show");
$('#waittime').hide();

$(document).ready(function () {
    //////////////////////////////////////////////////////////////////////////////
    //////////////////////////////BEGIN FUNCTIONS BLCK CEC////////////////////////
    //////////////////////////////////////////////////////////////////////////////
    sheetexcel  = $('#sheetexcel')[0].files[0];
    optbank = $.trim($('#optbank').val());

   $('#sheetexcel').change(function () {

        sheetexcel  = $('#sheetexcel')[0].files[0];
        document.getElementById('optbank').disabled = false;

        $('#optbank').change(function () { 

            optbank = $.trim($('#optbank').val());
            if (optbank != '-') {
                document.getElementById('preview').disabled = false;
            }else{
                document.getElementById('preview').disabled = true;
            }
            //console.log(optbank,sheetexcel,confirmation)
        });

   });

   $('#preview').click(function (e) { 
        e.preventDefault();
        $("#waittime").addClass("show");
        $('#waittime').show();
        dataexcel(optbank,sheetexcel,confirmation)
        //console.log(optbank,sheetexcel,confirmation)
    });

    $('#loaddata').click(function (e) { 
        e.preventDefault();
        confirmation = true
        dataexcel(optbank,sheetexcel,confirmation)
    });
    //////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////END FUNCTIONS BLCK CEC////////////////////////
    //////////////////////////////////////////////////////////////////////////////



    //////////////////////////////////////////////////////////////////////////////
    //////////////////////////////BEGIN FUNCTIONS BLCK CMB////////////////////////
    //////////////////////////////////////////////////////////////////////////////

    $('#urd').click(function (e) { 
        e.preventDefault();
        $(".modal-content").css("color", "white");
        $(".modal-content").css("background", "rgb(20, 38, 110, 0.719)");
        $(".modal-content").css("background", "radial-gradient(circle, rgba(20, 38, 110, 0.719) 0%, rgba(0, 130, 211, 0.486) 100%)" );
        $(".modal-title").text("Actualizar tasa de Dia");		
        $('#updrate').modal('show');
        
    });

    $('#document').click(function (e) { 
        e.preventDefault();
        $(".modal-content").css("color", "white");
        $(".modal-content").css("background", "rgb(20, 38, 110, 0.719)");
        $(".modal-content").css("background", "radial-gradient(circle, rgba(20, 38, 110, 0.719) 0%, rgba(0, 130, 211, 0.486) 100%)" );
        $(".modal-title").text("Soporte de Movimineto");		
        $('#documento').modal('show');
        
    });

    $('#getbank').change(function (e) {
        e.preventDefault();
        codbank = $('#getbank').val();
        getContenttable(codbank)

    });

    $(document).on("click", "#editdata", function(){
        fila = $(this).closest("tr");	        		            
        codmov     = fila.find('td:eq(0)').text();
        codent     = fila.find('td:eq(1)').text();
        datemov    = fila.find('td:eq(2)').text();
        refmov     = fila.find('td:eq(3)').text();
        descripmov = fila.find('td:eq(4)').text();
        tipmov     = fila.find('td:eq(5)').text();
        amoumov    = fila.find('td:eq(6)').text();
        ratemov    = fila.find('td:eq(7)').text();
        codcat     = fila.find('td:eq(8)').text();
        coditem    = fila.find('td:eq(9)').text();

        $("#codmov").val(codmov);
        $("#codent").val(codent);
        $("#datemov").val(datemov);
        $("#refmov").val(refmov);
        $("#descripmov").val(descripmov);
        $("#tipmov").val(tipmov);
        $("#amoumov").val(amoumov);
        $("#ratemov").val(ratemov);
        getvaluecat(codcat)
        getvalueitem(coditem) 
        //$("#codcat").val(codcat);
        //$("#coditem").val(coditem); 
        
        $(".modal-content").css("color", "white");
        $(".modal-content").css("background", "rgb(20, 38, 110, 0.719)");
        $(".modal-content").css("background", "radial-gradient(circle, rgba(20, 38, 110, 0.719) 0%, rgba(0, 130, 211, 0.486) 100%)" );
        $(".modal-title").text("Actualizar Infomacion");		
        $('#movbank').modal('show');
    });

    $('#formmove').submit(function (e) { 
        e.preventDefault();

        codmov  = $.trim($('#codmov').val());
        ratemov = $.trim($('#ratemov').val());
        codcat  = $.trim($('#codcat').val());
        coditem = $.trim($('#coditem').val());


        var datos = new FormData();

        datos.append('codmov', codmov)
        datos.append('ratemov', ratemov)
        datos.append('codcat', codcat)
        datos.append('coditem', coditem)


        $.ajax({
            url: "concilator_controller.php?op=updatemove",
            type: "POST",
            dataType:"json",    
            data:  datos,
            cache: false,
            contentType: false,
            processData: false, 
            error : function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: '<h2>¡Al parecer ocurrio un error!</h2><br><h4>Al tratar de Actualizar la informacion</h4>',
                  })
            }, 
            success: function(data) {
                Swal.fire({
                    icon: 'success',
                    title: 'Se ha actualizado exitosamente la infomacion',
                    showConfirmButton: false,
                    timer: 1000
                  })

                $('#movbank').modal('hide');

                setTimeout(() => {
                    movtable.ajax.reload(null, false);
                  }, 1000);
                
              
            }
    
          });
        
    });

    $('#formrate').submit(function (e) { 
        e.preventDefault();

        date     = $.trim($('#date').val());
        ratedate = $.trim($('#ratedate').val());
        
        var datos = new FormData();

        datos.append('date', date)
        datos.append('ratedate', ratedate)

        $.ajax({
            url: "concilator_controller.php?op=updrateday",
            type: "POST",
            dataType:"json",    
            data:  datos,
            cache: false,
            contentType: false,
            processData: false,
            error : function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: '<h2>¡Al parecer ocurrio un error!</h2><br><h4>Al tratar de Actualizar la informacion</h4>',
                  })
            }, 
            success: function(data) {
                Swal.fire({
                    icon: 'success',
                    title: 'Se ha actualizado exitosamente la infomacion',
                    showConfirmButton: false,
                    timer: 1000
                })

                $('#updrate').modal('hide');

                setTimeout(() => {
                    movtable.ajax.reload(null, false);
                  }, 1000);
                
              
            }
    
          });
        
    });
    //////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////END FUNCTIONS BLCK CMB////////////////////////
    //////////////////////////////////////////////////////////////////////////////
});

function dataexcel(optbank,sheetexcel,confirmation) {

    var datos = new FormData();
    datos.append('sheetexcel', sheetexcel)
    datos.append('op', optbank)
    datos.append('confirmation', confirmation)

    $.ajax({
        url: "concilator_controller.php",
        type: "POST",
        dataType:"json",    
        data:  datos,
        cache: false,
        contentType: false,
        processData: false,
        error : function() {
            $('#datatable').empty();
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: '<h2>¡Al parecer ocurrio un error!</h2><br><h4>Verifique que el formato del banco que esta cargando coincida con el banco seleccionado</h4>',
              })
              $('#waittime').hide();
                $('#dataview').show();
        },    
        success: function(data) {
            Swal.fire({
                icon: 'success',
                title: 'Carga Completa',
                showConfirmButton: false,
                timer: 1000
              })
            $("#waittime").removeClass("show");
            $('#waittime').hide();
            $('#dataview').show();
            console.log(data)
            if (data.confirmation == 'false') {
                $('#datatable').empty();
                $('#datatable').append('<thead class="text-center"><tr><th>N#</th><th>Fecha</th><th>Referencia</th><th>Descripcion</th><th>Monto</th><th>Movimiento</th></tr></thead>');
                $.each(data, function(idx, opt) {
                    if (opt.date != undefined || opt.amount != undefined ) {
                        $('#datatable').append('<tbody><td>'+ opt.line +'</td><td>'+ opt.date +'</td><td>'+ opt.refenc +'</td><td>'+ opt.descri +'</td><td>'+ opt.amount +'</td><td>'+ opt.motion +'</td></tbody>');
                    }
                });
               
            }else{
                setTimeout(() => {
                    location.reload();
                  }, 1000);
            }
        }

    });
    
}

function getContenttable(codbank) {
    console.log(codbank)

    if (movtable) {

        $('#movtable').DataTable().destroy();

        movtable = $('#movtable').DataTable({  
            "responsive": true,
            "colReorder": true,
            //"pageLength": 50,
            "ajax":{            
                "url": "concilator_controller.php?op=getmov", 
                "method": 'POST', //usamos el metodo POST
                "data":  {'codbank':codbank},
                "dataSrc":""
            },
            "columns":[
                {"data": "CodMov"},
                {"data": "CodEnt"},
                {"data": "DateMov"},
                {"data": "RefMov"},
                {"data": "DescripMov"},
                {"data": "TipMov"},
                {"data": "AmouMov"},
                {"data": "RateMov"},
                //{"data": "CodCat"},
                {"data": "CodCat",
                    "render":function(data,type,row) {
                        if (data == null) {
                            return 'MSC'
                        } else {
                            return data
                        }
                    }
                },
                //{"data": "CodItem"},
                {"data": "CodItem",
                    "render":function(data,type,row) {
                        if (data == null) {
                            return 'MSC'
                        } else {
                            return data
                        }
                    }
                },
                {"defaultContent": "<div class='text-center'><button id='editdata' class='btn btn-primary'><i class='bi bi-file-earmark-arrow-up'></i></button></div>"}
            ],
            /*"columnDefs": [
                { "width": "50%", "targets": 2 }
              ]*/
        });
        
    } else {

        movtable = $('#movtable').DataTable({  
            "responsive": true,
            "colReorder": true,
            //"pageLength": 50,
            "ajax":{            
                "url": "concilator_controller.php?op=getmov", 
                "method": 'POST', //usamos el metodo POST
                "data":  {'codbank':codbank},
                "dataSrc":""
            },
            "columns":[
                {"data": "CodMov"},
                {"data": "CodEnt"},
                {"data": "DateMov"},
                {"data": "RefMov"},
                {"data": "DescripMov"},
                {"data": "TipMov"},
                {"data": "AmouMov"},
                {"data": "RateMov"},
                //{"data": "CodCat"},
                {"data": "CodCat",
                    "render":function(data,type,row) {
                        if (data == null) {
                            return 'MSC'
                        } else {
                            return data
                        }
                    }
                },
                //{"data": "CodItem"},
                {"data": "CodItem",
                    "render":function(data,type,row) {
                        if (data == null) {
                            return 'MSC'
                        } else {
                            return data
                        }
                    }
                },
                //{"defaultContent": "<div class='text-center'><button id='editdata' class='btn btn-primary'><i class='bi bi-file-earmark-arrow-up'></i></button></div>"},
                {"defaultContent": "<div class='text-center'></div>"}

            ],
            /*"columnDefs": [
                { "width": "50%", "targets": 2 }
              ]*/

        });
        
    }
}

function getbank() {
    $.ajax({
        type: "POST",
        url: "concilator_controller.php?op=getbank",
        dataType: "json",
        success: function (data) {
            $.each(data, function(idx, opt) {
                $('#getbank').append('<option name="" value="' + opt.CodEnt +'">' + opt.DescripEntity + '</option>');
                $('#optbank').append('<option name="" value="' + opt.CodEnt +'">' + opt.DescripEntity + '</option>');

            });
                       
        }
    });
    
}

function getcategory() {
    $.ajax({
        type: "POST",
        url: "concilator_controller.php?op=getcat",
        dataType: "json",
        success: function (data) {
            $.each(data, function(idx, opt) {
                $('#codcat').append('<option name="" value="' + opt.CodCat +'">' + opt.DescripCat + '</option>');
            });
                       
        }
    });
}

function getitem() {
    $.ajax({
        type: "POST",
        url: "concilator_controller.php?op=getitem",
        dataType: "json",
        success: function (data) {
            $.each(data, function(idx, opt) {
                $('#coditem').append('<option name="" value="' + opt.CodItem +'">' + opt.DescripPar + '</option>');
            });
                       
        }
    });
}

function getvaluecat(codcat) {
    $.ajax({
        url: "concilator_controller.php?op=getvaluecat",
        method: "POST",
        dataType: "json",
        data:  {codcat:codcat},  
        success: function(data) {
            if (data.length == 0) {
                $("#codcat").val(codcat);
            } else {
                $.each(data, function(idx, opt) {
                    //se itera con each para llenar el select en la vista
                    $("#codcat").val(opt.CodCat);
                });  
            }
         
        }
    
      });
}

function getvalueitem(coditem) {
    $.ajax({
        url: "concilator_controller.php?op=getvalueitem",
        method: "POST",
        dataType: "json",
        data:  {coditem:coditem},  
        success: function(data) {
            if (data.length == 0) {
                $("#coditem").val(coditem);
            } else {
                $.each(data, function(idx, opt) {
                    //se itera con each para llenar el select en la vista
                    $("#coditem").val(opt.CodItem);
                });  
            }
         
        }
    
      });
}



getContenttable(codbank)
getbank()
getcategory()
getitem()

